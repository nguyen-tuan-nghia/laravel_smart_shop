<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class admin extends Authenticatable
{
        public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_email', 'admin_password', 'admin_name','admin_phone','address','created_at','updated_at'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';

 	public function roles(){
 		return $this->belongsToMany('App\roles');
 	}
 	public function getAuthPassword(){
 		return $this->admin_password;
 	}
 	 	public function hasAnyRoles($roles){
 		return null !==  $this->roles()->whereIn('name',$roles)->first();
 	}
 	public function hasRole($role){
 		return null !==  $this->roles()->where('name',$role)->first();
 	}
}
