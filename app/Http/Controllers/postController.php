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
use Carbon\Carbon;
use File;
use App\post;
use Auth;
class postController extends Controller
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
	public function add_post(){
        $category_post=category_post::orderBy('category_post_id','desc')->get();
		return view('admin.post.add_post')->with(compact('category_post'));
    }
    public function all_post(){
        $all_post= post::orderBy('post_id','desc')->get();

        return view('admin.post.all_post')->with(compact('all_post'));
    }
    public function save_post(Request $Request)
    {
        $data=$Request->All();
        $this->authlogin();
          $messages = [
            'required' => 'Trường :attribute bắt buộc nhập.'
            // 'email'    => 'Trường :attribute phải có định dạng email'
        ];
        $this->validate(request(), [
            'post_title' => 'required',
            'post_slug'=>'required',
            'post_desc'=>'required',
			       'post_img'=>'required',
            'post_content'=>'required',
            'post_category'=>'required',
            'post_keywords'=>'required',

        ], $messages);
        $category_post1= post::where('post_title',$data['post_title'])->get();
        if ($category_post1->count()>0) {
            Session::flash('error','Đã tòn tại tên này');
            return Redirect::back();

        }
        else{
            $post= new post;
            $post->post_title=$data['post_title'];
           $post->post_slug=$data['post_slug'];
           $post->post_status=$data['post_status'];
           $post->post_desc=$data['post_desc'];
           $post->post_content=$data['post_content'];
           $post->post_category=$data['post_category'];
           $post->post_keywords=$data['post_keywords'];
            $post->created_at=Carbon::now('Asia/Ho_Chi_Minh');
            $post->author_id=Auth::id();
            $get_image=$Request->file('post_img');
        if($get_image){
          $get_name_img=$get_image->getClientOriginalName();
          $name_img=current(explode('.', $get_name_img));
          $new_image=$name_img.rand(0,99999999999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/post',$new_image);
            $post->post_img=$new_image;
            $post->save();
            Session::flash('success','Thêm thành công');
            return Redirect::back();}}
    }
    public function unaction_post($post_id){
    $this->authlogin();

    post::find($post_id)->update(['post_status'=>1]);
    session()->flash('success', 'Ẩn trạng thái thành công');

    return Redirect::back();
   }
    public function action_post($post_id){
      $this->authlogin();

    post::find($post_id)->update(['post_status'=>0]);
    session()->flash('success', 'Hiện trạng thái thành công');

    return Redirect::back();
   }
   public function edit_post($post_id){
        $this->authlogin();
        $edit_post=post::where('post_id',$post_id)->join('tbl_category_post','tbl_category_post.category_post_id','=','tbl_post.post_category')->get();
        $category_post=category_post::orderBy('category_post_id','desc')->get();
        return view('admin.post.edit_post')->with(compact('edit_post','category_post'));

   }

    public function delete_post($post_id){
        $this->authlogin();
        $post=post::find($post_id);
        $path='public/upload/post/'.$post->post_img;
        if(file::exists($path)){
        unlink($path);
    }
        $post->delete();
            session()->flash('success', 'Xóa thành công');
         return Redirect::back();
   }
      public function update_post(Request $Request,$post_id ){
        $this->authlogin();
        $data=$Request->All();
          $messages = [
            'required' => 'Trường :attribute bắt buộc nhập.'
            // 'email'    => 'Trường :attribute phải có định dạng email'
        ];
        $this->validate(request(), [
            'post_title' => 'required',
            'post_slug'=>'required',
            'post_desc'=>'required',
            'post_content'=>'required',
            'post_category'=>'required',
            'post_keywords'=>'required',

        ], $messages);

        $post=post::find($post_id);
            $post->post_title=$data['post_title'];
           $post->post_slug=$data['post_slug'];
           $post->post_desc=$data['post_desc'];
           $post->post_content=$data['post_content'];
           $post->post_category=$data['post_category'];
           $post->post_keywords=$data['post_keywords'];
            $post->created_at=Carbon::now('Asia/Ho_Chi_Minh');
            $post->author_id=Auth::id();
            $get_image=$Request->file('post_img');
        if($get_image){
        $path='public/upload/post/'.$post->post_img;
        if(file::exists($path)){
        unlink($path);
    }
            $get_name_img=$get_image->getClientOriginalName();
            $name_img=current(explode('.', $get_name_img));
            $new_image=$name_img.rand(0,99999999999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/post',$new_image);
            $post->post_img=$new_image;
            $post->save();
            Session::flash('success','Thêm thành công');
            return Redirect::to('/all-post');}
        else{
            $post->save();
            Session::flash('success','Thêm thành công');
            return Redirect::to('/all-post');}
        }
  public function view_home_post(Request $Request){
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
      $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();

      $meta_desc='tin tuc';
      $meta_keywords='tin tuc';
      $meta_title='tin tuc';
      $url_canonical=$Request->url();
      $top=post::orderBy('post_id','desc')->where('post_status','0')->first();
      $post=post::orderBy('post_id','desc')->where('post_status','0')->paginate(5);
      $post_top_view=post::orderBy('post_views','desc')->where('post_status','0')->take(5)->get();
          return view('pages.post')->with(compact('post','meta_desc','meta_keywords','meta_title','url_canonical','cate_product','category_post','top','post_top_view'));
        }

  public function view_category_post(Request $Request,$category_post_slug){
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
      $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();
          $category_post_by_id=category_post::orderBy('category_post_id','desc')->where('category_post_status','0')->where('category_post_slug',$category_post_slug)->get();
      $post=post::orderBy('post_id','desc')->where('post_status','0')->join('tbl_category_post','tbl_category_post.category_post_id','=','tbl_post.post_category')->where('tbl_category_post.category_post_slug',$category_post_slug)->paginate(5);

  foreach ($category_post_by_id as $key => $value) {
      $meta_desc=$value->category_post_desc;
      $meta_keywords=$value->category_post_name;
      $meta_title=$value->category_post_name;
      $url_canonical=$Request->url();
      $category_post_name=$value->category_post_name;}
          return view('pages.category_post')->with(compact('category_post','meta_desc','meta_keywords','meta_title','url_canonical','cate_product','post','category_post_name'));
        }
  public function view_post_detail(Request $Request,$category_post_slug, $post_slug){
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
      $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();
      $post_by_id=post::orderBy('post_id','desc')->where('post_status','0')->where('post_slug',$post_slug)->get();
            if ($post_by_id->count()) {
        foreach ($post_by_id as $key => $value) {
        $meta_desc=$value->post_desc;
        $meta_keywords=$value->post_name;
        $meta_title=$value->post_name;
        $url_canonical=$Request->url();
    }
        $post = Post::where('post_slug',$post_slug)->first();
        $post->post_views = $post->post_views + 1;
        $post->save();
        $related_product=DB::table('tbl_product')->where('product_status','0')->limit(3)->get();
        // ->orderby(DB::raw('RAND()'))
          return view('pages.post_detail')->with(compact('category_post','meta_desc','meta_keywords','meta_title','url_canonical','cate_product','post_by_id','related_product'));
            }
            else{
                return view('pages.error.404');
            }
        }
        }
