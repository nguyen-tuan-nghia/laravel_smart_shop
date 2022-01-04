<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\statistic;
use Carbon\Carbon;
use Auth;
use App\admin;
use App\Visitors;
use App\product;
use App\post;
use App\order;
use App\customer;

class AdminController extends Controller
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
    public function index(){
    	return view('pages.admin_login');  
    }
    public function show_dashboard(Request $request){
    $this->authlogin();
    $user_ip_address = $request->ip();  

    $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();

    $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

    $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();

    $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        //total last month
    $visitor_of_lastmonth = Visitors::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get(); 
    $visitor_last_month_count = $visitor_of_lastmonth->count();

        //total this month
    $visitor_of_thismonth = Visitors::whereBetween('date_visitor',[$early_this_month,$now])->get(); 
    $visitor_this_month_count = $visitor_of_thismonth->count();

        //total in one year
    $visitor_of_year = Visitors::whereBetween('date_visitor',[$oneyears,$now])->get(); 
    $visitor_year_count = $visitor_of_year->count();

        //total visitors
    $visitors = Visitors::all();
    $visitors_total = $visitors->count();

        //current online
    $visitors_current = Visitors::where('ip_address',$user_ip_address)->get();  
    $visitor_count = $visitors_current->count();

    if($visitor_count<1){
        $visitor = new Visitors();
        $visitor->ip_address = $user_ip_address;
        $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $visitor->save();
    }

        //total 
    $product = product::all()->count();
    $post = post::all()->count();
    $order = order::all()->count();
    // $video = Video::all()->count();
    $customer = customer::all()->count();

    $product_views = product::orderBy('product_views','DESC')->take(20)->get();
    $post_views = post::orderBy('post_views','DESC')->take(20)->get();


    return view('admin.dashboard')->with(compact('visitors_total','visitor_count','visitor_last_month_count','visitor_this_month_count','visitor_year_count','product','post','order','customer','product_views','post_views'));}

  	public function dashboard(Request $request){
   //  	$admin_email=$request->admin_email;
   //  	$admin_password=md5($request->admin_password);
   //  	$result=DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
   //  	if ($result) {
   //  		Session::put('admin_name',$result->admin_name);
			// Session::put('admin_id',$result->admin_id);
   //  		return Redirect::to('/dashboard');
   //  	}
   //  	else{
   //  		Session::put('message','nhập sai tài khoản hoặc mặt khẩu');
   //  		return Redirect::to('/admin');
   //  	}
        $admin_email=$request->admin_email;
        $admin_password=$request->admin_password;
     if (Auth::attempt(['admin_email'=>$admin_email,'admin_password'=>$admin_password])) {
        if(Auth::user()->hasAnyRoles(['admin','author','reply'])){
         Session::put('admin_name',Auth::user()->admin_name);
            Session::put('admin_id',Auth::user()->admin_id);
         return Redirect::to('/dashboard');}
        if(Auth::user()->hasRole('admin')){
         Session::put('admin_name',Auth::user()->admin_name);
            Session::put('admin_id',Auth::user()->admin_id);
         return Redirect::to('/dashboard');}
         else{
         return Redirect::to('/admin');
         }
     }
     else{
         Session::put('message','nhập sai tài khoản hoặc mặt khẩu');
         return Redirect::to('/admin');
     }
    }
    public function logout(){
        $this->authlogin();
    	Session::put('admin_name',null);
		Session::put('admin_id',null);
    	return Redirect::to('/admin');
    }
    public function filter_by_date(Request $Request){
    $data = $Request->all();
    $from_date = $data['from_date'];
    $to_date = $data['to_date'];
    $get = statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
    if($get->count()>0){
    foreach($get as $key => $val){
        $chart_data[] = array(
            'period' => $val->order_date,
            'order' => $val->total_order,
            'sales' => $val->sales,
            'profit' => $val->profit,
            'quantity' => $val->quantity
        );
    }
    echo $data = json_encode($chart_data);  
    }else{
        $chart_data[] = array(
            'period' => 0,
            'order' => 0,
            'sales' => 0,
            'profit' => 0,
            'quantity' => 0
        );
    echo $data = json_encode($chart_data);      
    }
}
    public function dashboard_filter(Request $Request){
        $data=$Request->all();
        $dauthang=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthang_truoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithang_truoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $bay_ngay=Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $motnam=Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if ($data['dashboard_value']=='thangnay') {
            $get=statistic::whereBetween('order_date',[$dauthang,$now])->orderBy('order_date','ASC')->get();
        }
        elseif ($data['dashboard_value']=='thangtruoc') {
            $get=statistic::whereBetween('order_date',[$dauthang_truoc,$cuoithang_truoc])->orderBy('order_date','ASC')->get();
        }
        elseif ($data['dashboard_value']=='7ngay') {
            $get=statistic::whereBetween('order_date',[$bay_ngay,$now])->orderBy('order_date','ASC')->get();
        }
        elseif ($data['dashboard_value']=='365ngayqua') {
            $get=statistic::whereBetween('order_date',[$motnam,$now])->orderBy('order_date','ASC')->get();
        }
    if($get->count()>0){
        foreach($get as $key => $val){
        $chart_data[] = array(
            'period' => $val->order_date,
            'order' => $val->total_order,
            'sales' => $val->sales,
            'profit' => $val->profit,
            'quantity' => $val->quantity
        );
    }
            echo $data = json_encode($chart_data);  
    }else{
        $chart_data[] = array(
            'period' => 0,
            'order' => 0,
            'sales' => 0,
            'profit' => 0,
            'quantity' => 0
        );
    echo $data = json_encode($chart_data);      
    }
}
    public function days_order(Request $Request){
        $data=$Request->all();
        $ngay=Carbon::now('Asia/Ho_Chi_Minh')->subdays(360)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get=statistic::whereBetween('order_date',[$ngay,$now])->orderBy('order_date','ASC')->get();

        foreach($get as $key => $val){

        $chart_data[] = array(

            'period' => $val->order_date,
            'order' => $val->total_order,
            'sales' => $val->sales,
            'profit' => $val->profit,
            'quantity' => $val->quantity
        );
    }
            echo $data = json_encode($chart_data);  

    }
    public function sum(Request $Request){
        $data=$Request->all();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $ngay=Carbon::now('Asia/Ho_Chi_Minh')->subdays(360)->toDateString();
        $get_all=statistic::orderBy('order_date','ASC')->get();
        // whereBetween('order_date',[$ngay,$now])->
        $get_sale=0;
         foreach($get_all as $key =>$val){
            $get_sale+=$val->sales;
        }
        $ge_profitt=0;
         foreach($get_all as $key =>$val){
            $ge_profitt+=$val->profit;
        }
        $get_total_order=0;
         foreach($get_all as $key =>$val){
            $get_total_order+=$val->total_order;
        }
        $quantity=0;
         foreach($get_all as $key =>$val){
            $quantity+=$val->quantity;
        }
        $output='';
        $output.='<div class="container">

<table style="width:100%">  
    <tr>
    <th>Doanh thu: </th>
    <th>Lợi nhuận</th>
    <th>Sản phẩm</th> 
    <th>Order: </th>
  </tr>';

        $output.='<tr><td>'.number_format($get_sale,0,',','.').' VNĐ</td>
        <td>'.number_format($ge_profitt,0,',','.').' VNĐ</td>
        <td>'.$quantity.'</td>

        <td>'.$get_total_order.'</td>';
        $output.='</tr></table></div>';

        echo $output;
    }
    public function sum_dashboard_filter(Request $Request){
        $data=$Request->all();
        $dauthang=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthang_truoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithang_truoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $bay_ngay=Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $motnam=Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if ($data['dashboard_value']=='thangnay') {
        $get_all=statistic::whereBetween('order_date',[$dauthang,$now])->orderBy('order_date','ASC')->get();
       $get_sale=0;
         foreach($get_all as $key =>$val){
            $get_sale+=$val->sales;
        }
        $ge_profitt=0;
         foreach($get_all as $key =>$val){
            $ge_profitt+=$val->profit;
        }
        $get_total_order=0;
         foreach($get_all as $key =>$val){
            $get_total_order+=$val->total_order;
        }
        $quantity=0;
         foreach($get_all as $key =>$val){
            $quantity+=$val->quantity;
        }
        }
        elseif ($data['dashboard_value']=='thangtruoc') {
        $get_all=statistic::whereBetween('order_date',[$dauthang_truoc,$cuoithang_truoc])->orderBy('order_date','ASC')->get();
       $get_sale=0;
         foreach($get_all as $key =>$val){
            $get_sale+=$val->sales;
        }
        $ge_profitt=0;
         foreach($get_all as $key =>$val){
            $ge_profitt+=$val->profit;
        }
        $get_total_order=0;
         foreach($get_all as $key =>$val){
            $get_total_order+=$val->total_order;
        }
        $quantity=0;
         foreach($get_all as $key =>$val){
            $quantity+=$val->quantity;
        }
        }
        elseif ($data['dashboard_value']=='7ngay') {
        $get_all=statistic::whereBetween('order_date',[$bay_ngay,$now])->orderBy('order_date','ASC')->get();
       $get_sale=0;
         foreach($get_all as $key =>$val){
            $get_sale+=$val->sales;
        }
        $ge_profitt=0;
         foreach($get_all as $key =>$val){
            $ge_profitt+=$val->profit;
        }
        $get_total_order=0;
         foreach($get_all as $key =>$val){
            $get_total_order+=$val->total_order;
        }
        $quantity=0;
         foreach($get_all as $key =>$val){
            $quantity+=$val->quantity;
        }
        }
        elseif ($data['dashboard_value']=='365ngayqua') {
        $get_all=statistic::whereBetween('order_date',[$motnam,$now])->orderBy('order_date','ASC')->get();
       $get_sale=0;
         foreach($get_all as $key =>$val){
            $get_sale+=$val->sales;
        }
        $ge_profitt=0;
         foreach($get_all as $key =>$val){
            $ge_profitt+=$val->profit;
        }
        $get_total_order=0;
         foreach($get_all as $key =>$val){
            $get_total_order+=$val->total_order;
        }
        $quantity=0;
         foreach($get_all as $key =>$val){
            $quantity+=$val->quantity;
        }
        }
        $output='';
        $output.='<div class="container">

<table style="width:100%">  
    <tr>
    <th>Doanh thu: </th>
    <th>Lợi nhuận: </th>
    <th>Sản phẩm: </th>
        <th>Order: </th>

  </tr>';

        $output.='<tr><td>'.number_format($get_sale,0,',','.').' VNĐ</td>
        <td>'.number_format($ge_profitt,0,',','.').' VNĐ</td>
        <td>'.$quantity.'</td>

        <td>'.$get_total_order.'</td>';
        $output.='</tr></table></div>';

        echo $output;
    }
    public function sum_filter_by_date(Request $Request){

    $data = $Request->all();

    $from_date = $data['from_date'];
    $to_date = $data['to_date'];

    $get_all=statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
       $get_sale=0;
         foreach($get_all as $key =>$val){
            $get_sale+=$val->sales;
        }
        $ge_profitt=0;
         foreach($get_all as $key =>$val){
            $ge_profitt+=$val->profit;
        }
        $get_total_order=0;
         foreach($get_all as $key =>$val){
            $get_total_order+=$val->total_order;
        }
        $quantity=0;
         foreach($get_all as $key =>$val){
            $quantity+=$val->quantity;
        }
        $output='';
        $output.='<div class="container">

<table style="width:100%">  
    <tr>
    <th>Doanh thu: </th>
    <th>Lợi nhuận</th>
    <th>Sản phẩm: </th>
    <th>Order: </th>
  </tr>';

        $output.='<tr><td>'.number_format($get_sale,0,',','.').' VNĐ</td>
        <td>'.number_format($ge_profitt,0,',','.').' VNĐ</td>
        <td>'.$quantity.'</td>
        <td>'.$get_total_order.'</td>';
        $output.='</tr></table></div>';

        echo $output;
}
}