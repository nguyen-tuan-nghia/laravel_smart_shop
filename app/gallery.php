<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
        public $timestamps=false;

    protected $fillable=[
        'gallery_name','gallery_image','product_id'];
    protected $primaryKey='gallery_id';
    protected $table='tbl_gallery';
}
