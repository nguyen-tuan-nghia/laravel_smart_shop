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
use App\category_post;
use App\gallery;
use File;
use App\product;
use App\attribute;
use App\rating_star;
use App\feedback;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Excel;
use App\coupon;
class productController extends Controller
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
    public function export_csv(){
        return Excel::download(new ExcelExports , 'product.xlsx');
    }
    public function add_product(){
    	$this->authlogin();
    	$cate_product=DB::table('tbl_category_product')->orderBy('category_id','DESC')->get();
    	$brand_product=DB::table('tbl_brand')->orderBy('brand_id','DESC')->get();

      return view('admin.product.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    
       public function all_product(Request $request){
       $this->authlogin();
    $Search = $request->input('Search');
if($Search!=""){

   	$all_product=DB::table('tbl_product')->where('product_name', 'like', '%'.$Search.'%')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderBy('tbl_product.product_id','DESC')->get();
            $all_product->appends(['Search' => $Search]);

}
else{
      $all_product=DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderBy('tbl_product.product_id','DESC')->get();
}
   	$manager_product=view('admin.product.all_product')->with("all_product",$all_product);

   		return view('layout_Admin')->with('admin.product.all_product',$manager_product);
   }
   public function unaction_product($product_id){
   	$this->authlogin();

   	DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>1]);
   	session()->flash('success', 'Ẩn trạng thái thành công');

   		return Redirect('/all-product');
   }
      public function action_product($product_id){
      $this->authlogin();

   	DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>0]);
   	session()->flash('success', 'Hiện trạng thái thành công');

   		return Redirect('/all-product');
   }
   public function save_product(Request $Request){
   	$this->authlogin();
        $product_price = filter_var($Request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $import_price = filter_var($Request->import_price, FILTER_SANITIZE_NUMBER_INT);
      $messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'product_name' => 'required',
        'product_slug'=>'required',
        'import_price' => 'required',
        'product_desc' => 'required',
        'product_status' => 'required',
        'product_price'=>'required',
        'category_id'=>'required',
        'brand_id'=>'required',
  		'product_image'=>'required',
      'quantity'=>'required'
    ], $messages);
   		$data=new product;
   		$data->product_name=$Request->product_name;
      $data->product_slug=$Request->product_slug;
      $data->import_price=$import_price;
      $data->quantity=$Request->quantity;
   		$data->product_desc=$Request->product_desc;
   		$data->product_status=$Request->product_status;
   		$data->product_content=$Request->product_content;
   		$data->product_price=$product_price;
   		$data->category_id=$Request->category_id;
   		$data->brand_id=$Request->brand_id;
   		$data->created_at=Carbon::now('Asia/Ho_Chi_Minh');
   		$get_image=$Request->file('product_image');
   		if($get_image){
      $get_name_img=$get_image->getClientOriginalName();
      $name_img=current(explode('.', $get_name_img));
      $new_image=$name_img.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move('public/upload/product',$new_image);
        $data->product_image=$new_image;
      $available=DB::table('tbl_product')->where('product_name',$Request->product_name)->get();
      if ($available->count()) {
          session()->flash('error', 'Tên sản phẩm đã tồn tại');
          return Redirect::back();
      }
      else{
        file::copy('public/upload/product/'.$new_image,'public/upload/gallery/'.$new_image);
   		$data->save();
        $gallery=new gallery;
        $gallery->gallery_name=$new_image;
        $gallery->gallery_image=$new_image;
        $gallery->product_id=$data->product_id;
        $gallery->save();
            session()->flash('success', 'thêm mới thành công');
   		return Redirect('/all-product');}}}

   public function edit_product($product_id){
   	$this->authlogin();
        $all_product=DB::table('tbl_product')->where('product_id', $product_id)
        ->orderBy('tbl_product.product_id','DESC')->get();
    	$cate_product=DB::table('tbl_category_product')->orderBy('category_id','DESC')->get();
    	$brand_product=DB::table('tbl_brand')->orderBy('brand_id','DESC')->get();
    	$manager_product=view('admin.product.edit_product')->with("edit_product",$all_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
      return view('layout_Admin')->with('admin.product.edit_product',$manager_product);
   }
      public function delete_product($product_id){
      	$this->authlogin();
        $product=DB::table('tbl_product')->where('product_id',$product_id)->first();
        $gallery=DB::table('tbl_gallery')->where('gallery_image',$product->product_image)->get();

        if ($gallery->count()) {            
            DB::table('tbl_gallery')->where('gallery_image',$product->product_image)->delete();
            unlink('public/upload/gallery/'.$product->product_image);
         }                
        unlink('public/upload/product/'.$product->product_image);

        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        // Session::put('message','Thêm danh mục thành công');
            session()->flash('success', 'Xóa thành công');
      return Redirect('/all-product');
   }
      public function update_product(Request $Request,$product_id ){
      	$this->authlogin();
        $product_price = filter_var($Request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $import_price = filter_var($Request->import_price, FILTER_SANITIZE_NUMBER_INT);
       $messages = [
        'required' => 'Trường :attribute bắt buộc nhập.'
        // 'email'    => 'Trường :attribute phải có định dạng email'
    ];
    $this->validate(request(), [
        'product_name' => 'required',
        'product_slug'=>'required',
        'import_price' => 'required',
        'product_desc' => 'required',
        'product_content' => 'required',
        'product_price'=>'required',
        'category_id'=>'required',
        'brand_id'=>'required',
      'quantity'=>'required'
    ], $messages);
   		$data=array();
      $data['product_name']=$Request->product_name;
      $data['product_slug']=$Request->product_slug;
      $data['import_price']=$import_price;
      $data['quantity']=$Request->quantity;
      $data['product_desc']=$Request->product_desc;
      $data['product_content']=$Request->product_content;
      $data['product_price']=$product_price;
      $data['category_id']=$Request->category_id;
      $data['brand_id']=$Request->brand_id;
      $data['updated_at']=Carbon::now('Asia/Ho_Chi_Minh');

   		$get_image=$Request->file('product_image');
   		if($get_image){
      $get_name_img=$get_image->getClientOriginalName();
      $name_img=current(explode('.', $get_name_img));
      $new_image=$name_img.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
   		$get_image->move('public/upload/product',$new_image);
   		$data['product_image']=$new_image;
        $product=DB::table('tbl_product')->where('product_id',$product_id)->first();
        $gallery=DB::table('tbl_gallery')->where('gallery_image',$product->product_image)->get();
        if ($gallery->count()) {            
            DB::table('tbl_gallery')->where('gallery_image',$product->product_image)->delete();
        $image_path='public/upload/gallery/'.$product->product_image;
        if (File::exists($image_path)) {
            unlink($image_path);
        }
         }
        unlink('public/upload/product/'.$product->product_image);
   		$result=DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        file::copy('public/upload/product/'.$new_image,'public/upload/gallery/'.$new_image);
        $gallery=new gallery;
        $gallery->gallery_name=$new_image;
        $gallery->gallery_image=$new_image;
        $gallery->product_id=$product_id;
        $gallery->save();   			    
        session()->flash('success', 'thêm mới thành công');
   		return Redirect('/all-product');}
   		$result=DB::table('tbl_product')->where('product_id',$product_id)->update($data);
   			    session()->flash('success', 'thêm mới thành công');
   		return Redirect('/all-product');
   	 }

     public function product_detail(Request $Request, $product_slug){
        $category_post=category_post::where('category_post_status',0)->orderBy('category_post_id','DESC')->get();
        $today=Carbon::now('Asia/Ho_Chi_Minh');
        $all_coupon=coupon::where('coupon_quantity','>','0')->where('coupon_date_end','>=',$today)->get();
        $coupon=coupon::where('coupon_quantity','>','0')->where('coupon_date_end','>=',$today)->take(3)->get();
        $feedback=DB::table('tbl_feedback')->join('tbl_product','tbl_product.product_id','=','tbl_feedback.product_id')->join('tbl_rating_star','tbl_rating_star.rating_star_id','=','tbl_feedback.rating_star_id')->join('tbl_customer','tbl_customer.customer_id','=','tbl_feedback.customer_id')->where('tbl_feedback.feedback_status',1)->where('tbl_product.product_slug',$product_slug)->get();
        $feedback_img=DB::table('tbl_feedback_img')->get();
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','asc')->get();
        $brand_product=DB::table('tbl_brand')->where('brand_status','0')->orderBy('brand_id','DESC')->get();
        $product_detail_by_id=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.product_slug',$product_slug)
        ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->where('product_status','0')->get();
        if ($product_detail_by_id->count()) {
        $product=DB::table('tbl_product')->where('product_slug',$product_slug)->first();
        $attribute=DB::table('tbl_attribute')->orderBy('attribute_id','asc')->where('product_id',$product->product_id)->get();
        $meta_desc=$product->product_desc;
      $meta_keywords=$product->product_name;
      $meta_title=$product->product_name; 
      $url_canonical=$Request->url();
        $product_views=product::where('product_slug',$product_slug)->first();
        $product_views->product_views = $product->product_views + 1;
        $product_views->save();
        foreach($product_detail_by_id as $key=>$value){
          $brand_id=$value->brand_id;
        }
        $related_product=DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_id',$brand_id)->whereNotin('tbl_product.product_slug',[$product_slug])->limit(3)->where('product_status','0')->get();
        $gallery = gallery::where('product_id',$product->product_id)->get();
        $rating=rating_star::where('product_id',$product->product_id)->get();
        $avg=0;
        $rating_sum=$rating->count();
        if($rating_sum>0){
        foreach($rating as $key =>$val){
            $avg+=$val->number;
        }
        $rating_star=round($avg/$rating_sum);
    }else{
        $rating_star=0;
    }

        $rating_5=rating_star::where('product_id',$product->product_id)->where('number',5)->count();
        if($rating_5>0){
        $rating_5=$rating_5/$rating_sum*100;
        }else{
        $rating_5=0;
    }
        $rating_1=rating_star::where('product_id',$product->product_id)->where('number',1)->count();
        if($rating_1>0){
        $rating_1=$rating_1/$rating_sum*100;
        }else{
        $rating_1=0;
    }
        $rating_2=rating_star::where('product_id',$product->product_id)->where('number',2)->count();
        if($rating_2>0){
        $rating_2=$rating_2/$rating_sum*100;
        }else{
        $rating_2=0;
    }
        $rating_3=rating_star::where('product_id',$product->product_id)->where('number',3)->count();
        if($rating_3>0){
        $rating_3=$rating_3/$rating_sum*100;
        }else{
        $rating_3=0;
    }
        $rating_4=rating_star::where('product_id',$product->product_id)->where('number',4)->count();
        if($rating_4>0){
        $rating_4=$rating_4/$rating_sum*100;
        }else{
        $rating_4=0;
    }
      return view('pages.product_detail')->with('product_detail_by_id',$product_detail_by_id)->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('related_product',$related_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('category_post',$category_post)->with('gallery',$gallery)->with('attribute',$attribute)->with('rating',$rating_star)->with('rating_sum',$rating_sum)->with('rating_1',$rating_1)->with('rating_2',$rating_2)->with('rating_3',$rating_3)->with('rating_4',$rating_4)->with('rating_5',$rating_5)->with(compact('feedback','feedback_img','coupon','all_coupon'));
        }
        else{
          return view('pages.error.404');
        }

     }
    public function attr_product($product_id){
        $all_product=DB::table('tbl_product')->where('product_id', $product_id)->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderBy('tbl_product.product_id','DESC')->get();
        $attr=attribute::where('product_id', $product_id)->get();
        return view('admin.product.attrproduct')->with(compact('all_product','attr'));
    }
    public function insert_attribute(Request $Request,$product_id){
        $data=$Request->all();
        $quantity=0;
        foreach($data['color'] as $key =>$val){
            $quantity=$quantity+$data['quantity'][$key];
        }
        $product=DB::table("tbl_product")->where('product_id',$product_id)->first();
        $attribute=DB::table("tbl_attribute")->where('product_id',$product_id)->sum('attribute_quantity');
        if($product->quantity<$attribute+$quantity){
        session::flash('error','số lượng tồn kho không đủ');
        return Redirect::back();
        }
        else{
        foreach($data['color'] as $key =>$val){
            $attribute_price[$key] = filter_var($data['price'][$key], FILTER_SANITIZE_NUMBER_INT);
            $quantity=$quantity+$data['quantity'][$key];
        $attr=new attribute;
        $attr->product_id=$product_id;
        $attr->attribute_color=$val;
        $attr->attribute_size=$data['size'][$key];
        $attr->attribute_price=$attribute_price[$key];
        $attr->attribute_quantity=$data['quantity'][$key];
        $attr->save();}
        session::flash('success','Thêm thành công');
        return Redirect::back();}
    }
    public function delete_attribute($attribute_id){
        $attr=attribute::where('attribute_id',$attribute_id)->delete();
        session::flash('success','Xóa thành công');
        return Redirect::back();
    }
    public function get_edit_attribute(Request $Request, $attribute_id){
        $attr=attribute::where('attribute_id',$attribute_id)->first();
        return response()->json($attr);
    }
    public function update_attribute(Request $Request){
        $data=$Request->all();
        $product=DB::table("tbl_product")->where('product_id',$data['product_id'])->first();
        $attribute=DB::table("tbl_attribute")->where('product_id',$data['product_id'])->where('attribute_id','!=',$data['attribute_id'])->get();
        $attribute=$attribute->sum('attribute_quantity');
        if($product->quantity<$attribute+$data['quantity']){
        $returnData = array(
            'status' => 'error',
            'message' => 'An error occurred!'
        );
        return Response()->json($returnData, 500);
    }else{
        $price=filter_var($data['price'],FILTER_SANITIZE_NUMBER_INT);
       $attr= attribute::find($data['attribute_id']);
        $attr->product_id=$data['product_id'];
        $attr->attribute_color=$data['color'];
        $attr->attribute_size=$data['size'];
        $attr->attribute_price=$price;
        $attr->attribute_quantity=$data['quantity'];
        $attr->save();
        return response()->json($attr);
    }}
    public function chart_product(Request $Request){

    $data = $Request->all();
    $get = DB::table('tbl_product')->where('product_sold','!=',null)->orderBy('product_sold','DESC')->take(10)->get();
    foreach($get as $key => $val){

        $chart_data[] = array(
            'period' => $val->product_name,
            'product_sold' => $val->product_sold,
        );
    }
    echo $data = json_encode($chart_data);
    }

    public function attr_view_ajax(Request $Request)
    {
        $data=$Request->all();
        $attr=DB::table('tbl_attribute')->where('product_id',$data['id'])->orderBy('attribute_id','asc')->first();
        $output='';
        $output.='<span>'.number_format($attr->attribute_price,0,',','.').' VNĐ</span></br></br></br><p>'.$attr->attribute_quantity.' sản phẩm có sẵn</p>';
        $output.='<input type="hidden" class="attribute-id'.$data['id'].'" value="'.$attr->attribute_id.'">';
        $output.='<input type="hidden" class="attribute-price'.$data['id'].'" value="'.$attr->attribute_price.'">';
        $output.='<input type="hidden" class="attribute-color'.$data['id'].'" value="'.$attr->attribute_color.'">';
        $output.='<input type="hidden" class="attribute-size'.$data['id'].'" value="'.$attr->attribute_size.'">';
        $output.='<input class="product_qty_'.$data['id'].'" type="hidden" value="'.$attr->attribute_quantity.'" />';

        echo $output;
    }
    public function attr_product_ajax(Request $Request)
    {
        $data=$Request->all();
        $attr=DB::table('tbl_attribute')->where('attribute_id',$data['id'])->first();
        $output='';
        $output.='<span>'.number_format($attr->attribute_price,0,',','.').' VNĐ</span></br></br></br><p>'.$attr->attribute_quantity.' sản phẩm có sẵn</p>';
        $output.='<input type="hidden" class="attribute-id'.$data['id_product'].'" value="'.$attr->attribute_id.'">';
        $output.='<input type="hidden" class="attribute-price'.$data['id_product'].'" value="'.$attr->attribute_price.'">';
        $output.='<input type="hidden" class="attribute-color'.$data['id_product'].'" value="'.$attr->attribute_color.'">';
        $output.='<input type="hidden" class="attribute-size'.$data['id_product'].'" value="'.$attr->attribute_size.'">';
        $output.='<input class="product_qty_'.$data['id_product'].'" type="hidden" value="'.$attr->attribute_quantity.'" />';

        echo $output;
    }
    public function ckeditor_upload(Request $request){
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move('public/upload/ckeditor', $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/upload/ckeditor/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }    
    }
}
