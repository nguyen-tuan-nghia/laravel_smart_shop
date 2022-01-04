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
use App\slider;
use Auth;

class sliderController extends Controller
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
    public function add_slider(){
    	$this->authlogin();
      return view('admin.slider.add_slider');
    }
    
       public function all_slider(Request $request){
       $this->authlogin();
    $Search = $request->input('Search');
if($Search!=""){

   	$all_slider=DB::table('tbl_slider')->where('product_name', 'like', '%'.$Search.'%')
   	->orderBy('tbl_slider.slider_id','DESC')->get();
            $all_slider->appends(['Search' => $Search]);

}
else{
      $all_slider=DB::table('tbl_slider')->orderBy('tbl_slider.slider_id','DESC')->paginate(5);
}
	return view('admin.slider.all_slider')->with('all_slider',$all_slider);
   }
   public function unaction_slider($slider_id){
   	$this->authlogin();

   	DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_status'=>1]);
   	session()->flash('success', 'Ẩn trạng thái thành công');

   		return Redirect('/all-slider');
   }
      public function action_slider($slider_id){
      $this->authlogin();

   	DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_status'=>0]);
   	session()->flash('success', 'Hiện trạng thái thành công');

   		return Redirect('/all-slider');
   }
   public function save_slider(Request $Request){
   	$this->authlogin();
      $messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'slider_name' => 'required',
        'slider_desc' => 'required',
        'slider_status' => 'required',
  		'slider_img'=>'required',
    ], $messages);
   		$data=array();
   		$data['slider_name']=$Request->slider_name;
   		$data['slider_desc']=$Request->slider_desc;
   		$data['slider_status']=$Request->slider_status;
		$data['slider_type']=$Request->slider_type;


   		$get_image=$Request->file('slider_img');
   		if($get_image){
      $get_name_img=$get_image->getClientOriginalName();
      $name_img=current(explode('.', $get_name_img));
      $new_image=$name_img.rand(0,99999999999).'.'.$get_image->getClientOriginalExtension();
   		$get_image->move('public/upload/slider',$new_image);
   		$data['slider_img']=$new_image;
      $available=DB::table('tbl_slider')->where('slider_name',$Request->slider_name)->get();
      if ($available->count()) {
          session()->flash('error', 'Tên slider đã tồn tại');
          return Redirect::back();
      }
      else{
   		DB::table('tbl_slider')->insert($data);
   			    session()->flash('success', 'thêm mới thành công');
   		return Redirect::back();}}}

   public function edit_slider($slider_id){
   	$this->authlogin();
        $all_slider=DB::table('tbl_slider')->where('slider_id', $slider_id)->join('tbl_slider_type','tbl_slider.slider_type','=','tbl_slider_type.slider_type')->select('tbl_slider.*','tbl_slider_type.*')->orderBy('slider_id','DESC')->get();
        $all_slider_notin=DB::table('tbl_slider_type')->orderBy('slider_type','DESC')->get();
    	$manager_product=view('admin.slider.edit_slider')->with("edit_slider",$all_slider)->with("edit_slider_notin",$all_slider_notin);
      return view('layout_Admin')->with('admin.slider.edit_slider',$manager_product);
   }
      public function delete_slider($slider_id){
      	$this->authlogin();
    $slider=DB::table('tbl_slider')->where('slider_id', $slider_id)->first();
    unlink('public/upload/slider/'.$slider->slider_img);
    DB::table('tbl_slider')->where('slider_id', $slider_id)->delete();
            session()->flash('success', 'Xóa thành công');
      return Redirect('/all-slider');
   }
      public function update_slider(Request $Request,$slider_id ){
      	$this->authlogin();
       $messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'slider_name' => 'required',
        'slider_desc' => 'required',
  		'slider_img'=>'required',
    ], $messages);
   		$data=array();
   		$data['slider_name']=$Request->slider_name;
   		$data['slider_desc']=$Request->slider_desc;
		$data['slider_type']=$Request->slider_type;

   		$get_image=$Request->file('slider_img');
   		if($get_image){
      $get_name_img=$get_image->getClientOriginalName();
      $name_img=current(explode('.', $get_name_img));
      $new_image=$name_img.rand(0,99999999999).'.'.$get_image->getClientOriginalExtension();
   		$get_image->move('public/upload/slider',$new_image);
   		$data['slider_img']=$new_image;
        $slider=DB::table('tbl_slider')->where('slider_id', $slider_id)->first();
        unlink('public/upload/slider/'.$slider->slider_img);
   		$result=DB::table('tbl_slider')->where('slider_id',$slider_id)->update($data);
   			// Session::put('message','Thêm danh mục thành công');
   			    session()->flash('success', 'thêm mới thành công');
   		return Redirect('/all-slider');}
   		$result=DB::table('tbl_slider')->where('slider_id',$slider_id)->update($data);
   			// Session::put('message','Thêm danhs mục thành công');
   			    session()->flash('success', 'thêm mới thành công');
   		return Redirect('/all-slider');
   	 }

}
