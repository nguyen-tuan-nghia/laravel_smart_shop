<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
	public $timestamps=false;

    protected $fillable=[
    	'message','customer_id','order_status','created_at','payment_type'];
    protected $primaryKey='order_id';
    protected $table='tbl_order';
    public function customer(){
        return $this->belongsTo('App\customer','customer_id');
    }}

