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
use App\category_post;
use Auth;

use Carbon\Carbon;class category_postController extends Controller
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
	public function add_category_post(){
		return view('admin.category_post.add_category_post');
    }
    public function all_category_post(){
        $all_post= category_post::orderBy('category_post_id','desc')->get();

        return view('admin.category_post.all_category_post')->with(compact('all_post'));
    }
    public function save_category_post(Request $Request)
    {
        $data=$Request->All();
        $this->authlogin();
          $messages = [
            'required' => 'Trường :attribute bắt buộc nhập.'
            // 'email'    => 'Trường :attribute phải có định dạng email'
        ];
        $this->validate(request(), [
            'category_post_name' => 'required',
            'category_post_slug'=>'required',
            'category_post_desc'=>'required',

        ], $messages);
        $category_post1= category_post::where('category_post_name',$data['category_post_name'])->get();
        if ($category_post1->count()>0) {
            Session::flash('error','Đã tòn tại tên danh mục này');
            return Redirect::back();

        }
        else{
            $category_post= new category_post;
            $category_post->category_post_name=$data['category_post_name'];
           $category_post->category_post_slug=$data['category_post_slug'];
           $category_post->category_post_status=$data['category_post_status'];
           $category_post->category_post_desc=$data['category_post_desc'];

            $category_post->save();
            Session::flash('success','Thêm thành công');
            return Redirect::back();}
    }
    public function unaction_category_post($category_post_id){
    $this->authlogin();

    category_post::find($category_post_id)->update(['category_post_status'=>1]);
    session()->flash('success', 'Ẩn trạng thái thành công');

    return Redirect::back();
   }
    public function action_category_post($category_post_id){
      $this->authlogin();

    category_post::find($category_post_id)->update(['category_post_status'=>0]);
    session()->flash('success', 'Hiện trạng thái thành công');

    return Redirect::back();
   }
   public function edit_category_post($category_post_id){
        $this->authlogin();
        $edit_post=category_post::where('category_post_id',$category_post_id)->get();
        return view('admin.category_post.edit_category_post')->with(compact('edit_post'));

   }

    public function delete_category_post($category_post_id){
            $this->authlogin();
        $edit_post=category_post::find($category_post_id)->delete();
        // Session::put('message','Thêm danh mục thành công');
            session()->flash('success', 'Xóa thành công');
         return Redirect::back();
   }
      public function update_category_post(Request $Request,$category_post_id ){
        $this->authlogin();
        $data=$Request->All();
          $messages = [
            'required' => 'Trường :attribute bắt buộc nhập.'
            // 'email'    => 'Trường :attribute phải có định dạng email'
        ];
        $this->validate(request(), [
            'category_post_name' => 'required',
            'category_post_slug'=>'required',
            'category_post_desc'=>'required',

        ], $messages);

        $edit_post=category_post::find($category_post_id);
            $edit_post->category_post_name=$data['category_post_name'];
           $edit_post->category_post_slug=$data['category_post_slug'];
           $edit_post->category_post_desc=$data['category_post_desc'];
            $edit_post->save();
            Session::flash('success','Thêm thành công');
            return Redirect::to('all-category-post');}
     }
