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
use App\admin;
use App\roles;
use Auth;
use App\customer;
use File;
class UserController extends Controller
{
  
    public function all_user(){
      $admin=admin::with('roles')->orderBy('admin_id','desc')->paginate(10);
    	return view('admin.user.user')->with(compact('admin'));
    }
	public function user_regis(){
		return view('admin.user.user_regis');

    }
      public function user_regis_admin(){
    return view('admin.user.user_regis_admin');

    }
  public function assign_roles(Request $request){

        if(Session::get('admin_id')==$request->admin_id){
            Session::flash('error','Bạn không thể phân quyền cho chính mình');
            return redirect()->back();
        }

        $user = admin::where('admin_email',$request->admin_email)->first();
        $user->roles()->detach();

        if($request->author_role){
           $user->roles()->attach(roles::where('name','author')->first());     
        }
        if($request->reply_role){
           $user->roles()->attach(roles::where('name','reply')->first());     
        }
        if($request->admin_role){
           $user->roles()->attach(roles::where('name','admin')->first());     
        }
        session()->flash('success', 'thêm mới thành công');
        return redirect()->back();
    }
    public function delete_user_roles($admin_id){
        if(Auth::id()==$admin_id){
            Session::flash('error','Bạn không thể xóa chính mình');

            return redirect()->back();
        }
        $admin = admin::find($admin_id);

        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        session()->flash('success', 'xóa thành công');

        return redirect()->back();

    }
	public function user_add(Request $Request){
		    	$messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'name' => 'required',
        'password' => 'required',
        'address' => 'required',
        'phone'=>'required',
        'email'=>'required',
    ], $messages);
   		$data=array();
   		$data['admin_name']=$Request->name;
   		$data['admin_password']=md5($Request->password);
   		$data['address']=$Request->address;
   		$data['admin_phone']=$Request->phone;
   		$data['admin_email']=$Request->email;
        $available=DB::table('tbl_admin')->where('admin_email',$Request->email)->get();
        if ($available->count()) {
			Session::flash('error','Email đã tồn tại');
            return Redirect::back();
        }
        else{
   		$available1=DB::table('tbl_admin')->insert($data);
			Session::flash('success','Đăng ký thành công');
   		    return Redirect::back();
}
    }
    public function pass()
    {
        return view('admin.user.change_password');
    }
    public function edit_pass(Request $Request)
    {
        $data=$Request->all();
      $admin=admin::where('admin_id',$data['id'])
      ->where('admin_password',md5($data['password_old']))->get();
      if ($admin->count()) {
        foreach( $admin as $key =>$ad){
        $ad->admin_password=md5($data['password_new']);
        $ad->save();}
        echo 2;
      }
      else{
        echo 1;
      }
    } 
   public function customer_manager(Request $Request)
   {
        $customer=DB::table('tbl_customer')->get();
       return view('admin.user.customer_manager')->with(compact('customer'));
   }
   public function delete_customer($customer_id){
        $customer=customer::where('customer_id',$customer_id)->first();
        if($customer->customer_img!=null){
        $path='public/upload/avata/'.$customer->customer_img;
        if(File::exists($path)){
            unlink($path);
        }}
        $customer->delete();
        Session::flash('success','Xóa thành công');
        return Redirect::back();
   }
}
