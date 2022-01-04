<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
validator();
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use File;

class webdetailController extends Controller
{
    public function authlogin(){
        $admin_id=session::get('admin_id');
        // $admin_id=Auth::id();
        if($admin_id){
            return Redirect('/dashboard');
        }
        else{
            return Redirect('/admin')->send();
        }
    }
    public function index(){
        $this->authlogin();
        $web=DB::table('tbl_web_detail')->first();
        return view('admin.webdetail.web')->with(compact('web'));
    }
    public function update(Request $Request){
        $this->authlogin();
        $data=array();
        $data['web_name']=$Request->web_name;
        $data['web_address']=$Request->web_address;
        $data['web_infomation']=$Request->web_infomation;
        $data['web_fanpage']=$Request->web_fanpage;
        $get_image=$Request->file('file');
        if($get_image){
        $web=DB::table('tbl_web_detail')->where('web_detail_id',1)->first();
        $image_path='public/upload/logo/'.$web->web_logo;
        if($web->web_logo!==null){
        unlink($image_path);
        }
      $get_name_img=$get_image->getClientOriginalName();
      $name_img=current(explode('.', $get_name_img));
      $new_image=$name_img.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move('public/upload/logo',$new_image);
        $data['web_logo']=$new_image;
    }
        $web=DB::table('tbl_web_detail')->where('web_detail_id',1)->update($data);
        Session()->flash('success','Thành công!!');
        return back();
    }
}
