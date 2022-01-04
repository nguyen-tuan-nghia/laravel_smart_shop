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
use App\category_post;
use App\order;
use Cart;
use App\customer;
use App\product;
use App\Visitors;
use App\coupon;
use App\feedback;
use App\feedback_img;
use File;
class homecontroller extends Controller
{
    public function authlogin(){
        $id=session::get('customer_id');
        if($id){
            return Redirect('/');
        }
        else{
            return Redirect('/login-checkout')->send();
        }}

    public function index(Request $Request){
    $user_ip_address = $Request->ip();  
    $visitors_current = Visitors::where('ip_address',$user_ip_address)->get();  
    $visitor_count = $visitors_current->count();
    if($visitor_count<1){
        $visitor = new Visitors();
        $visitor->ip_address = $user_ip_address;
        $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $visitor->save();
    }
      $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();
      $slider=slider::where('slider_status',0)->where('slider_type',0)->orderBy('slider_id','DESC')->limit(3)->get();
      $slider1=slider::where('slider_status',0)->where('slider_type',1)->orderBy('slider_id','DESC')->limit(2)->get();
      $slider2=slider::where('slider_status',0)->where('slider_type',2)->orderBy('slider_id','DESC')->limit(2)->get();
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
      $meta_desc='Điện thoại chính hãng iPhone, Samsung, Oppo, Sony, HTC, LG… ✓Mua Online giá rẻ ✓Bảo hành chính hãng ✓Giao hàng toàn quốc ✓Cho phép đổi trả ✓';
      $meta_keywords='Điện thoại mới, điện thoại giá rẻ, smart phone 2021';
      $meta_title='Điện thoại chính hãng, giá rẻ, có hoàn trả';
      $url_canonical=$Request->url();
      //->orderby(DB::raw('RAND()'))
    	$new_product=DB::table('tbl_product')->where('product_status','0')->orderBy('tbl_product.product_id','DESC')->limit(4)->get();
      $all_product=DB::table('tbl_product')->where('product_status','0')->orderBy('tbl_product.product_id','ASC')->limit(6)->get();
      $laptop=DB::table('tbl_product')->where('product_status','0')->orderBy('tbl_product.product_id','ASC')->where('product_name','like','%Laptop%')->limit(3)->get();
      $mac=DB::table('tbl_product')->where('product_status','0')->orderBy('tbl_product.product_id','ASC')->where('product_name','like','%Macbook%')->limit(3)->get();
      return view('pages.home')->with(compact('meta_desc','meta_title','meta_keywords','url_canonical','new_product','cate_product','all_product','slider','slider1','slider2','laptop','category_post','mac'));
    }

    public function search(Request $Request){
      $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();
      $meta_desc='Điện thoại chính hãng iPhone, Samsung, Oppo, Sony, HTC, LG… ✓Mua Online giá rẻ ✓Bảo hành chính hãng ✓Giao hàng toàn quốc ✓Cho phép đổi trả ✓';
      $meta_keywords='Điện thoại mới, điện thoại giá rẻ, smart phone 2021';
      $meta_title='Điện thoại chính hãng, giá rẻ, có hoàn trả';
      $url_canonical=$Request->url();
    $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
    $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','DESC')->get();

    $Search = $Request->input('Search');
if($Search!=""){

   	$product_search=DB::table('tbl_product')->where('product_name', 'like', '%'.$Search.'%')->orderBy('product_id','DESC')->get();
   	// $product_search->appends(['Search' => $Search]);}
   }
   	else{
        return view('pages.error.404');
   	}
    return view('pages.search')->with('product_search',$product_search)->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post);
    }

    public function avata(Request $Request){
      $this->authlogin();
      $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','asc')->get();
      $customer=customer::where('customer_id',Session::get('customer_id'))->first();
      $meta_desc='tai khoan';
      $meta_keywords='tai khoan';
      $meta_title='tai khoan';
      $url_canonical=$Request->url();
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','DESC')->get();
    $today=Carbon::now('Asia/Ho_Chi_Minh');
    $feedback=feedback::where('customer_id',Session::get('customer_id'))->orderBy('feedback_id','DESC')->get();//
    $feedback_img=feedback_img::get();
    $coupon=coupon::where('coupon_quantity','>','0')->where('coupon_date_end','>=',$today)->get();
    $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','DESC')->get();
      return view('pages.avata')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with('customer',$customer)->with('today',$today)->with('coupon',$coupon)->with(compact('feedback','feedback_img'));
    } 
    public function history(Request $Request){
      $this->authlogin();
      $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','asc')->get();
      $customer=customer::where('customer_id',Session::get('customer_id'))->first();
      $meta_desc='lịch sử mua hàng';
      $meta_keywords='lịch sử mua hàng';
      $meta_title='lịch sử mua hàng';
      $url_canonical=$Request->url();
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','DESC')->get();
         $getorder=order::where('customer_id',Session::get('customer_id'))->where('order_status','!=',3)->orderBy('order_id','DESC')->paginate(5);
      $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','DESC')->get();
      return view('pages.history')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with('getorder',$getorder)->with('customer',$customer);
    }
    public function history_order(Request $Request,$order_id){
          $this->authlogin();
      $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','asc')->get();
      $meta_desc='lich su dat hang';
      $meta_keywords='lich su dat hang';
      $meta_title='lich su dat hang';
      $url_canonical=$Request->url();
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','DESC')->get();
    $shipping=DB::table('tbl_order')->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')->where('order_id',$order_id)->get();
    foreach($shipping as $key => $ship){
      $shipp=$ship->payment_type;
    }
    $shipping_detail1=DB::table('tbl_order')->where('order_id',$order_id)->get();
    $order_detail=DB::table('tbl_order_detail')->join('tbl_product','tbl_product.product_id','=','tbl_order_detail.product_id')->select('tbl_product.*','tbl_order_detail.*')->where('order_id', $order_id)->get();
    foreach ($order_detail as $key => $value) {
      $coupon_text=$value->coupon_text;
    }
    if($coupon_text!=null){
      $coupon=DB::table('tbl_coupon')->where('coupon_code',$coupon_text)->first();
          $coupon_number=$coupon->coupon_number;
          $coupon_condition=$coupon->coupon_condition;
    }
    else{
          $coupon_number=0;
          $coupon_condition=2;
}
    $feedback=feedback::where('order_id',$order_id)->get();
      return view('pages.view_history_order')->with(compact('shipping_detail1','order_detail','coupon_number','coupon_condition','shipping','category_post','cate_product','meta_desc','meta_keywords','meta_title','url_canonical','shipp','feedback'));
    }
    public function huy_order($order_id){
      $order=order::where('order_id',$order_id)->first();
      $order->order_status=3;
      $order->save();
      return Redirect::to('/');
    }
    public function dem_so()
    {
      $output='';
      $output.='<div class="bottom-right">'.Cart::count().'</div>';
      echo $output;

    }
    public function doi_mat_khau_kh(Request $Request)
    {
      $data=$Request->all();
      $customer=customer::where('customer_id',$data['id'])
      ->where('password',md5($data['password_old']))->get();
      if ($customer->count()) {
        foreach( $customer as $key =>$cut){
        $cut->password=md5($data['password_new']);
        $cut->save();}
        echo 2;
      }
      else{
        echo 1;
      }

    }
    public function update_avata(Request $Request)
    {
        $get_image = $Request->file('file');
        $id = $Request->id;
        if($get_image){
                $cus = customer::find($id);
                if($cus->customer_img!=null){
                  $path='public/upload/avata/'.$cus->customer_img;
                  if(File::exists($path)){
                    unlink($path);
                  }
                }
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/upload/avata',$new_image);
                $cus->customer_img = $new_image;
                $cus->save();
                echo 1;
            
        }
        else{
          echo 2;
        }
    }
        public function delete_img(Request $Request)
    {
        $id = $Request->id;
                $cus = customer::find($id);
                if($cus->customer_img!=null){
                  $path='public/upload/avata/'.$cus->customer_img;
                  if(File::exists($path)){
                    unlink($path);
                  }
                  $cus->customer_img=null;
                  $cus->save();
                  echo 1;
}
                else{
                  echo 2;
                }
    }
    public function search_ajax(Request $Request)
    {
              $data = $Request->all();

        if($data['query']){

            $product = product::where('product_status',0)->where('product_name','LIKE','%'.$data['query'].'%')->get();

            $output = '
            <ul class="dropdown-menu" style="display:block; position:absolute">'
            ;

            foreach($product as $key => $val){
               $output .= '
               <p><li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>
               ';
            }

            $output .= '</ul>';
            echo $output;
        }
    }
    public function them_gio(){
      $output='';
      if(Cart::count()){
      foreach(Cart::content() as $key =>$val){
      $output.='<li ><table><tr>';
      $output.='<td><img style="width:40px" src="'.url('public/upload/product/'.$val->options->image).'"></td><td  style=" word-break: break-all;max-width:100px;min-width:100px">'.$val->name.'</td><td style="min-width:100px;max-width:100px"> '.$val->options->color.' '.$val->options->size.'</td><td style="min-width:50px;max-width:50px"> X'.$val->qty.'</td><td> '.number_format($val->price,0,',','.').'VMD</td>';}
      $output.='</tr></table></li>';
      $output.='<li><a class"btn btn-fefault" href="'.url('/show-cart').'" style="background:#FF2300FF;margin-left:300px;color:white">Mua ngay</a></li>';
      }else{
      $output.='<li style="color:red">THÊM SẢN PHẨM VÀO GIỎ</li>';
      }
      echo $output;
    }
}
