<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'comment','customer_id','comment_date','comment_product_id','comment_parent_comment','comment_status','person_replied_name'
    ];
    protected $primaryKey='comment_id';
    protected $table='tbl_comment';
    public function product(){
        return $this->belongsTo('App\product','comment_product_id');
    }
    public function customer(){
        return $this->belongsTo('App\customer','customer_id');
    }
}
