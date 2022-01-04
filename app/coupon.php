<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    public $timestamps=false;
    protected $fillable=[
    	'coupon_name','coupon_code','coupon_quantity','coupon_condition','coupon_number','coupon_date_start','coupon_date_end','coupon_status'
    ];
    protected $primaryKey='coupon_id';
    protected $table='tbl_coupon';
}
