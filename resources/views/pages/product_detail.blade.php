@extends('layout')
@section('content')
	@foreach($product_detail_by_id as $key2=> $product_detail)
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{URL::to('/danh-muc-san-pham/'.$product_detail->slug_category)}}">{{($product_detail->category_name)}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{($product_detail->product_name)}}</li>
  </ol>
</nav>
@endforeach
<style type="text/css">
.coupon_in_ptoduct_detail{
	padding: 5px 0px 5px 0px;
	text-align: center;
	margin-bottom: 20px;
	margin-left: 5px;
	border-style: dotted solid;
	border-color: #FFD800FF;
	border-radius: 12px;
	min-width: 120px;
	float: left;
	color: #FFCB00FF;
}
.coupon_in_ptoduct_detail:hover{
	border-color: #FF6A00FF;
	color: #FF4D00FF;
}
.lSSlideOuter .lSPager.lSGallery img {
	display: block;
	height: 140px;
	max-width: 100%;
	}
li.active {
	border: 2px solid white;
}
.comment-img img {
	border: 1px solid white;
	border-radius: 50%;
	width: 60px;
	height: 60px;
}
.glyphicon-star{
	color: #FFD800FF;
	font-size: 20px;
}
.modal-body{
	height: calc(46vh - 71px);
    overflow-y: scroll;
    padding-right: 0px;
    background-color: #dadde6;
    font-family: arial
}
</style>
	@foreach($product_detail_by_id as $key=> $product_detail)
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">

							<ul id="imageGallery">
							@foreach($gallery as $key => $gal)
							  <li data-thumb="{{asset('public/upload/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/upload/gallery/'.$gal->gallery_image)}}">
							    <img width="100%" alt="{{$gal->gallery_name}}" src="{{asset('public/upload/gallery/'.$gal->gallery_image)}}" />
							  </li>
							 @endforeach
							  
							 
							</ul>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h1>{{($product_detail->product_name)}}</h1>
                        <p class="rating">
                        @for($i=0;$i<$rating;$i++)
                            <span class="glyphicon glyphicon-star"></span>
                         @endfor
                         (Có: {{$rating}} đánh giá) | Đã bán: {{($product_detail->product_sold)}}
                        </p>
								<span>
									<form >
									@csrf
									<input type="hidden" value="{{$product_detail->product_id}}" class="cart_product_id_{{$product_detail->product_id}}">
									<input type="hidden" value="{{$product_detail->product_id}}" class="id_pro">
									@if($attribute->count()<=0)
										<span>{{number_format($product_detail->product_price,0,',','.')}} VNĐ</span><br><br><br><p>{{$product_detail->quantity}} sản phẩm có sẵn</p>
										<input type="hidden" class="product_qty_{{$product_detail->product_id}}" name="" value="{{$product_detail->quantity}}">
									@else
										<div id="load_attr"></div>	
									@endif
									<div class="clearfix"></div>
									@php
									$i=0; 
								@endphp
									<div class="form-check form-check-inline">
										@foreach($attribute as $key =>$attr)
									@php
									$i++;
								@endphp

										<div style="float: left;width: 130px;margin-right: 18px;">
										<button style="background: white;border: 1px solid rgba(0,0,0,.09);" class="btn btn-light attri attt{{$i}}" type="button" onclick="ulaa({{$i}})" data-id_product="{{$product_detail->product_id}}" id="{{$attr->attribute_id}}">
											<label style="padding: 0px 27px 0px 27px" class="form-check-label" for="inlineRadio1">{{$attr->attribute_color}}<p>{{$attr->attribute_size}}
											</p>
										</label></button>
											</div>
									  @endforeach
									</div>
									<div class="clearfix"></div>
									<br>
 									<p><b>Tình trạng : </b> còn hàng</p>
										<p><b>Điều kiện : </b> mới 100%</p>
										<p><b>Thương hiệu : </b>{{($product_detail->brand_name)}}</p>
										<hr>
										<p><strong>Mã giảm giá : </strong></p>
										<p>
										@foreach($coupon as $key =>$cou)
										<div class="coupon_in_ptoduct_detail">
										<?php
										if($cou->coupon_condition==2){
										$mumber=$cou->coupon_number;
										echo "Giảm ";
										echo substr_replace($mumber,'',-3).'K';
									}
										else{
										echo 'Giảm '.$cou->coupon_number.'%';
										}
										?>
									</div>
										@endforeach
									</p>
									<br>
									<br><hr>
									<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fapp-smart-shop.herokuapp.com%2Fchi-tiet-san-pham%2F{{$product_detail->product_slug}}&width=450&layout=standard&action=like&size=small&share=true&height=35&appId=396391251894516" width="450" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
										<br>
									<br>
									<label>Số lượng :</label>
									<input style="color:white;background:#FF2300FF" type="button" onclick="tru()" value="-" />

									<input class="cart_product_qty_{{$product_detail->product_id}}" id="qty" name="qty" type="number" min="1" max="{{$product_detail->quantity}}" value="1" />

									<input style="color:white;background:#FF2300FF" type="button" onclick="cong()" value="+"  />
								<br>
								<br><div class="row">
									<button type="button" class="btn btn-fefault cart add-to-cart" name="add-to-cart" data-id_product="{{$product_detail->product_id}}">
										<i class="fa fa-shopping-cart"></i>
										Thêm vào giỏ hàng
									</button></form>
									<button style="background: red;color: white" type="button" class="btn btn-fefault cart go-to-cart" name="go-to-cart" data-id_product="{{$product_detail->product_id}}">
										Mua Ngay
									</button>
								</div>
								</span>

							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					@endforeach
					<div class="tab-content">
					</div>
					<div class="category-tab shop-details-tab"><!--category-tab-->
						
						<div class="tab-content">
									<p><p>{!!$product_detail->product_content!!}</p>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <h1 class="rating-num">
                            {{$rating}}
                        </h1>
                        <div class="rating">
                            <span class="glyphicon glyphicon-star{{$rating==1||$rating==2||
                            	$rating==3||$rating==4||$rating==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{$rating==2||
                            	$rating==3||$rating==4||$rating==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{
                            	$rating==3||$rating==4||$rating==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{$rating==4||$rating==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{$rating==5?'':'-empty'}}"></span>
                        </div>
                        <div>
                            <span class="glyphicon glyphicon-user"></span> {{number_format($rating_sum,0,',','.')}} đánh giá
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row rating-desc">
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>5
                            </div>
                            <div class="col-md-9">
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{$rating_5}}%">
                                        <span class="sr-only">{{$rating_5}}%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 5 -->
                            <div class=" col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>4
                            </div>
                            <div class=" col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{$rating_4}}%">
                                        <span class="sr-only">{{$rating_4}}%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 4 -->
                            <div class=" col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>3
                            </div>
                            <div class=" col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{$rating_3}}%">
                                        <span class="sr-only">{{$rating_3}}%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 3 -->
                            <div class=" col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>2
                            </div>
                            <div class=" col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{$rating_2}}%">
                                        <span class="sr-only">{{$rating_2}}%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 2 -->
                            <div class=" col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>1
                            </div>
                            <div class="col-md-9">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
                                        aria-valuemin="0" aria-valuemax="100" style="width: {{$rating_1}}%">
                                        <span class="sr-only">{{$rating_1}}%</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end 1 -->
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($feedback as $key =>$val)
@if($feedback_img||$val->message)
<div class="style_comment">
<div class="row">
<div class="col-md-1 comment-img" style="margin-right:20px">
@if($val->customer_img!==null)
<img src="{{asset('public/upload/avata/'.$val->customer_img)}}" style="width:60px">
@else
<img src="{{asset('public/frontend/images/avatardefault_92824.png')}}" style="width:60px">
@endif
</div><div class="col-md-9">
	<strong style="color:#0094FFFF">{{$val->customer_name}}</strong>
	@if($val->rating_star_id!==null)                  
	<div class="rating">
                            <span class="glyphicon glyphicon-star{{$val->number==1||$val->number==2||
                            	$val->number==3||$val->number==4||$val->number==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{$val->number==2||
                            	$val->number==3||$val->number==4||$val->number==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{
                            	$val->number==3||$val->number==4||$val->number==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{$val->number==4||$val->number==5?'':'-empty'}}"></span>
                            <span class="glyphicon glyphicon-star{{$val->number==5?'':'-empty'}}"></span>
                        </div>
    @endif
    <p>{{$val->message}}</p>
    <p>
@foreach($feedback_img as $key =>$img)
@if($val->feedback_id==$img->feedback_id)
    <img style="height: 90px;padding-left: 5px" src="{{asset('public/upload/coment_img/'.$img->feedback_name)}}">
@endif
@endforeach
</p><p>{{$val->created_at}}</p></div></div>
 </div>
 @endif
 @endforeach
        @php
        $id=Session::get('customer_id');
        @endphp

							<div class="tab-pane fade active in" id="reviews" >
									<br><p><b>Viết bình luận</b></p>
				@if($id)
									<form>
										@csrf
										<input type="hidden" class="comment_name" value="{{$id}}">
										<textarea class="comment_content" style="height: 100px;" name="" ></textarea>
										<button type="button" class="btn btn-default pull-right send-comment">
											Đăng
										</button>
									</form>
				@else
					<div><a href="{{URL::to('/login-checkout')}}">Bạn cần đăng nhập để bình luận</a></div>
				
				@endif
									<div id="notify_comment"></div>
<div style="margin-top:60px">
	<input type="hidden" class="comment_product_id" value="{{$product_detail->product_id}}">
									<style type="text/css">
										.style_comment {
											margin-left: 20px;
										    border-radius: 10px;
											padding-top: 10px;
											width: 60%;
										}
										
									</style>
							<div class="row" id="comment_show" style="border-top: 1px solid black;">
							</div>
</div>
							</div>
							
						</div>
					</div><!--/category-tab-->

					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
								@foreach($related_product as $key =>$related)
								<a href="{{URL::to('/chi-tiet-san-pham/'.$related->product_slug)}}">
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
<img style="width: 160px;height: 200px;" src="{{URL::to('public/upload/product/'.$related->product_image)}}" alt="" />
                                            <p style="height: 30px">{{($related->product_name)}}</p>
                                            @if($related->sale_off!=null)
                                            <div class="bottom-left">Giảm giá : {{number_format($related->sale_off,0,',','.')}}Đ</div>
                                            @endif
                                            <h4>{{number_format($related->product_price,0,',','.')}} Đ</h4>
												</div>
											</div>
										</div>
									</div></a>
									@endforeach
								</div>
							</div>
						</div>
					</div><!--/recommended_items-->
</div>
	</section>
<div class="modal fade coupon-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <center><h2 class="modal-title" id="exampleModalLabel">Mã giảm giá</h2></center>
      <div class="modal-body" style="">
    @foreach($all_coupon as $key => $cou)
    <div class="card">
      <section class="date">
        <time datetime="23th feb">
          Giảm<span>
    <?php
	if($cou->coupon_condition==2){
	$mumber=$cou->coupon_number;
	echo substr_replace($mumber,'',-3).'K';
	}else{
		echo $cou->coupon_number.'%';
	}
	?>
			</span>
        </time>
      </section>
      <section class="card-cont">
        <h3>{{$cou->coupon_name}}</h3>
        <div class="even-date">
         <i class="fa fa-calendar"></i>
        </div>
       	<span style="color: red;">{{$cou->coupon_date_end}}</span>
          <p>Mã giảm giá:
            <strong>{{$cou->coupon_code}}</strong>
          </p>
      </section>
    </div>
    <br>
  @endforeach      
  </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$('.coupon_in_ptoduct_detail').click(function(){
		$('.coupon-modal').modal('show');
	});
</script>
<script type="text/javascript">
    attr_view_ajax();
    function attr_view_ajax(){
    var id=$('.id_pro').val();
    var _token=$('input[name="_token"]').val();
           $.ajax({ 
                url: '{{url('/attr-view-ajax')}}',
                method:'post',
                data:{_token:_token,id:id},
                success:function(data){
                    $('#load_attr').html(data);
                }
           });  
    }  
      $(document).on('click','.attri',function(){ 
        var id = $(this).attr('id');
        var id_product = $(this).data('id_product');
        var _token=$('input[name="_token"]').val();
           $.ajax({  
                url: '{{url('/attr-product-ajax')}}',
                method:'post',
                data:{id:id,_token:_token,id_product:id_product},
                success:function(data){
                    $('#load_attr').html(data);
                }
           });  
      });  
</script>
<script type="text/javascript">
	$('.attt1').css({"border":"1px solid red"});
	function ulaa(id){	
		var count=<?php echo $attribute->count(); ?>;
		for (var i = 1; i <= count; i++){
		if(i==id){
		$('.attt'+i).css({"border":"1px solid red"});
	}
		else{
		$('.attt'+i).css({"border":"1px solid rgba(0,0,0,.09)"});
		}
}
	}
</script>
<script type="text/javascript">
    n = document.getElementById('qty');		
	function tru(){
		n.stepDown(1);
	}
	function cong(){
		n.stepUp(1);
	}
</script>
<script type="text/javascript">
	            $('.go-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                // var cart_product_name = $('.cart_product_name_' + id).val();
                // var cart_product_image = $('.cart_product_image_' + id).val();
                // var cart_product_price = $('.cart_product_price_' + id).val();
                var product_qty=$('.product_qty_'+id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                // var cart_update_quantity = $('.cart_update_quantity_' + id).val();
                var color=$('.attribute-color' + id).val();
                var size=$('.attribute-size' + id).val();
                var price=$('.attribute-price' + id).val();
                var attribute_id=$('.attribute-id' + id).val();
                var _token = $('input[name="_token"]').val();
                if(typeof color=="undefined"){
                	color=0;
                	size=0;
                	price=0;
                	attribute_id=0;
                }
                if(parseInt(product_qty)<parseInt(cart_product_qty)){
                          Swal.fire({
                                    position: "",
                                    icon: "",
                                    title: "Sản phẩn tồn kho còn "+product_qty +" chiếc!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });  
                }
                else{
                $.ajax({
                    url: '{{url('/save-cart')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_qty:cart_product_qty,_token:_token,color:color,size:size,price:price,attribute_id:attribute_id},
                    success:function(respone){
                        if(respone==1){
                            Swal.fire({
                                    position: "",
                                    icon: "",
                                    title: "Sản phẩn tồn kho còn "+product_qty +" chiếc!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });                        
                        }
                        else if(respone==2){
                        	window.location.href="{{url('/show-cart')}}";
                    }}
                });}
            });
</script>
<script type="text/javascript">        
        load_comment();

        function load_comment(){
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{url('/load-comment')}}",
              method:"POST",
              data:{product_id:product_id, _token:_token},
              success:function(data){
              
                $('#comment_show').html(data);
              }
            });
        }
        $('.send-comment').click(function(){
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{url('/send-comment')}}",
              method:"POST",
              data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content, _token:_token},
              success:function(data){
                
                $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>');
                load_comment();
                $('#notify_comment').fadeOut(9000);
                $('.comment_name').val('');
                $('.comment_content').val('');
              }
            });
        });
</script>
					@endsection