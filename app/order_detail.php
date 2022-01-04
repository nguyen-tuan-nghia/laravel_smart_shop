<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'order_id ','product_id ','product_name','product_price','product_sales_quantity','product_image','coupon_text','product_feeship','product_color','product_size'];
    protected $primaryKey='order_detail_id';
    protected $table='tbl_order_detail';
}
