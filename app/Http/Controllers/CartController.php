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
use App\coupon;
use Cart;
use App\category_post;

class CartController extends Controller
{
    public function authlogin(){
        $id=session::get('customer_id');
        if($id){
            return Redirect('/');
        }
        else{
            return Redirect('/login-checkout')->send();
        }}
   	public function save_cart(Request $Request){
      $data=$Request->all();
   		$product_info=DB::table('tbl_product')->where('product_id',$data['cart_product_id'])->first();
      if($data['attribute_id']!==0){
      $attribute=DB::table('tbl_attribute')->where('attribute_id',$data['attribute_id'])->first();
    }
      if($data['attribute_id']!=0){
        $content=Cart::content()->where('weight',$data['attribute_id']);
      }else{
        $content=Cart::content()->where('id',$product_info->product_id);
      }
      $quantity=$data['cart_product_qty'];

        if($content->count()>0){
        foreach ($content as $key => $value) {
        if($data['attribute_id']!=0){
        if($value->qty+$quantity>$attribute->attribute_quantity){
              echo 1;
          }
        else{
        $odata=array();
        $odata['id']=$product_info->product_id;
        $odata['qty']=$quantity;
        $odata['name']=$product_info->product_name;
        if($data['price']==0){
          $odata['price']=$product_info->product_price;
        }else{
        $odata['price']=$data['price'];
      }
      if($data['attribute_id']==0){
        $odata['weight']=0;
      }else{
        $odata['weight']=$data['attribute_id'];
      }
        $odata['options']['image']=$product_info->product_image;
        if($data['color']=='0'){
        $odata['options']['color']=null;
      }else{
        $odata['options']['color']=$data['color'];
      }
        if($data['size']==0){
          $odata['options']['size']=null;
        }else{
          $odata['options']['size']=$data['size'];
        }
        if($data['attribute_id']==0){
          $odata['options']['attribute_id']=null;
        }else{
        $odata['options']['attribute_id']=$data['attribute_id'];
      }
        Cart::add($odata);
            echo 2;
          }
        }else{
        if($value->qty+$quantity>$product_info->quantity){
              echo 1;
          }
        else{
        $odata=array();
        $odata['id']=$product_info->product_id;
        $odata['qty']=$quantity;
        $odata['name']=$product_info->product_name;
        if($data['price']==0){
          $odata['price']=$product_info->product_price;
        }else{
        $odata['price']=$data['price'];
      }
      if($data['attribute_id']==0){
        $odata['weight']=0;
      }else{
        $odata['weight']=$data['attribute_id'];
      }
        $odata['options']['image']=$product_info->product_image;
        if($data['color']=='0'){
        $odata['options']['color']=null;
      }else{
        $odata['options']['color']=$data['color'];
      }
        if($data['size']==0){
          $odata['options']['size']=null;
        }else{
          $odata['options']['size']=$data['size'];
        }
        if($data['attribute_id']==0){
          $odata['options']['attribute_id']=null;
        }else{
        $odata['options']['attribute_id']=$data['attribute_id'];
      }
        Cart::add($odata);
            echo 2;
          }
        }
      }}
        else{
        $odata=array();
        $odata['id']=$product_info->product_id;
        $odata['qty']=$quantity;
        $odata['name']=$product_info->product_name;
        if($data['price']==0){
          $odata['price']=$product_info->product_price;
        }else{
        $odata['price']=$data['price'];
      }
      if($data['attribute_id']==0){
        $odata['weight']=0;
      }else{
        $odata['weight']=$data['attribute_id'];
      }
        $odata['options']['image']=$product_info->product_image;
        if($data['color']=='0'){
        $odata['options']['color']=null;
      }else{
        $odata['options']['color']=$data['color'];
      }
        if($data['size']==0){
          $odata['options']['size']=null;
        }else{
          $odata['options']['size']=$data['size'];
        }
        if($data['attribute_id']==0){
          $odata['options']['attribute_id']=null;
        }else{
        $odata['options']['attribute_id']=$data['attribute_id'];
      }
        Cart::add($odata);
            echo 2;
          }
   	}
   	public function show_cart(Request $Request){
  $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();
      $meta_desc='Giỏ hàng';
      $meta_keywords='Giỏ hàng';
      $meta_title='Giỏ hàng';
      $url_canonical=$Request->url();
   		$cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
      $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','DESC')->get();
      $attr=DB::table('tbl_attribute')->get();
      $product=DB::table('tbl_product')->get();
		return view('pages.show_cart')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with('attr',$attr)->with('product',$product);

   	}
   	public function delete_by_cart(Request $Request){
      $data=$Request->all();
      $rowId=$data['rowld'];
   		Cart::update($rowId,0);
   	}
  public function checkout_coupon(Request $Request){
    $id=session::get('customer_id');
    if ($id) {
    $data=$Request->all();
    $today=Carbon::now('Asia/Ho_Chi_Minh');
    $coupon_old=coupon::where('coupon_code',$data['coupon_input'])->where('coupon_quantity','>','0')->where('coupon_date_end','>=',$today)->where('coupon_status','like','%'.Session::get('customer_id').'%')->first();
    if ($coupon_old) {
      echo 2;
    }
    else{
    $coupon=coupon::where('coupon_code',$data['coupon_input'])->where('coupon_quantity','>','0')->where('coupon_date_end','>=',$today)->first();
    if ($coupon) {
      $count_coupon=$coupon->count();
      if ($count_coupon>0) {
        // $coupon_session=Session::get('coupon');
        // if($coupon_session==true){
        //  $is_avaiable=0;
        //  if ($is_avaiable==0) {
            $cou[]=array(
              'coupon_code'=>$coupon->coupon_code,
              'coupon_condition'=>$coupon->coupon_condition,
              'coupon_number'=>$coupon->coupon_number,
            );
            // session()->flash('success', 'thêm mã giảm giá thành công');
            Session::put('coupon',$cou);
            Session::save();
            echo 1;
          } 
        }
        else{
          echo 0;
        }}
    }
    else{
      echo 3;
      }
    }  
  public function delete_coupon(){
    if(Session::get('coupon')){
    Session::put('coupon',null);
    echo 1;}
    else{
      echo 0;
    }
  }
  public function cart_total_price(Request $Request){
      $data=$Request->all();
      $rowId=$data['rowld'];
      $id=$data['attr_id'];
      $qantity1=$data['cart_quantity'];
      $attr=DB::table('tbl_attribute')->where('product_id',$data['product_id'])->get();
      if ($attr->count()>0) {
      $attr=DB::table('tbl_attribute')->where('attribute_id',$id)->first();
      if($attr->attribute_quantity<$qantity1){
        echo 1;
      }
      else{
      Cart::update($rowId,$qantity1);
      $price=$qantity1*$attr->attribute_price;
      $output=''.number_format($price,0,',','.').' VNĐ';
      echo $output;
    }
      }
      else{
      $pro=DB::table('tbl_product')->where('product_id',$data['product_id'])->first();
      if($pro->quantity<$qantity1){
        echo 1;
      }
      else{
      Cart::update($rowId,$qantity1);
      $price=$qantity1*$pro->product_price;
      $output=''.number_format($price,0,',','.').' VNĐ';
      echo $output;
    }
      }
  }
  public function bang_thanh_toan(){
    $output='';
    $total=0;
    foreach(Cart::content() as $v_content){
        $subtotal=$v_content->price * $v_content->qty;
        $total+=$subtotal;
}
    $output.='<ul><li>Tổng <span>'.number_format($total,0,',','.').' VNĐ</span></li>';

              if(Session::get('coupon')){

                  foreach(Session::get('coupon') as $key => $cou){
                    
                    if($cou['coupon_condition']==1){
    $output.='<li>Mã giảm : <span>'.$cou['coupon_number'].' %</span></li>';

                        $total_coupon = ($total*$cou['coupon_number'])/100;
    $output.='<li>Tổng giảm:<span>'.number_format($total_coupon,0,',','.').'VNĐ</span</li>
              <li>Tổng đã giảm :<span>'.number_format($total-$total_coupon,0,',','.').' VNĐ</span></li>';
            }
                    
                    else if($cou['coupon_condition']==2){
    $output.='<li>Mã giảm : <span>'.number_format($cou['coupon_number'],0,',','.').' VNĐ</span></li>';

                        $total_coupon = $total - $cou['coupon_number'];
    $output.='<li>Tổng đã giảm :<span>'.number_format($total_coupon,0,',','.').' VNĐ</span></li>';
}
}  }              
              else{
                  $output.='<li>Mã giảm giá :<span>0</span></li>';
              }
              $output.='<li>Phí Vận vận chuyển<span>0</span></li>
              </ul>
              <a class="btn btn-default check_out" href="'.url('/checkout').'">Thanh toán</a>';
      echo $output;
  }
  public function bang_thanh_toan_check(){
    $output='';
    $total=0;
    foreach(Cart::content() as $v_content){
        $subtotal=$v_content->price * $v_content->qty;
        $total+=$subtotal;
}
            $output.='<ul><li>Tổng <span>'.number_format($total,0,',','.').' VNĐ</span></li>';
              if(Session::get('coupon')){         
                  foreach(Session::get('coupon') as $key => $cou){
                    
                    if($cou['coupon_condition']==1){
            $output.='<li>Mã giảm : <span>'.$cou['coupon_number'].' %</span></li>
                      <input type="hidden" class="coupon_text" value="'.$cou['coupon_code'].'">';

                        $total_coupon = ($total*$cou['coupon_number'])/100;
            $output.='<li>Tổng giảm:<span>'.number_format($total_coupon,0,',','.').' VNĐ</span</li>';
                        $after_coupon=$total-$total_coupon;

            $output.='<li>Tổng đã giảm :<span>'.number_format($total-$total_coupon,0,',','.').' VNĐ</span>
                      </li>';}
                    else if($cou['coupon_condition']==2){
            $output.='<li>Mã giảm : <span>'.number_format($cou['coupon_number'],0,',','.').' VNĐ</span></li>
                        <input type="hidden" class="coupon_text" value="'.$cou['coupon_code'].'">';

                        $total_coupon = $total - $cou['coupon_number'];
                        $after_coupon=$total_coupon;
                      
              $output.='<li>Tổng đã giảm :<span >'.number_format($total_coupon,0,',','.').' VNĐ</span></li>';
                  }
                }}
              else{
              $output.='<li>Mã giảm giá :<span>0</span></li>
                <input type="hidden" class="coupon_text" value="">';
              }
              if(Session::get('fee')){
              $output.='<li>Phí Vận vận chuyển<span>'.number_format(Session::get('fee'),0,',','.').' VNĐ</span></li>
              <input type="hidden" class="order_fee" name="order_fee" value="'.Session::get('fee').'">';
            }else{
              $output.='<li>Phí Vận vận chuyển<span>Chưa có</span></li>
              <input type="hidden" class="order_fee" name="order_fee" value=" ">';
            }
              $output.='<hr/><li>Tổng tiền thanh toán:<span style="color:red;font-size:18px">';
              if(Session::get('coupon')&& !Session::get('fee')){
                $total_price=$after_coupon;
                $output.=''.number_format($total_price,0,',','.').' VNĐ';
              }
              else if(!Session::get('coupon')&& Session::get('fee')){
                $total_price=$total+Session::get('fee');
                $output.=''.number_format($total_price,0,',','.').' VNĐ';
              }
              else if(Session::get('coupon')&& Session::get('fee')){
                $total_price=$after_coupon+Session::get('fee');
                $output.=''.number_format($total_price,0,',','.').' VNĐ';
              }
              else if(!Session::get('coupon') && !Session::get('fee')){

                $output.=''.number_format($total,0,',','.').' VNĐ';
              }
              if(Session::get('fee')){
              $output.='<input type="hidden" class="total_price" id="total_price" name="total_price" value="'.$total_price.'">';
                $paypal_total=$total_price/23000;
              $output.='<input type="hidden" id="paypal_total" value="'.round($paypal_total,2).'">';
              }
              $output.='</span></li>
            </ul>';
              echo $output;  
    }
}