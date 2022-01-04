<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\coupon;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
validator();
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;

class couponController extends Controller
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
    public function add_coupon(){
    	$this->authlogin();
    	return view('admin.coupon.add_coupon');
    }
    public function save_coupon(Request $Request){
    	$data=$Request->all();
        $coupon= new coupon;
        $messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'coupon_name' => 'required',
        'coupon_code'=>'required',
        'coupon_quantity' => 'required',
        'coupon_number' => 'required',
        'coupon_condition' => 'required'
    ], $messages);
    $coupon->coupon_name=$data['coupon_name'];
    $coupon->coupon_code=$data['coupon_code'];
    $coupon->coupon_quantity=$data['coupon_quantity'];
    $coupon->coupon_number=$data['coupon_number'];
    $coupon->coupon_condition=$data['coupon_condition'];
    $coupon->coupon_date_start=$data['coupon_date_start'];
    $coupon->coupon_date_end=$data['coupon_date_end'];
    $get=coupon::where('coupon_code',$data['coupon_code'])->first();
    if ($get) {
    session()->flash('error', 'mã đã tồn tại');
    return Redirect::back();
    }
    else{
    $coupon->save();
    session()->flash('success', 'thêm mới thành công');
    return Redirect::to('add-coupon');}
    }

    public function all_coupon(){
        $coupon=DB::table('tbl_coupon')->orderBy('coupon_id','DESC')->get();
        $today=Carbon::now('Asia/Ho_Chi_Minh');

        return view('admin.coupon.all_coupon')->with(compact('coupon','today'));
    }

    public function delete_coupon($coupon_id){
        $coupon=coupon::find($coupon_id)->delete();
        session()->flash('success', 'xóa thành công');
        return Redirect::back();
    }

    public function edit_coupon($coupon_id){
        $this->authlogin();
        $coupon=DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->get();
        return view('admin.coupon.edit_coupon')->with(compact('coupon'));
    }
    public function update_coupon(Request $Request,$coupon_id){
        $data=$Request->all();
        $coupon= coupon::where('coupon_id',$coupon_id)->first();
        $messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'coupon_name' => 'required',
        'coupon_code'=>'required',
        'coupon_quantity' => 'required',
        'coupon_number' => 'required',
        'coupon_condition' => 'required'
    ], $messages);
    $coupon->coupon_name=$data['coupon_name'];
    $coupon->coupon_code=$data['coupon_code'];
    $coupon->coupon_quantity=$data['coupon_quantity'];
    $coupon->coupon_number=$data['coupon_number'];
    $coupon->coupon_condition=$data['coupon_condition'];
    $coupon->coupon_date_start=$data['coupon_date_start'];
    $coupon->coupon_date_end=$data['coupon_date_end'];

    $coupon->save();
    session()->flash('success', 'thêm mới thành công');
    return Redirect::to('all-coupon');
}
}
