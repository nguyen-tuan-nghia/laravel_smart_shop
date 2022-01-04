@extends('layout')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			<?php 
			if (Cart::count()) {?>
	@if(session()->has('error'))
        <div class="alert alert-danger">
          {{ session()->get('error') }}
        </div>
      @endif
	@if(session()->has('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div>
      @endif
      <div id="load_cart">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản phẩm</td>
							<td class="description"></td>
							<td class="price">Gía</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
						$content=Cart::content();
						?>
						@php
						$total=0;
						@endphp
						@foreach($content as $v_content)
						<tr>
							@if($v_content->options->attribute_id)
						@foreach($attr as $key =>$att)
							@if($att->attribute_id==$v_content->options->attribute_id)
							<input type="hidden" id="ton_kho{{$att->attribute_id}}" value="{{$att->attribute_quantity}}">
							@endif
						@endforeach
						@else
						@foreach($product as $key =>$pro)
							@if($pro->product_id==$v_content->id)
							<input type="hidden" id="ton_kho{{$v_content->id}}" value="{{$pro->quantity}}">
							@endif
						@endforeach
						@endif
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/upload/product/'.$v_content->options->image)}} " width="50"></a>
							</td>
							<td class="cart_description">
								<h4><a href=""></a>{{($v_content->name)}}</h4>
							@if($v_content->options->attribute_id)
								<p>Màu sắc: {{$v_content->options->color}}</p>
								<p>Dung lượng: {{$v_content->options->size}}</p>
							@endif
								<p>ID: {{($v_content->id)}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price,0,',','.').'VNĐ'}} </p>
							</td>
							<td class="cart_quantity">
								<form role="form" action="" method="POST">
									{{csrf_field()}}
								<div class="cart_quantity_button">
									@if($v_content->options->attribute_id)
									<input style="color:white;background:#FF2300FF" type="button" onclick="tru({{($v_content->options->attribute_id)}})" value="-" />
									<input style="width: 50px" class="cart_quantity_input_{{$v_content->options->attribute_id}}  update_cart" type="number" min="1" name="quantity" value="{{($v_content->qty)}}" data-cart_rowl="{{($v_content->rowId)}}" autocomplete="off" size="2" id="{{$v_content->options->attribute_id==null?$v_content->id:$v_content->options->attribute_id}}">
									<input style="color:white;background:#FF2300FF" type="button" onclick="cong({{($v_content->options->attribute_id)}})" value="+"  />
									<input type="hidden" name="" class="show_cart_product_id{{$v_content->options->attribute_id}}" value="{{$v_content->id}}">
									@else
									<input style="color:white;background:#FF2300FF" type="button" onclick="tru({{($v_content->id)}})" value="-" />
									<input style="width: 50px" class="cart_quantity_input_{{$v_content->id}}  update_cart" type="number" min="1" name="quantity" value="{{($v_content->qty)}}" data-cart_rowl="{{($v_content->rowId)}}" autocomplete="off" size="2" id="{{$v_content->id}}">
									<input style="color:white;background:#FF2300FF" type="button" onclick="cong({{($v_content->id)}})" value="+"  />
									<input type="hidden" name="" class="show_cart_product_id{{($v_content->id)}}" value="{{$v_content->id}}">
									@endif
									<input type="hidden" class="cart_rowld" value="{{($v_content->rowId)}}" name="rowId_product">
									<input type="hidden" class="cart_id{{$v_content->rowId}}" value="{{($v_content->options->attribute_id)}}" name="">
{{-- 									<button type="button" class="btn btn-default btn-sm update_cart" data-cart_rowl="{{($v_content->rowId)}}">Cập nhật</button>
 --}}								</div>
							</td>
							<td class="cart_total">
								@if($v_content->options->attribute_id)
								<p class="cart_total_price{{$v_content->options->attribute_id}}">
									<?php
									$subtotal=$v_content->price * $v_content->qty;
									echo number_format($subtotal,0,',','.').'VNĐ';
									?>
								</p>
								@else
								<p class="cart_total_price{{$v_content->id}}">
									<?php
									$subtotal=$v_content->price * $v_content->qty;
									echo number_format($subtotal,0,',','.').'VNĐ';
									?>
								</p>								
								@endif
							</td>
							<td class="cart_delete">
								<button type="button" style="background:white;border: none;color:red" class="delete_by_cart" data-cart_rowl_delete="{{($v_content->rowId)}}">Xóa</button></form>

{{-- 								<a class="cart_quantity_delete" href="{{URL::to('/delete-by-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a> --}}
							</td>
						</tr>
						@php
							// $total=Cart::subtotal();
							$total+=$subtotal;
							@endphp
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</section> <!--/#cart_items-->
		<section id="do_action">
		<div class="container">
			<div class="heading">

			</div>
			<div class="row">
				<div class="col-sm-6">
				<form action="" method="post" onsubmit="return false;">
					@csrf
					<input style="width: 300px;" type="text" class="form-control coupon_input" name="coupon" placeholder="Mã giảm giá">
							<buton type="buton" class="btn btn-default check_out them_giam_gia" name="check_coupon">Tính mã giảm giá</buton>
{{-- 					<a class="btn btn-default check_out" name="" href="{{URL::to('/delete-coupon')}}">Xóa mã giám giá</a>
 --}}						<buton type="buton" class="btn btn-default check_out xoa_giam_gia" name="check_coupon">Xóa mã giảm giá</buton>
				</form>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
<?php }
else{
	?>
	<div class="container">
			<img src="{{(URL::to('public/frontend/2.png'))}}" alt="avatar" style="width: 100%">
<a style="margin:10px 30% 100px 35%; width: 30%; height:20%;
" href="{{(URL::to('/'))}}" class="btn btn-fefault cart">MUA NGAY</a>
	</div>
<?php } ?>
<script type="text/javascript">
	bang_thanh_toan();
	function bang_thanh_toan(){
		$.ajax({
			url:"{{url('/bang-thanh-toan')}}",
			method:"get",
			success:function(data){
				$('.total_area').html(data);
			}
		});
	}
</script>
<script type="text/javascript">		
	function tru(id){	
		n=document.getElementById(id);
		n.stepDown(1);
		update_cart(id);
	}
	function cong(id){
		n=document.getElementById(id);
		n.stepUp(1);
		update_cart(id);
	}
</script>
<script type="text/javascript">
	function update_cart(id){
	var rowld=$('.cart_quantity_input_'+id).data('cart_rowl');
    var _token=$('input[name="_token"]').val();
    var attr_id=$('.cart_quantity_input_'+id).attr('id');
    var cart_quantity=$('.cart_quantity_input_'+id).val();
    var ton_kho=$('#ton_kho'+id).val();
    var product_id=$('.show_cart_product_id'+id).val();
		$.ajax({
			url:"{{url('/cart-total-price')}}",
			method:"post",
			data:{product_id:product_id,cart_quantity:cart_quantity,rowld:rowld,attr_id:attr_id,_token:_token},
			success:function(data){
				if(data==1){
					Swal.fire({
		            position: "",
		            icon: "",
					title: "Sản phẩn tồn kho còn "+ton_kho+" chiếc!",
		            showConfirmButton: false,
		            timer: 5500
		        });
		        $('.cart_quantity_input_'+id).val(ton_kho);             
				}else{
				$('.cart_total_price'+attr_id).html(data);
				bang_thanh_toan();
			}
			}
		});
	}
</script>
<script type="text/javascript">
	$('.update_cart').change(function(){
	var rowld=$(this).data('cart_rowl');
    var _token=$('input[name="_token"]').val();
    var attr_id=$(this).attr('id');
    var cart_quantity=$(this).val();
    var ton_kho=$('#ton_kho'+attr_id).val();
     var product_id=$('.show_cart_product_id'+attr_id).val();
		$.ajax({
			url:"{{url('/cart-total-price')}}",
			method:"post",
			data:{product_id:product_id,cart_quantity:cart_quantity,rowld:rowld,attr_id:attr_id,_token:_token},
			success:function(data){
				if(data==1){
					Swal.fire({
		            position: "",
		            icon: "",
					title: "Sản phẩn tồn kho còn "+ton_kho +" chiếc!",
		            showConfirmButton: false,
		            timer: 5500
		        });
		        $('.cart_quantity_input_'+attr_id).val(ton_kho);
				}else{
				$('.cart_total_price'+attr_id).html(data);
				bang_thanh_toan();
			}
			}
		});
	});
</script>
<script type="text/javascript">
    $(document).ready(function(){
          $('.delete_by_cart').click(function(){
            var rowld=$(this).data('cart_rowl_delete');
            var _token=$('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/delete-by-cart')}}',
                method:'post',
                data:{rowld:rowld,_token:_token},
                success:function(data){
                    location.reload();               
                }   
            });
        });
          $('.them_giam_gia').click(function(){
            var coupon_input=$('.coupon_input').val();
            var _token=$('input[name="_token"]').val();
            if (coupon_input=='') {
                // alert('Bạn chưa nhập mã giảm giá');
                $('.coupon_input').css({"border-color":"#a94442","box-shadow":"inset 0 1px 1px rgb(0 0 0 / 8%)"});
            }
            else{
            $.ajax({
                url:'{{url('/checkout-coupon')}}',
                method:'post',
                data:{coupon_input:coupon_input,_token:_token},
                success:function(respone){
                    if (respone=="1") {
                            toastr.success('Thêm mã giẩm giá thành công', 'Thông báo',{timeOut: 5000});
							bang_thanh_toan();
                        }else if(respone=='2'){
                        toastr.warning('Mã giảm giá đã sử dụng')
                    }else if(respone=='0'){
                        toastr.warning('hiện không có chương trình có mã giảm giá này!!!')
                    }else if(respone=='3'){
                        toastr.warning('Bạn cần đăng nhập để thêm mã giảm giá')
                    }
                }     
            });}
        });
          $('.xoa_giam_gia').click(function(){
            var _token=$('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/delete-coupon')}}',
                method:'post',
                data:{_token:_token},
                success:function(respone){
                    if (respone=="1") {
                            toastr.success('Xóa mã giảm giá thành công', 'Thông báo',{timeOut: 5000});
                            bang_thanh_toan();
                }else{
                        toastr.warning('Không thể xóa, Không tồn tại mã giảm giá')

                    }
                }  
                
            });
        });
});
</script>
	@endsection