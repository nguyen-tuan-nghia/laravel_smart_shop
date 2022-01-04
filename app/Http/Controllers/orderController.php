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
use PDF;
use App\product;
use App\order;
use Auth;
use App\statistic;
use App\attribute;
class orderController extends Controller
{
  public function in_hoa_don($order_id){
    $pdf=\App::make('dompdf.wrapper');
    $pdf->loadHTML($this->print_oreder($order_id));
    return $pdf->stream();
  }
  public function print_oreder($order_id){
    $shipping_detail=DB::table('tbl_order')->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')->where('tbl_order.order_id',$order_id)->first();
    $order_detail=DB::table('tbl_order_detail')->where('order_id', $order_id)->get();
    foreach ($order_detail as $key => $value) {
      $coupon_text=$value->coupon_text;
      $order_fee=$value->product_feeship;
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
    $output='<style>body{font-family: dejaVu Sans;
}</style>';
    $output.='<h3><center>Cửa hàng smart shop<center></h3>
  <p><b><center>Đơn số : '.$order_id.' </center></b></p>
  <p><b><center>Liên hệ : 09088888</center></b></p>

    <p><b>Tên khách hành :'.$shipping_detail->shipping_name.'</b></p>
        <p><b>Dại chỉ :'.$shipping_detail->shipping_address.'</b></p>
        <p><b>Số điện thoại :'.$shipping_detail->shipping_phone.'</b></p>
        <p><b>Hình thức thanh toán :'.$shipping_detail->shipping_method.'</b></p>
        <br><br>
    <table style="width:100%">
  <tr>
    <th>Tên sản phẩm</th>
    <th>Số lượng</th> 
    <th>Đơn giá</th>
    <th>Tổng</th>
  </tr>';
  $total=0;
  foreach ($order_detail as $key => $value) {
    $subtotal=$value->product_sales_quantity *$value->product_price;
   $output.='
  <tr>
    <td>'.$value->product_name.'<p>'.$value->product_color.'</p><p>'.$value->product_size.'</p></td>
    <td>'.$value->product_sales_quantity  .'</td>
    <td>'.number_format($value->product_price,0,',','.').' VNĐ</td>
    <td>'.number_format($subtotal,0,',','.').' VNĐ</td>
  </tr>
    ';
    $total+=$subtotal;
  }    
      if($coupon_text==null){
    if ($shipping_detail->shipping_method=='Paypal') {
          $output.='<p><b>Tổng tiền cần thanh toán :0 VNĐ</b></p>
    ';
    }
    else{
          $output.='<p><b>Tổng tiền cần thanh toán : '.number_format($total+$order_fee,0,',','.').' VNĐ</b></p>
    ';
    }

    $output.='<p><b>phí vận chuyển : '.number_format($order_fee,0,',','.').' VNĐ</b></p>';
      $output.='<p><b>Giảm giá : không có</b></p><br><br> <br> ';
     }
    else{
      if($coupon_condition==1){
        $coupon_after=($total*$coupon_number)/100;
        if ($shipping_detail->shipping_method=='Paypal') {
          $output.='<p><b>Tổng tiền cần thanh toán :0 VNĐ</b></p>
    ';
        }
        else{
    $output.='
   <p><b>Tổng tiền cần thanh toán : '.number_format($total+$order_fee-$coupon_after,0,',','.').' VNĐ</b></p>';
    }
    $output.='
    <p><b>phí vận chuyển : '.number_format($order_fee,0,',','.').' VNĐ</b></p>';
      $output.='<p><b>Giảm giá : '.$coupon_number.' %</b></p><?php
<br><br> <br>
';}
    else{
    if ($shipping_detail->shipping_method=='Paypal') {
          $output.='<p><b>Tổng tiền cần thanh toán :0 VNĐ</b></p>
    ';
    }
    else{
    $output.='
   <p><b>Tổng tiền cần thanh toán : '.number_format($total+$order_fee-$coupon_number,0,',','.').' VNĐ</b></p>';
 }
    $output.='
    <p><b>phí vận chuyển : '.number_format($order_fee,0,',','.').' VNĐ</b></p>';      
    $output.='<p><b>Giảm giá : '.number_format($coupon_number,0,',','.').' VNĐ</b></p><?php
<br><br> <br>
    ';}}
    return $output;
      }

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
    public function all_order(Request $Request){
       $this->authlogin();
      $all_order=DB::table('tbl_order')->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')->select('tbl_order.*','tbl_customer.*')->orderBy('tbl_order.order_id','DESC')->get();

   		return view('admin.manage_order')->with('all_order',$all_order);
    }
    public function delete_order(Request $Request,$order_id){
       $this->authlogin();
      $all_order=DB::table('tbl_order')->where('order_id',$order_id)->delete();
      session()->flash('success', 'Xóa thành công');
      return back();
    }
    public function order_detail($order_id){
    $this->authlogin();
    $shipping_detail=DB::table('tbl_order')->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')->select('tbl_customer.*','tbl_order.*')->where('tbl_order.order_id',$order_id)->get();
    $shipping=DB::table('tbl_order')->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')->where('order_id',$order_id)->get();
    $product=DB::table('tbl_product')->get();
    $shipping_detail1=DB::table('tbl_order')->where('order_id',$order_id)->get();
    $order_detail=DB::table('tbl_order_detail')->where('tbl_order_detail.order_id', $order_id)->get();
    $attribute=DB::table('tbl_attribute')->get();
    $order_detail1=DB::table('tbl_order_detail')->where('tbl_order_detail.order_id', $order_id)->get();
    foreach ($order_detail1 as $key => $value) {
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
   		return view('admin.manage_order_detail')->with(compact('shipping_detail','shipping_detail1','order_detail','coupon_number','coupon_condition','shipping','product','attribute'));
    }
    public function delete_order_detail($order_detail_id){
    $this->authlogin();
    DB::table('tbl_order_detail')->where('order_detail_id', $order_detail_id)->delete();
            session()->flash('success', 'Xóa thành công');
            return back();
    }
    public function update_quantity_order_detail(Request $Request){
      $data=$Request->all();
      $quantity['product_sales_quantity']=$data['quantity'];
      DB::table('tbl_order_detail')->where('order_detail_id', $data['id'])->update($quantity);
    }
    public function update_order_status(Request $Request){
      $data=$Request->all();
      $order=order::find($data['id']);
      $order->order_status=$data['values'];
      $order->save();
    $order_date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); 
    $statistic = statistic::where('order_date',$order_date)->get();
    if($statistic){
      $statistic_count = $statistic->count(); 
    }else{
      $statistic_count = 0;
    } 
    if($order->order_status==2){
      foreach($data['order_product_id'] as $key => $product_id){
        
        $product = product::findOrFail($product_id);
        $product_quantity = $product->quantity;
        $product_sold = $product->product_sold;
        foreach($data['quantity'] as $key2 => $qty){
            if($key==$key2){
                $pro_remain = $product_quantity - $qty;
                $product->quantity = $pro_remain;
                $product->product_sold = $product_sold + $qty;
                $product->save();
            }
        }
      }
      foreach($data['attribute_order'] as $key3 => $attribute_id){
        
        $product = attribute::find($attribute_id);
        $product_quantity = $product->attribute_quantity;
        foreach($data['quantity'] as $key4 => $qty){
            if($key3==$key4){
                $product->attribute_quantity = $product_quantity - $qty;
                $product->save();
            }
        }
      }
    }
    elseif($order->order_status==1){
      foreach($data['order_product_id'] as $key => $product_id){
        
        $product = product::find($product_id);
        $product_quantity = $product->quantity;
        $product_sold = $product->product_sold;
        foreach($data['quantity'] as $key2 => $qty){
            if($key==$key2){
                $pro_remain = $product_quantity + $qty;
                $product->quantity = $pro_remain;
                $product->product_sold = $product_sold - $qty;
                $product->save();
            }
        }
      }
      foreach($data['attribute_order'] as $key3 => $attribute_id){
        
        $product = attribute::find($attribute_id);
        $product_quantity = $product->attribute_quantity;
        foreach($data['quantity'] as $key4 => $qty){
            if($key3==$key4){
                $product->attribute_quantity = $product_quantity + $qty;
                $product->save();
            }
        }
      }
    }
    elseif($order->order_status==4){
      //them
      $total_order = 0;
      $sales = 0;
      $profit = 0;
      $quantity = 0;
      $von=0;
      foreach($data['order_product_id'] as $key => $product_id){

        $product = Product::find($product_id);
        $product_cost=$product->import_price;
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        foreach($data['quantity'] as $key2 => $qty){

          if($key==$key2){

            //update doanh thu
            $quantity+=$qty;
            $von+=$product_cost*$qty;
           }
        }
        }
      //update doanh so db
      if($statistic_count>0){
        $statistic_update = statistic::where('order_date',$order_date)->first();
        $statistic_update->sales = $statistic_update->sales + $data['tong_tien'];
        $statistic_update->profit =  $statistic_update->profit + $data['tong_tien']-$von;
        $statistic_update->quantity =  $statistic_update->quantity + $quantity;
        $statistic_update->total_order = $statistic_update->total_order + 1;
        $statistic_update->save();

      }else{
        $statistic_new = new statistic();
        $statistic_new->order_date = $order_date;
        $statistic_new->sales = $data['tong_tien'];
        $statistic_new->profit =  $data['tong_tien']-$von;
        $statistic_new->quantity =  $quantity;
        $statistic_new->total_order = 1;
        $statistic_new->save();
      }
    }}
  }

