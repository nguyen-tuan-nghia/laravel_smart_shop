<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
	public $timestamps=false;

    protected $fillable=[
    	'post_title','post_desc','post_img','post_status','created_at','post_content','post_category','author_id','post_keywords','post_slug','post_views'];
    protected $primaryKey='post_id';
    protected $table='tbl_post';
    public function admin(){
    	return $this->belongsTo('App\admin','author_id');
    }
    public function category_post(){
    	return $this->belongsTo('App\category_post','post_category');
    }}
