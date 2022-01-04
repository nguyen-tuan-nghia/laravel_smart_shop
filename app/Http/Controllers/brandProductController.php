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
use App\category_post;

class brandProductController extends Controller
{
    public function authlogin(){
        // $admin_id=session::get('admin_id');
        $admin_id=Auth::id();
        if($admin_id){
            return Redirect('/dashboard');
        }
        else{
            return Redirect('/admin')->send();
        }
    }
    public function add_brand(){
      $this->authlogin();
      $category=DB::table('tbl_category_product')->where('category_parent',0)->get();
   		return view('admin.brand.add_brand')->with(compact('category'));
   }
   public function all_brand(){
    $this->authlogin();
   	$all_brand=DB::table('tbl_brand')->get();
   	$manager_category_product=view('admin.brand.all_brand')->with("all_brand",$all_brand);
    return view('layout_Admin')->with('admin.brand.all_brand',$manager_category_product);
   }
   public function unaction_brand($brand_id){
    $this->authlogin();
   	DB::table('tbl_brand')->where('brand_id', $brand_id)->update(['brand_status'=>1]);
   	session()->flash('success', 'Ẩn trạng thái thành công');

   		return Redirect('/all-brand');
   }
      public function action_brand($brand_id){
        $this->authlogin();
   	DB::table('tbl_brand')->where('brand_id', $brand_id)->update(['brand_status'=>0]);
   	session()->flash('success', 'Hiện trạng thái thành công');

   		return Redirect('/all-brand');
   }
   public function save_brand(Request $Request){
    $this->authlogin();
      $messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'brand_name' => 'required',
        'brand_desc' => 'required',
        'brand_status' => 'required',
    ], $messages);
   		$data=array();
   		$data['brand_name']=$Request->brand_name;
   		$data['brand_desc']=$Request->brand_desc;
   		$data['brand_status']=$Request->brand_status;
        $data['brand_slug']=$Request->brand_slug;
        $data['category_id']=$Request->category_id;
   		$data['created_at']=Carbon::now();
      $result= DB::table('tbl_brand')->where('brand_name',$Request->brand_name)->get();
      if ($result->count()) {
          session()->flash('error', 'Tên này đãtồn tại ');
      return Redirect::back();
      }
      else{
   		DB::table('tbl_brand')->insert($data);
   			// Session::put('message','Thêm danh mục thành công');
   			    session()->flash('success', 'thêm mới thành công');
   		return Redirect::back();}}

   public function edit_brand($brand_id){
    $this->authlogin();
    $brand_all=DB::table('tbl_brand')->where('brand_id',$brand_id)->get();
    $category=DB::table('tbl_category_product')->where('category_parent',0)->get();
    $manager_brand=view('admin.brand.edit_brand')->with("edit_brand",$brand_all)->with('category',$category);
      return view('layout_Admin')->with('admin.brand.edit_brand',$manager_brand);
   }
    public function delete_brand($brand_id){
        $this->authlogin();
 DB::table('tbl_brand')->where('brand_id', $brand_id)->delete();
        // Session::put('message','Thêm danh mục thành công');
            session()->flash('success', 'Xóa thành công');
      return Redirect('/all-brand');
   }
    public function update_brand(Request $Request,$brand_id ){
        $this->authlogin();
         $messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'brand_name' => 'required',
        'brand_desc' => 'required',
    ], $messages);
      $data=array();
      $data['brand_name']=$Request->brand_name;
      $data['brand_desc']=$Request->brand_desc;
      $data['brand_slug']=$Request->brand_slug;
      $data['category_id']=$Request->category_id;

      $data['updated_at']=Carbon::now('Asia/Ho_Chi_Minh');

      $result= DB::table('tbl_brand')->where('brand_id', $brand_id)->update($data);
        // Session::put('message','Thêm danh mục thành công');
            session()->flash('success', 'Sửa thành công');
      return Redirect('/all-brand');
      }
  public function show_brand_home($brand_name, Request $Request){
  $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();

    $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','DESC')->get();
      $brand=DB::table('tbl_brand')->where('brand_status','0')->where('brand_name',$brand_name)->orderBy('brand_id','DESC')->get();

    $brand_by_id=DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_name',$brand_name)->paginate(16);
            foreach ($brand as $key => $value) {
      $meta_desc=$value->brand_desc;
      $meta_keywords=$value->brand_desc;
      $meta_title=$value->brand_name; 
      $url_canonical=$Request->url();

        }
    $brand_name=DB::table('tbl_brand')->where('brand_name',$brand_name)->limit(1)->get();
    return view('pages.show_brand_home')->with('brand_by_id',$brand_by_id)->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('brand_by_name',$brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post);
  } 
   }
