<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'customer_name','password','email','address','phone','re_token'
    ];
    protected $primaryKey='customer_id';
    protected $table='tbl_customer';
}
