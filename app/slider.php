<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    public $timespams=false;
    protected $fillable=[
    	'slider_name','slider_status','slider_img','slider_desc','slider_type'];
    protected $primaryKey='slider_id';
    protected $table='tbl_slider';
}
