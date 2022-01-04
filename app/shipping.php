<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'shipping_name','shipping_address','shipping_phone','shipping_notes','shipping_method','created_at','updated_at'];
    protected $primaryKey='shipping_id';
    protected $table='tbl_shipping';
}
