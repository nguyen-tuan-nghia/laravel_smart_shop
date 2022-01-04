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
use Cart;
use App\city;
use App\province;
use App\wards;
use App\feeship;
use App\category_post;
use App\coupon;
use App\shipping;
use App\order;
use App\customer;
use Mail;
class CheckoutController extends Controller
{              
	public function authlogin(){
        $id=session::get('customer_id');
        if($id){
            return Redirect('/');
        }
        else{
            return Redirect('/login-checkout')->send();
        }}
    public function login_checkout(Request $Request){
    $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get(); 
    	$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
    	$category_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
        $meta_desc='Điện thoại chính hãng iPhone, Samsung, Oppo, Sony, HTC, LG… ✓Mua Online giá rẻ ✓Bảo hành chính hãng ✓Giao hàng toàn quốc ✓Cho phép đổi trả ✓';
      $meta_keywords='Điện thoại mới, điện thoại giá rẻ, smart phone 2021';
      $meta_title='Điện thoại chính hãng, giá rẻ, có hoàn trả';
      $url_canonical=$Request->url();
    	return view('pages.login_checkout')->with('cate_product',$category_product)->with('brand_product',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post);
    }
    public function login(Request $request){
    	$email=$request->email;
    	$password=md5($request->password);
    	$result=DB::table('tbl_customer')->where('email',$email)->where('password',$password)->first();
    	if ($result) {
    		Session::put('customer_name',$result->customer_name);
			Session::put('customer_id',$result->customer_id);
            Session::put('email',$result->email);
            Session::put('address',$result->address);
            Session::put('phone',$result->phone);
    		echo 2;
    	}
    	else{
            echo 1;
    	}
    }
        public function logout_checkout(){
                $this->authlogin();
                        // Session::put('cart',null);

    	    Session::put('customer_name',null);
			Session::put('customer_id',null);
            Session::put('email',null);
            Session::put('address',null);
            Session::put('shipping_name',null);
            Session::put('shipping_address',null);
            Session::put('shipping_phone',null);
            Session::put('phone',null);
            Session::put('fee',null);
            Session::put('coupon',null);
            Session::save();

    		return Redirect::to('/login-checkout');
    }
    public function save_customer(Request $Request){
    // 	$messages = [
    //     'required' => 'Trường :attribute bắt buộc nhập.'
    //     // 'email'    => 'Trường :attribute phải có định dạng email'
    // ];
    // $this->validate(request(), [
    //     'name' => 'required',
    //     'password' => 'required',
    //     // 'address' => 'required',
    //     'phone'=>'required',
    //     'email'=>'required',
    // ], $messages);
   		$data=new customer;
   		$data->customer_name=$Request->name;
   		$data->password=md5($Request->password);
   		// $data['address']=$Request->address;
   		$data->phone=$Request->phone;
   		$data->email=$Request->email;
        $data->address=$Request->address;
        $available=DB::table('tbl_customer')->where('email',$Request->email)->first();
        if ($available>0) {
            echo 1;
        }
        elseif(Session::get('mm')!=$Request->email){
            echo 3;
        }
        else{
   		$data->save();
            Session::put('customer_name',$Request->name);
            Session::put('customer_id',$data->customer_id);
            Session::put('email',$Request->email);
            Session::put('address',$Request->address);
            Session::put('phone',$Request->phone);
   		   echo 2;
    }
    }
    public function checkout(Request $Request){
    	$this->authlogin();
        $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();
    	$brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','desc')->get();
    	$category_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
        $meta_desc='Điện thoại chính hãng iPhone, Samsung, Oppo, Sony, HTC, LG… ✓Mua Online giá rẻ ✓Bảo hành chính hãng ✓Giao hàng toàn quốc ✓Cho phép đổi trả ✓';
      $meta_keywords='Điện thoại mới, điện thoại giá rẻ, smart phone 2021';
      $meta_title='Điện thoại chính hãng, giá rẻ, có hoàn trả';
      $url_canonical=$Request->url();
      $attr=DB::table('tbl_attribute')->get();
      $city=city::orderBy('matp','asc')->get();
      $product=DB::table('tbl_product')->get();
    return view('pages.checkout')->with('cate_product',$category_product)->with('brand_product',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('city',$city)->with('category_post',$category_post)->with('attr',$attr)->with('product',$product);
    }
    
    public function order_place(Request $Request){
      $url_canonical=$Request->url();        
      $data=$Request->all();
      if(Session::get('coupon')){
    foreach(Session::get('coupon') as $key => $cou){
        $cou_code=$cou['coupon_code'];
    }

      $coupon=coupon::where('coupon_code',$cou_code)->first();
      if ($coupon) {
          $coupon->coupon_quantity=$coupon->coupon_quantity-1;
          $coupon->coupon_status=$coupon->coupon_status.','.Session::get('customer_id');
          $coupon->save();
      }}
        $ship=new shipping;
        $ship->shipping_name=Session::get('shipping_name');
        $ship->shipping_address=Session::get('shipping_address');
        $ship->shipping_phone=Session::get('shipping_phone');
        $ship->shipping_method=$data['payment'];
        $ship->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        $ship->shipping_notes=$data['order_message'];
        $ship->save();

        $odata=new order;
        $odata->shipping_id=$ship->shipping_id;
        $odata->customer_id=Session::get('customer_id');
        $odata->payment_type=$data['payment'];
        $odata->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        // $odata['message']=$data['order_message'];
        $odata->order_status=1;
        $odata->save();

$content=Cart::content();
foreach ($content as $v_content) {
        
        $oodata['order_id']=$odata->order_id;
        $oodata['product_id']=$v_content->id;
        $oodata['product_name']=$v_content->name;
        $oodata['product_image']=$v_content->options->image;

        $oodata['product_color']=$v_content->options->color;
        $oodata['product_size']=$v_content->options->size;
        $oodata['attribute_id']=$v_content->options->attribute_id;

        $oodata['product_price']=$v_content->price;
        $oodata['product_sales_quantity']=$v_content->qty;
        $oodata['coupon_text']=$data['coupon_text'];
        $oodata['product_feeship']=$data['order_fee'];
        $result=DB::table('tbl_order_detail')->insert($oodata);
    }
    Cart::destroy();
    Session::put('coupon',null);
    Session::save();
    $to_name = "SM";
    $to_email = Session::get('email');//send to this email
    $data = array("code"=>"Bạn đã đặt mua thành công, đơn hàng của bạn sẽ được cập nhật trên trang lịch sử đơn hàng của bạn"); //body of mail.blade.php
    Mail::send('pages.mail.mail_order_status',$data,function($message) use ($to_name,$to_email){
        $message->to($to_email)->subject('Smart-shop');//send this mail with subject
        $message->from($to_email,$to_name);//send from this mail
    });
}
        public function edit_customer_checkout(Request $Request){
            $message=[
                'name.required'=>'Bạn chưa điền tên',
                'address.required'=>'Bạn chưa điền địa chỉ',
                'phone.required'=>'Bạn chưa điền số điện thoại',
                'email.required'=>'Bạn chưa điền email',
            ];
            $this->validate(request(),[
                'name'=>'required',
                'address'=>'required',
                'phone'=>'required',
                'email'=>'required',
            ],$message);
            $data=$Request->all();
            $customer=array();
            $customer['customer_name']=$data['name'];
            $customer['address']=$data['address'];
            $customer['phone']=$data['phone'];
            // $customer['email']=$data['email'];
            DB::table('tbl_customer')->where('customer_id',$data['customer_id'])->update($customer);
            Session::put('customer_name',$data['name']);
            Session::put('email',$data['email']);
            Session::put('address',$data['address']);
            Session::put('phone',$data['phone']);
        }

        public function insert_fee(Request $Request){
            $data=$Request->all();
            if ($data['city']) {
            $feeship=feeship::where('fee_matp',$data['city'])->where('fee_maqh',$data['province'])
            ->where('fee_xaid',$data['wards'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                $diachi=''.$data['city_text'].'-'.$data['province_text'].'-'.$data['wards_text'].'-'.$data['shipping_address'].'';
                Session::put('shipping_address',$diachi);
                Session::put('shipping_name',$data['shipping_name']);
                Session::put('shipping_phone',$data['shipping_phone']);
                     foreach($feeship as $key => $fee){
                        Session::put('fee',$fee->fee_feeship);
                        Session::save();
                    }
                }else{
                $diachi=''.$data['city_text'].'-'.$data['province_text'].'-'.$data['wards_text'].'-'.$data['shipping_address'].'';
                Session::put('shipping_address',$diachi);
                Session::put('shipping_name',$data['shipping_name']);
                Session::put('shipping_phone',$data['shipping_phone']);
                    Session::put('fee',25000);
                    Session::save();
                }
            } 
        }
        $attr=DB::table('tbl_attribute')->get();
        $city=city::orderBy('matp','asc')->get();
        $product=DB::table('tbl_product')->get();
        return view('pages.fetch.checkout')->with('city',$city)->with('attr',$attr)->with('product',$product)->render();
        }
        public function handcash(Request $Request){
            $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();

        $meta_desc='Điện thoại chính hãng iPhone, Samsung, Oppo, Sony, HTC, LG… ✓Mua Online giá rẻ ✓Bảo hành chính hãng ✓Giao hàng toàn quốc ✓Cho phép đổi trả ✓';
      $meta_keywords='Điện thoại mới, điện thoại giá rẻ, smart phone 2021';
      $meta_title='Điện thoại chính hãng, giá rẻ, có hoàn trả';
        $url_canonical=$Request->url();        
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
            return view('pages.handcash')->with(compact('meta_desc','meta_keywords','meta_title','url_canonical','cate_product','category_post'));
        }
}
