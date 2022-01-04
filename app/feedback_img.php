<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feedback_img extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'feedback_name','feedback_id'];
    protected $primaryKey='feedback_img_id';
    protected $table='tbl_feedback_img';
}
