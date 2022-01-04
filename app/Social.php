<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
          'provider_user_id',  'provider',  'userz'
    ];
 
    protected $primaryKey = 'user_id';
    protected $table = 'tbl_social';
    public function login(){
        return $this->belongsTo('App\customer', 'userz');
    }

}
