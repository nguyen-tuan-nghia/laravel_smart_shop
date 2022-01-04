@if($feedback->count()<=0)
    <center>
<img src="https://frontend.tikicdn.com/_desktop-next/static/img/mascot_fail.svg">
<p>Viết nhận xét với sản phẩm bạn đã sử dụng để cung cấp thông tin hữu ích cho mọi người</p>
<div class="btn btn-warning" style="background-color: #FFD800FF"><a href="{{URL::to('/')}}">Mua ngay</a></div>
</center>
@else
@foreach($feedback as $key =>$val)
@if($feedback_img||$val->message)
<div class="style_comment" style="font-size: 20px;margin-bottom:20px;border: 1px solid #C0C0C0FF; width: 450px;
">
<div class="row">
  <a style="float: right;color :red; padding-right: 15px;" href="javascript:void(0)" onclick="edit_feeedback_modal({{$val->feedback_id}})">Sửa</a>
<div class="col-md-9">
  <strong>Mã hóa đơn:{{$val->order_id}}</strong>
  <p>
  <strong>Tên sản phẩm: <a href="{{URL::to('/chi-tiet-san-pham/'.$val->product->product_slug)}}">{{$val->product->product_name}}</a></strong></p>
  @if($val->rating_star_id!==null)                  
  <div class="rating" style="color: #FFD400FF">
                            <span class="glyphicon glyphicon-star{{$val->rating_star->number==1||$val->rating_star->number==2||
                              $val->rating_star->number==3||$val->rating_star->number==4||$val->rating_star->number==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{$val->rating_star->number==2||
                              $val->rating_star->number==3||$val->rating_star->number==4||$val->rating_star->number==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{
                              $val->rating_star->number==3||$val->rating_star->number==4||$val->rating_star->number==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{$val->rating_star->number==4||$val->rating_star->number==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{$val->rating_star->number==5?'':'-empty'}}"></span>
                        </div>
    @endif
    <p>{{$val->message}}</p>
    <p>
@foreach($feedback_img as $key =>$img)
@if($val->feedback_id==$img->feedback_id)
    <img style="height: 85px; padding-left: 5px" src="{{asset('public/upload/coment_img/'.$img->feedback_name)}}">
@endif
@endforeach
</p><p style="font-size: 10px">{{$val->created_at}}</p></div></div>
 </div>
 @endif
@endforeach
@endif