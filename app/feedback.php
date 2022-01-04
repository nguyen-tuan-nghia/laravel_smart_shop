<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'product_id','customer_id','message','feedback_status','created_at','rating_star_id','order_id'];
    protected $primaryKey='feedback_id';
    protected $table='tbl_feedback';
    public function rating_star(){
        return $this->belongsTo('App\rating_star','rating_star_id');
    }
    public function product(){
        return $this->belongsTo('App\product','product_id');
    }        
}
