<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
validator();
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use App\customer; //sử dụng model Login
use App\category_post;
use App\category;
use DB;
use Cart;
use App\shipping;
use App\order;
use Mail;
use App\coupon;
use Illuminate\Support\Str;
class socialController extends Controller
{
     public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = customer::where('customer_id',$account->userz)->first();
            Session::put('customer_name',$account_name->customer_name);
            Session::put('customer_id',$account_name->customer_id);
            Session::put('email',$account_name->email);
            Session::put('address',$account_name->address);
            Session::put('phone',$account_name->phone);
            return redirect('/');
        }else{
            $soci = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);
            $orang = customer::where('email',$provider->getEmail())->first();

            if(!$orang){
                $orang = customer::create([
                    'customer_name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'address'=>'',
                ]);
            }
            $soci->login()->associate($orang);
            $soci->save();

            $account_name = customer::where('customer_id',$soci->userz)->first();
            Session::put('customer_name',$account_name->customer_name);
             Session::put('customer_id',$account_name->customer_id);
            Session::put('email',$account_name->email);
            Session::put('address',null);
            Session::put('phone',null);
            return redirect('/');
        } 
    }
    public function login_google(){
        return Socialite::driver('google')->redirect();
   }
    public function callback_google(){
        $provider = Socialite::driver('google')->user();
        $account = Social::where('provider','google')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = customer::where('customer_id',$account->userz)->first();
            Session::put('customer_name',$account_name->customer_name);
            Session::put('customer_id',$account_name->customer_id);
            Session::put('email',$account_name->email);
            Session::put('address',$account_name->address);
            Session::put('phone',$account_name->phone);
            return redirect('/');
        }else{
            $soci = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'google'
            ]);
            $orang = customer::where('email',$provider->getEmail())->first();

            if(!$orang){
                $orang = customer::create([
                    'customer_name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'address'=>'',
                ]);
            }
            $soci->login()->associate($orang);
            $soci->save();

            $account_name = customer::where('customer_id',$soci->userz)->first();
            Session::put('customer_name',$account_name->customer_name);
             Session::put('customer_id',$account_name->customer_id);
            Session::put('email',$account_name->email);
            Session::put('address',null);
            Session::put('phone',null);
            return redirect('/');
        } 
}
    public function vnpay(Request $Request){
    $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();

        $meta_desc='vnpay';
      $meta_keywords='vnpay';
      $meta_title='vnpay';
        $url_canonical=$Request->url();        
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
            return view('pages.vnpay')->with(compact('meta_desc','meta_keywords','meta_title','url_canonical','cate_product','category_post'));
    }
public function create_vnpay(Request $request)
    {
        session(['cost_id' => session::get('customer_id')]);
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "UDOPNWS1"; //Mã website tại VNPAY 
        $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = url('/return-vnpay');
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->Amount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }
public function return_vnpay(Request $request){
    $url = session('url_prev','/');
    if($request->vnp_ResponseCode == "00") {
     $url_canonical=$request->url();        
      $data=$request->all();
      if(Session::get('coupon')){
    foreach(Session::get('coupon') as $key => $cou){
        $cou_code=$cou['coupon_code'];
    }
      $coupon=coupon::where('coupon_code',$cou_code)->first();
      if ($coupon) {
          $coupon->coupon_quantity=$coupon->coupon_quantity-1;
          $coupon->coupon_status=$coupon->coupon_status.','.Session::get('customer_id');
          $coupon->save();
      }}else{
        $cou_code=null;
      }
        $ship=new shipping;
        $ship->shipping_name=Session::get('shipping_name');
        $ship->shipping_address=Session::get('shipping_address');
        $ship->shipping_phone=Session::get('shipping_phone');
        $ship->shipping_method="VNPAY";
        $ship->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        // $ship['shipping_notes']=$data['order_message'];
        $ship->save();

        $odata=new order;
        $odata->shipping_id=$ship->shipping_id;
        $odata->customer_id=Session::get('customer_id');
        $odata->payment_type="VNPAY";
        $odata->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        $odata->order_status=1;
        $odata->save();

$content=Cart::content();
foreach ($content as $v_content) {
        $oodata['coupon_text']=$cou_code;
        $oodata['order_id']=$odata->order_id;
        $oodata['product_id']=$v_content->id;
        $oodata['product_name']=$v_content->name;
        $oodata['product_image']=$v_content->options->image;
        $oodata['product_color']=$v_content->options->color;
        $oodata['product_size']=$v_content->options->size;
        $oodata['attribute_id']=$v_content->options->attribute_id;
        $oodata['product_price']=$v_content->price;
        $oodata['product_sales_quantity']=$v_content->qty;
        $oodata['product_feeship']=Session::get('fee');
        DB::table('tbl_order_detail')->insert($oodata);
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
    return redirect('/thanh-toan-thanh-cong');
    }
    session()->forget('url_prev');
    return back();
}
public function create_momo(Request $Request)
    {
    $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
    $partnerCode = "MOMOBKUN20180529";
    $accessKey = "klm05TvNBzhg7h7j";
    $serectkey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
    $orderInfo = "Thanh toán qua MoMo";
    $amount = filter_var($Request->momo_Amount, FILTER_SANITIZE_NUMBER_INT);
    $orderId = time() ."";
    $returnUrl = url('/checkout');
    $notifyurl = url('/notifyurl-momo');
    // Lưu ý: link notifyUrl không phải là dạng localhost
    $extraData = "merchantName=MoMo Partner";
    $requestId = time() . "";
    $requestType = "captureMoMoWallet";
    $extraData = ($extraData ? $extraData : "");
    //before sign HMAC SHA256 signature
    $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . 
    "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
    $signature = hash_hmac("sha256", $rawHash, $serectkey);
    $data = array('partnerCode' => $partnerCode,
        'accessKey' => $accessKey,
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'returnUrl' => $returnUrl,
        'notifyUrl' => $notifyurl,
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data)))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    $jsonResult = json_decode($result, true);  // decode json
    $url=$jsonResult['payUrl'];
    return redirect($url);
}

    public function notifyurl_momo(Request $request){
      $data=$request->all();
      if(Session::get('coupon')){
    foreach(Session::get('coupon') as $key => $cou){
        $cou_code=$cou['coupon_code'];
    }
      $coupon=coupon::where('coupon_code',$cou_code)->first();
      if ($coupon) {
          $coupon->coupon_quantity=$coupon->coupon_quantity-1;
          $coupon->coupon_status=$coupon->coupon_status.','.Session::get('customer_id');
          $coupon->save();
      }}else{
        $cou_code=null;
      }
        $ship=new shipping;
        $ship->shipping_name=Session::get('shipping_name');
        $ship->shipping_address=Session::get('shipping_address');
        $ship->shipping_phone=Session::get('shipping_phone');
        $ship->shipping_method="MoMo";
        $ship->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        // $ship['shipping_notes']=$data['order_message'];
        $ship->save();

        $odata=new order;
        $odata->shipping_id=$ship->shipping_id;
        $odata->customer_id=Session::get('customer_id');
        $odata->payment_type="MoMo";
        $odata->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        $odata->order_status=1;
        $odata->save();

$content=Cart::content();
foreach ($content as $v_content) {
        $oodata['coupon_text']=$cou_code;
        $oodata['order_id']=$odata->order_id;
        $oodata['product_id']=$v_content->id;
        $oodata['product_name']=$v_content->name;
        $oodata['product_image']=$v_content->options->image;
        $oodata['product_color']=$v_content->options->color;
        $oodata['product_size']=$v_content->options->size;
        $oodata['attribute_id']=$v_content->options->attribute_id;
        $oodata['product_price']=$v_content->price;
        $oodata['product_sales_quantity']=$v_content->qty;
        $oodata['product_feeship']=Session::get('fee');
        DB::table('tbl_order_detail')->insert($oodata);
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
    return redirect('/thanh-toan-thanh-cong');    
}
}
