<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    	public $timestamps=false;

    protected $fillable=[
    	'product_name','product_slug','quantity','product_sold','import_price','category_id','brand_id','product_desc','product_content','product_price','product_image','product_size','product_color','product_static','created_at','updated_at','product_views'];
    protected $primaryKey='product_id';
    protected $table='tbl_product';
    public function attribute(){
        return $this->belongsToMany('App\attribute','product_id');
    }
}
