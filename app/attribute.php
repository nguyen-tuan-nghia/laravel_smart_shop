<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attribute extends Model
{
        public $timestamps=false;
    protected $fillable=[
        'product_id','attribute_color','attribute_size','ttribute_quantity','attribute_price'];
    protected $primaryKey='attribute_id';
    protected $table='tbl_attribute';
    public function product(){
        return $this->belongsTo('App\product','product_id');
    }

}
