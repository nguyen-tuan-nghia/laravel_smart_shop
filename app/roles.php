<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
        public $timestamps = false; //set time to false
    protected $fillable = [
    	'name'
    ];
    protected $primaryKey = 'id_roles';
 	protected $table = 'tbl_roles';

 	public function admin(){
 		return $this->belongsToMany('App\admin');
 	}
}
