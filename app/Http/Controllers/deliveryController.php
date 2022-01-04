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
use App\city;
use App\province;
use App\wards;
use App\feeship;
use Auth;

class deliveryController extends Controller
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
    public function select_feeship(){
    	$feeship=feeship::orderBy('fee_id','DESC')->get();
    	$output='';
    	$output.='<div class="table-agile-info">
  <div class="panel panel-default">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>

            <th>Tên tỉnh thành phố</th>
            <th>Tên quận huyện</th>
            <th>Tên xã phường</th>
            <th>Phí vận chuyển</th>
            <th></th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>';
          foreach($feeship as $key => $fee){
          $output.='
          <tr>
            <td>'.$fee->city->name_tp.'</td>
            <td><span class="text-ellipsis">'.$fee->province->name_quanhuyen.'</span></td>
            <td><span class="text-ellipsis">'.$fee->wards->name_xaphuong.'</span></td>
            <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="feeship_edit">'.number_format($fee->fee_feeship,0,',','.') .'</td>
          </tr>
          	';}
          $output.='
        </tbody>
      </table>
    </div></div>';
    	echo $output;
    }
    public function select_delivery(Request $Request){
        $data=$Request->all();
        if($data['action']){
            $output='';
            if($data['action']=='city'){
                $select_province=province::where('matp',$data['ma_id'])->orderBy('maqh','ASC')->get();
                foreach ($select_province as $key => $select_province) {
                    $output.='<option value="'.$select_province->maqh.'">'.$select_province->name_quanhuyen.'</option>';
                }
            }
            else{
                $select_wards=wards::where('maqh',$data['ma_id'])->orderBy('xaid','ASC')->get();
                foreach ($select_wards as $key => $select_wards) {
                    $output.='<option value="'.$select_wards->xaid.'">'.$select_wards->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
    public function insert_delivery(Request $Request){
    	$data=$Request->all();
        $delivery=feeship::where('fee_matp',$data['city'])->where('fee_maqh',$data['province'])->where('fee_xaid',$data['wards'])->get();
        if($delivery->count()){
            echo 2;
        }
        else{
    	$feeship=new feeship();
    	$feeship->fee_matp=$data['city'];
    	$feeship->fee_maqh=$data['province'];
    	$feeship->fee_xaid=$data['wards'];
    	$feeship->fee_feeship=$data['fee_ship'];
    	$feeship->save();
        echo 1;
}
    }
    public function update_delivery(Request $Request){
    	$data=$Request->all();
    	$feeship=array();
    	$feeship['fee_feeship']=$data['fee_value'];
    	DB::table('tbl_feeship')->where('fee_id',$data['feeship_id'])->update($feeship);
    }
    public function add_delivery(Request $Request){
    	$this->authlogin();
    	$city=city::orderBy('matp','ASC')->get();
    	return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function select_delivery_home(Request $Request){
        $data=$Request->all();
        if($data['action']){
            $output='';
            if($data['action']=='city'){
                $select_province=province::where('matp',$data['ma_id'])->orderBy('maqh','ASC')->get();
                foreach ($select_province as $key => $select_province) {
                    $output.='<option value="'.$select_province->maqh.'">'.$select_province->name_quanhuyen.'</option>';
                }
            }
            else{
                $select_wards=wards::where('maqh',$data['ma_id'])->orderBy('xaid','ASC')->get();
                foreach ($select_wards as $key => $select_wards) {
                    $output.='<option value="'.$select_wards->xaid.'">'.$select_wards->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
}
