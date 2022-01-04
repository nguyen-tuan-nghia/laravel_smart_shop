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

class category_productController extends Controller
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
   public function add_category_product(){
    $this->authlogin();
    $category = DB::table('tbl_category_product')->where('category_parent',0)->orderBy('category_id','DESC')->get();
   		return view('admin.category.add_category_product')->with(compact('category'));
   }
   public function all_category_product(){
    $this->authlogin();
    $category_product =DB::table('tbl_category_product')->where('category_parent',0)->orderBy('category_id','DESC')->get();
   	$all_category=DB::table('tbl_category_product')->get();
   	$manager_category_product=view('admin.category.all_category_product')->with("all_category_product",$all_category)->with('category_product',$category_product);

   		return view('layout_Admin')->with('admin.category..all_category_product',$manager_category_product);
   }
   public function unaction_category_product($category_id){
    $this->authlogin();
   	DB::table('tbl_category_product')->where('category_id', $category_id)->update(['category_status'=>1]);
   	session()->flash('success', 'Ẩn trạng thái thành công');

   		return Redirect('/all-category-product');
   }
      public function action_category_product($category_id){
        $this->authlogin();
   	DB::table('tbl_category_product')->where('category_id', $category_id)->update(['category_status'=>0]);
   	session()->flash('success', 'Hiện trạng thái thành công');

   		return Redirect('/all-category-product');
   }
   public function save_category_product(Request $Request){
    $this->authlogin();
      $messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'category_product_name' => 'required',
        'category_product_desc' => 'required',
        'category_product_status' => 'required',
        'meta_keywords'=> 'required',
        'slug_category' => 'required'
    ], $messages);
   		$data=array();
   		$data['category_name']=$Request->category_product_name;
   		$data['category_desc']=$Request->category_product_desc;
      $data['category_status']=$Request->category_product_status;
   		$data['meta_keywords']=$Request->meta_keywords;
      $data['slug_category']=$Request->slug_category;
      $data['category_parent']=$Request->category_parent;
   		$data['created_at']=Carbon::now('Asia/Ho_Chi_Minh');

   		$result= DB::table('tbl_category_product')->insert($data);
   			// Session::put('message','Thêm danh mục thành công');
   			    session()->flash('success', 'thêm mới thành công');
   		return back();}

   public function edit_category_product($category_id){
    $this->authlogin();
    $category = DB::table('tbl_category_product')->orderBy('category_id','DESC')->get();

    $all_category=DB::table('tbl_category_product')->where('category_id', $category_id)->get();
    $manager_category_product=view('admin.category.edit_category_product')->with("edit_category_product",$all_category)->with("category",$category);

      return view('layout_Admin')->with('admin.category.edit_category_product',$manager_category_product);
   }
      public function delete_category_product($category_id){
        $this->authlogin();
 DB::table('tbl_category_product')->where('category_id', $category_id)->delete();
        // Session::put('message','Thêm danh mục thành công');
            session()->flash('success', 'Xóa thành công');
      return Redirect('/all-category-product');
   }
      public function update_category_product(Request $Request,$category_id ){
        $this->authlogin();
         $messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'category_product_name' => 'required',
        'category_product_desc' => 'required',
        'meta_keywords'=> 'required',
        'slug_category' => 'required'
    ], $messages);
      $data=array();
      $data['category_name']=$Request->category_product_name;
      $data['category_desc']=$Request->category_product_desc;
      $data['meta_keywords']=$Request->meta_keywords;
      $data['slug_category']=$Request->slug_category;
      $data['category_parent']=$Request->category_parent;
      $data['updated_at']=Carbon::now('Asia/Ho_Chi_Minh');

      $result= DB::table('tbl_category_product')->where('category_id', $category_id)->update($data);
        // Session::put('message','Thêm danh mục thành công');
            session()->flash('success', 'Sửa thành công');
      return back();
      }
  public function show_category_home(Request $Request,$slug_category){        
        $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();   
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')
        ->get();
        $category=DB::table('tbl_category_product')->where('slug_category',$slug_category)->first();
        $category_by_id_farent=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_parent',$category->category_id)->orderBy('product_id','DESC')->get();
        if($category_by_id_farent->count()){
            $category_by_id=$category_by_id_farent;
            $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','ASC')->where('category_id',$category->category_id)->get();
        }
        else{
            $category_by_id=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.slug_category',$slug_category)->orderBy('product_id','DESC')->get();
            $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','ASC')->where('category_id',$category->category_parent)->get();
        }
        $cate_slug=DB::table('tbl_category_product')->where('slug_category',$slug_category)->where('category_status','0')->orderBy('category_id','DESC')->get();

        foreach ($cate_slug as $key => $value) {
      $meta_desc=$value->category_desc;
      $meta_keywords=$value->meta_keywords;
      $meta_title=$value->category_name; 
      $url_canonical=$Request->url();
        }
        $category_name=DB::table('tbl_category_product')->where('slug_category',$slug_category)->first();
    return view('pages.show_category_home')->with('category_name',$category_name)->with('category_by_id',$category_by_id)->with('brand_product',$brand_product)->with('cate_product',$cate_product)->with('category_post',$category_post)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with('category',$category);
}
    public function category_fetch_home_brand(Request $Request){
    if($Request->ajax()){
        $data=$Request->all();
        $category=DB::table('tbl_category_product')->where('slug_category',$data['slug'])->first();
        $category_by_id_farent=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_parent',$category->category_id)->orderBy('product_id','DESC')->get();
    if(isset($data['brand'])){
        $category_by_idd=DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_status','0')->whereIn('tbl_brand.brand_id',$data['brand'])->orderBy('product_id','DESC')->get();
        if($category_by_idd->count()>0){
            $category_by_id=$category_by_idd;
        }
    }
    else{
        if($category_by_id_farent->count()){
            $category_by_id=$category_by_id_farent;
        }
        else{
            $category_by_id=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.slug_category',$category->slug_category)->orderBy('product_id','DESC')->get();
        }
    }
        $category_name=DB::table('tbl_category_product')->where('slug_category',$category->slug_category)->first();
    return view('pages.fetch.category')->with(compact('category_name','category_by_id'))->render();}
}

    public function category_fetch_home_price(Request $Request){
    if($Request->ajax()){
        $data=$Request->all();
        $category=DB::table('tbl_category_product')->where('slug_category',$data['slug'])->first();
        $category_by_id_farent=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_parent',$category->category_id)->orderBy('product_id','DESC')->get();
    if(isset($data['price'])){
        if($category_by_id_farent->count()){
        if ($data['price']==1) {
            $category_by_idd=DB::table('tbl_product')->where('product_status','0')->where('product_price','<',1000000)->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_parent',$category->category_id)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==2){
            $category_by_idd=DB::table('tbl_product')->where('product_status','0')->whereBetween('product_price',[1000000,5500000])->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_parent',$category->category_id)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==3){
            $category_by_idd=DB::table('tbl_product')->where('product_status','0')->whereBetween('product_price',[5500000,10500000])->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_parent',$category->category_id)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==4){
            $category_by_idd=DB::table('tbl_product')->where('product_status','0')->whereBetween('product_price',[10500000,20500000])->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_parent',$category->category_id)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==5){
            $category_by_idd=DB::table('tbl_product')->where('product_status','0')->where('product_price','>=',20500000)->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_parent',$category->category_id)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
    }else{
        if ($data['price']==1) {
            $category_by_idd=DB::table('tbl_product')->where('product_status','0')->where('product_price','<',1000000)->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_id',$category->category_id)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==2){
            $category_by_idd=DB::table('tbl_product')->where('product_status','0')->whereBetween('product_price',[1000000,5500000])->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_id',$category->category_id)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==3){
            $category_by_idd=DB::table('tbl_product')->where('product_status','0')->whereBetween('product_price',[5500000,10500000])->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_id',$category->category_id)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==4){
            $category_by_idd=DB::table('tbl_product')->where('product_status','0')->whereBetween('product_price',[10500000,20500000])->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_id',$category->category_id)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==5){
            $category_by_idd=DB::table('tbl_product')->where('product_status','0')->where('product_price','>=',20500000)->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_id',$category->category_id)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }        
    }
}
    else{
        if($category_by_id_farent->count()){
            $category_by_id=$category_by_id_farent;
        }
        else{
            $category_by_id=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.slug_category',$category->slug_category)->orderBy('product_id','DESC')->get();
        }
    }
        $category_name=DB::table('tbl_category_product')->where('slug_category',$category->slug_category)->first();
    return view('pages.fetch.category')->with(compact('category_name','category_by_id'))->render();}
}
    public function category_fetch_home_all(Request $Request){
    if($Request->ajax()){
        $data=$Request->all();
        $category=DB::table('tbl_category_product')->where('slug_category',$data['slug'])->first();
        $category_by_id_farent=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.category_parent',$category->category_id)->orderBy('product_id','DESC')->get();
        if(isset($data['price'])&&isset($data['brand'])){
        if ($data['price']==1) {
            $category_by_idd=DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_status','0')->whereIn('tbl_brand.brand_id',$data['brand'])->where('product_price','<',1000000)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==2){
            $category_by_idd=DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_status','0')->whereIn('tbl_brand.brand_id',$data['brand'])->whereBetween('product_price',[1000000,5500000])->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==3){
            $category_by_idd=DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_status','0')->whereIn('tbl_brand.brand_id',$data['brand'])->whereBetween('product_price',[5500000,10500000])->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==4){
            $category_by_idd=DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_status','0')->whereIn('tbl_brand.brand_id',$data['brand'])->whereBetween('product_price',[10500000,20500000])->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
        elseif($data['price']==5){
            $category_by_idd=DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_status','0')->whereIn('tbl_brand.brand_id',$data['brand'])->where('product_price','>=',20500000)->orderBy('product_id','DESC')->get();
            if($category_by_idd->count()>0){
                $category_by_id=$category_by_idd;
            }
        }
    }
    // else{
    //     if($category_by_id_farent->count()){
    //         $category_by_id=$category_by_id_farent;
    //     }
    //     else{
    //         $category_by_id=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('product_status',0)->where('tbl_category_product.slug_category',$data['slug'])->orderBy('product_id','DESC')->get();
    //     }
    // }
        $category_name=DB::table('tbl_category_product')->where('slug_category',$category->slug_category)->first();
    return view('pages.fetch.category')->with(compact('category_name','category_by_id'))->render();}}
}

