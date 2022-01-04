<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Mail;
use App\category_post;
use DB;
use App\customer;
use Session;
use App\coupon;
session_start();
class mailController extends Controller
{
    public function send_mail(){
                $to_name = "mon dore";
                $to_email = "fandomixi13@gmail.com";//send to this email
        
                $data = array("name"=>"noi dung ten","body"=>"noi dung body"); //body of mail.blade.php
            
                Mail::send('pages.password.send_mail',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('test mail nhé');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });
                return Redirect('');
    }
    public function re_password(Request $Request){
      $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
      $meta_desc='password';
      $meta_keywords='password';
      $meta_title='password';
      $url_canonical=$Request->url();
      return view('pages.password.re_password')->with(compact('meta_desc','meta_title','meta_keywords','url_canonical','cate_product','category_post'));
    }
    public function send_password(Request $Request){
        $data=$Request->all();
        $customer=customer::where('email',$data['email'])->first();
        $token=Str::random(30);
        if($customer->password){
            $customer->re_token=$token;
            $customer->save();
                $to_name = "SM";
                $to_email = $customer->email;//send to this email
                $data = array("name"=>$customer->customer_name,"link"=>url('/reset-password?email='.$to_email.'&token='.$customer->re_token)); //body of mail.blade.php
                Mail::send('pages.password.send_mail',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('Smart-shop');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });
            echo 1;
        }
        if($customer->password==null){
            echo 2;
        }

    }
    public function view_reset_password(Request $Request){
    $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
      $meta_desc='password';
      $meta_keywords='password';
      $meta_title='password';
      $url_canonical=$Request->url();
      return view('pages.password.update_password')->with(compact('meta_desc','meta_title','meta_keywords','url_canonical','cate_product','category_post'));
    }
    public function update_password(Request $Request){
        $data=$Request->all();
        $customer=customer::where('email',$data['email'])->where('re_token',$data['re_token'])->first();
        $token=Str::random(30);
        if($customer){
            $customer->re_token=$token;
            $customer->password=md5($data['password']);
            $customer->save();
            echo 1;
        }
    }
    public function register(Request $Request){
    $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();

        $meta_desc='Đăng ký';
      $meta_keywords='Đăng ký';
      $meta_title='Đăng ký';
    $url_canonical=$Request->url();        
      $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
            return view('pages.Register')->with(compact('meta_desc','meta_keywords','meta_title','url_canonical','cate_product','category_post'));    
    }
    public function otp_mail(Request $Request){
        $data=$Request->all();
        if($data['otp']==Session::get('pp')){
            Session::put('pp',null);
            echo 2;
        }else{
            echo 1;
        }
        }
    public function register_mail(Request $Request){
        $data=$Request->all();
        $customer=customer::where('email',$data['email'])->first();
        $token=Str::random(30);
        if($customer){
            echo 1;
        }else{
            Session::put('pp',$token);
            Session::put('mm',$data['email']);
                $to_name = 'SM';
                $to_email = $data['email'];//send to this email
                $data = array("name"=>$data['email'],"token"=>$token); //body of mail.blade.php
                Mail::send('pages.password.register_mail',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('Smart-shop');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });
            echo 2;
            }
        }
    public function send_coupon(Request $Request,$coupon_id){
            $customer=customer::get();
            $coupon=coupon::where('coupon_id',$coupon_id)->first();
            if($coupon){
            foreach($customer as $key =>$val){
                $to_name = "SM";
                $to_email = $val->email;//send to this email
                $data = array("name"=>$coupon->coupon_name,"code"=>$coupon->coupon_code,
                "end"=>$coupon->coupon_date_end,"coupon_condition"=>$coupon->coupon_condition,
                "coupon_number"=>$coupon->coupon_number); //body of mail.blade.php
            
                Mail::send('admin.coupon.send_coupon',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('test mail nhé');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });}session()->flash('success','Gửi thành công');
            }else{
                session()->flash('error','Lỗi');}              
                return back();  
            }
    }
