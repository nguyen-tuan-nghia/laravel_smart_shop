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
use Auth;
use File;
use App\comment;
use App\rating_star;
use App\feedback;
use App\feedback_img;
class commentController extends Controller
{
    public function authlogin(){
        $admin_id=session::get('admin_id');
        // $admin_id=Auth::id();
        if($admin_id){
            return Redirect('/dashboard');
        }
        else{
            return Redirect('/admin')->send();
        }
    }
    public function reply_comment(Request $request){
        $this->authlogin();
        $data = $request->all();
        $comment = new comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->person_replied_name=Auth::user()->admin_name;
        $comment->save();

    }
    public function allow_comment(Request $request){
        $this->authlogin();
        $data = $request->all();
        $comment = comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }
    public function list_comment(){
        $this->authlogin();
        $comment = comment::with('product')->where('comment_parent_comment','=',0)->orderBy('comment_id','DESC')->get();
        $comment_rep = comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }
    public function load_comment(Request $Request){
        $data=$Request->all();
        $comment=comment::where('comment_product_id',$data['product_id'])->where('comment_parent_comment',0)->where('comment_status',0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        $output='';
        foreach($comment as $key =>$comt){
        $output.='

                                
                                <div class="row style_comment ">     
                                <div class="col-sm-1 comment-img" style="margin-right:20px">
                                ';
                                if($comt->customer->customer_img!=null){
                                    $output.='
                                    <img src="'.url('public/upload/avata/'.$comt->customer->customer_img).'" style="width:60px">';
                                }
                                else{
                                    $output.='
                                    <img src="'.url('public/frontend/images/avatardefault_92824.png').'" style="width:60px">';
                                }
                                    $output.='
                                    </div>
                                <div class="col-sm-9" style="margin-top: 5px">                                    
                                <label style="color:#0094FFFF">'.$comt->customer->customer_name.'</label>
                                    <p>'.$comt->comment.'</p>
                                    <p>'.$comt->comment_date.'</p>
                                </div></div>';
                                foreach($comment_rep as $key => $rep_comment)  {
                                        if($rep_comment->comment_parent_comment==$comt->comment_id)  {
                                $output.='
                                <div class="row style_comment" style="margin-left:100px;">
                                <div class="col-sm-9" style="background-color: #f5f5f5">
                                <label>admin</label>
                                    <p>'.$rep_comment->comment.'</p>
                                    <p>'.$rep_comment->comment_date.'</p>
                                </div></div><br/><br/>';
                                        }
                                    }
                            }
                            
        echo $output;
    }
    public function send_comment(Request $Request){
        $data=$Request->all();
        $comment=new comment;
        $comment->customer_id=$data['comment_name'];
        $comment->comment=$data['comment_content'];
        $comment->comment_date=Carbon::now('Asia/Ho_Chi_Minh');;
        $comment->comment_product_id=$data['product_id'];
        $comment->comment_parent_comment=0;
        $comment->comment_status=1;
        $comment->save();
    }
    public function delete_comment($comment_id)
    {
        $this->authlogin();
        $comment = comment::find($comment_id)->delete();
        Session::flash('success','xóa thành công');
        return Redirect::back();
    }
    public function save_feedback(Request $Request){
        $data=$Request->all();
        if($data['star']!==0){
           $start=new rating_star;
           $start->number=$data['star'];
           $start->product_id=$data['id'];
           $start->customer_id=Session::get('customer_id');
           $start->save();
           $start_id=$start->rating_star_id;
        }else{
            $start_id=null;
        }
        $feedback=new feedback;
        $feedback->product_id =$data['id'];
        $feedback->customer_id=Session::get('customer_id');
        $feedback->message=$data['mess'];
        $feedback->rating_star_id=$start_id;
        $feedback->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        $feedback->order_id=$data['order_id_feedback'];
        $feedback->save();
            $get_image=$Request->file('files');
            if($get_image){
             foreach($get_image as $image) {
            $get_name_img=$image->getClientOriginalName();
            $name_img=current(explode('.', $get_name_img));
            $new_image=$name_img.rand(0,9999).'.'.$image->getClientOriginalExtension();
            $image->move('public/upload/coment_img',$new_image);
            $feedback_img=new feedback_img;
            $feedback_img->feedback_id=$feedback->feedback_id;
            $feedback_img->feedback_name=$new_image;
            $feedback_img->save();
        }}
}
    public function feedback_model(Request $Request,$id){
        $data=$Request->all();
        $product=DB::table('tbl_product')->where('product_id',$id)->first();
        return response()->json($product);
    }
    public function list_feedback(){
        $this->authlogin();
        $feedback=DB::table('tbl_feedback')->join('tbl_product','tbl_product.product_id','=','tbl_feedback.product_id')->join('tbl_customer','tbl_customer.customer_id','=','tbl_feedback.customer_id')->get();
        $feedback_img=feedback_img::get();
        return view('admin.feedback.list_feedback')->with(compact('feedback','feedback_img'));
    }
    public function delete_feedback($feedback_id){
        $this->authlogin();
        $feedback_img=feedback_img::where('feedback_id',$feedback_id)->get();
        foreach ($feedback_img as $key => $value) {
        $path='public/upload/coment_img/'.$value->feedback_name;
        if(File::exists($path)){
            unlink($path);
        }
        }
        feedback_img::where('feedback_id',$feedback_id)->delete();
        $feedback=feedback::find($feedback_id)->delete();
    }
    public function update_feedback(Request $Request){
        $this->authlogin();
        $data=$Request->all();
        $feedback=DB::table('tbl_feedback')->where('feedback_id',$data['feedback_id'])
        ->update(['feedback_status'=>$data['feedback_status']]);
    }
    public function feedback_edit_model(Request $Request,$feedback_id){
        $feedback=feedback::where('feedback_id',$feedback_id)->join('tbl_rating_star','tbl_feedback.rating_star_id','=','tbl_rating_star.rating_star_id')->first();
        return response()->json($feedback);
    }
    public function feedbackimg_edit_model(Request $Request, $feedback_id){
        $feedback_img=feedback_img::where('feedback_id',$feedback_id)->get();
        return view('pages.fetch.edit_feedback_img')->with(compact('feedback_img'))->render();
    }
    public function delete_feedback_img(Request $Request, $feedback_img_id){
        $feedback_img=feedback_img::where('feedback_img_id',$feedback_img_id)->first();
        $path='public/upload/coment_img/'.$feedback_img->feedback_name;
        if(File::exists($path)){
            unlink($path);
        }
        feedback_img::where('feedback_img_id',$feedback_img_id)->delete();
    }
    public function fetch_feedback_edit()
    {
        $feedback=feedback::where('customer_id',Session::get('customer_id'))->orderBy('feedback_id','DESC')->get();
        $feedback_img=feedback_img::get();
        return view('pages.fetch.fetch_feedback_edit')->with(compact('feedback','feedback_img'))
        ->render();
    }
    public function feedback_edit(Request $Request){
        $data=$Request->all();
        $feedback=feedback::find($data['id']);
        $feedback->message=$data['mess'];//
        $feedback->feedback_status=0;
        $feedback->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        if($data['star']!==0){
           $start=rating_star::find($feedback->rating_star_id);
           $start->number=$data['star'];
           $start->save();
        }
        $feedback->save();
            $get_image=$Request->file('files');
            if($get_image){
             foreach($get_image as $image) {
            $get_name_img=$image->getClientOriginalName();
            $name_img=current(explode('.', $get_name_img));
            $new_image=$name_img.rand(0,9999).'.'.$image->getClientOriginalExtension();
            $image->move('public/upload/coment_img',$new_image);
            $feedback_img=new feedback_img;
            $feedback_img->feedback_id=$feedback->feedback_id;
            $feedback_img->feedback_name=$new_image;
            $feedback_img->save();
        }}
    }
}
