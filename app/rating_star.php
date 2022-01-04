<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rating_star extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'number','customer_id','product_id','created_at'];
    protected $primaryKey='rating_star_id';
    protected $table='tbl_rating_star';
}
