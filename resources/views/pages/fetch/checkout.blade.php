<form>
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
			<div class="shopper-informations">
				<div class="row">
					<div {{-- class="col-sm-10 clearfix" --}}>
						<div class="bill-to">
							@php
										$id=Session::get('customer_id');
										$address=Session::get('address');
										$phone=Session::get('phone');
										$name=Session::get('customer_name');
										$email=Session::get('email');
										$shipping_name=Session::get('shipping_name');
										$shipping_address=Session::get('shipping_address');
										$shipping_phone=Session::get('shipping_phone');
									@endphp	
<div>
 <p>Shipping</p>
 		@if(Session::get('fee'))
		<p><label>thông tin giao hàng:  {{$shipping_name}}- {{$shipping_address}}</label>
			<a href="javascript:void(0)"data-toggle="modal" data-target="#myModal2">Thay đổi</a>
</p>
		@else
		<p><label>Chưa có địa chỉ giao hàng</label>
			<a href="javascript:void(0)"data-toggle="modal" data-target="#myModal2">Thay đổi</a>
</p>
		@endif
     <!-- The Modal -->
  <div class="modal" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <center><h4 class="modal-title">Địa chỉ giao hàng</h4></center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <form>
       
        <!-- Modal body -->
        <div class="modal-body">
        	@csrf
		          <div class="row">
		          		<div class="form-group">
		          		<label>Họ và tên: </label>
		          		<input class="form-control shipping_name" id="shipping_name" type="text" 
		          		name="" value="{{$shipping_name}}">
		          	</div>
						<div class="form-group">
		          		<label>Số điện thoại: </label>
		          		<input class="form-control shipping_phone" id="shipping_phone" type="text" 
		          		name="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{$shipping_phone}}">
		          	</div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">Chọn thành phố</label>
                                <select name="city" id="city" class="form-control input-sm m-bot15 city choose">
                                    <option value=" ">--Chọn tỉnh thành phố--</option>
                                    @foreach($city as $key2 => $city2)
                                <option value="{{($city2->matp)}}">{{($city2->name_tp)}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">Chọn quận huyện</label>
                                <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                    <option value=" ">--Chọn quận huyện--</option>
                            </select>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">Chọn xã phường</label>
                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value=" ">--Chọn xã phường--</option>
                            </select>
                        </div>
						<div class="form-group">
                             <label for="exampleInputPassword1">Địa chi tiết</label>
							<input class="form-control shipping_address" type="text" value="{{$shipping_address}}">
						</div>
			</div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
		  <button style="margin-bottom: 20px;" type="button" class="btn btn-default check_out add_fee">tính phí vận chuyển</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
	<textarea class="order_message" name="order_message"  placeholder="Viết yêu cầu" rows="3"></textarea>

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
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
      <p>Thông tin giỏ hàng : </p>
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
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/upload/product/'.$v_content->options->image)}} " width="50"></a>
							</td>
							<td class="cart_description">
								<h4><a href=""></a>{{($v_content->name)}}</h4>
							@if($v_content->options->attribute_id)
								<p>Màu sắc: {{($v_content->options->color)}}</p>
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

			{{csrf_field()}}	
				<div class="col-sm-6">
					<div class="total_area">

 					</div>
				</div>

			<div class="payment-options">

					@if(Session::get('fee')&&Session::get('address')&&Session::get('phone'))
					<div class="tab">
			           <button type="button" class="tablinks" id="defaultOpen" onclick="openCity(event, 'hand')">Trả tiền mặt</button>
			           <button type="button" class="tablinks" onclick="openCity(event, 'card')">Thanh toán qua thẻ</button>
			         </div>
			         <div id="hand" class="tabcontent">
			         	<div class="row" style="height: 80px;">
						<div class="col-sm-3">
						<button class="btn btn-default check_out pay_by_cash" type="button">Thanh toán bằng tiền mặt</button></div>
					</div>
						</div>
			         <div id="card" class="tabcontent">
						<div class="row" style="height: 80px;">
						<div class="col-sm-3" style="margin-top: 20px;">
						<div id="paypal-button"></div></div>
						<div class="col-sm-3" style="margin-top: 0px;">
							<form action="{{url('/create-vnpay')}}" id="frmCreateOrder" method="post">
							    @csrf    
    							<input type="hidden" class="total_price_vnpay" id="total_price_vnpay" name="Amount" value="">
							<button style="border-radius: 20px;width: 170px;background: #FFD823FF;" class="btn btn-default check_out" id="vnpay_button" type="submit"><strong><span style="color:red">VN</span>
							<span style="color:blue;">PAY</span></strong></button>
							<p style="font-size: 10px;">Thẻ ATM, VISA, ví điện tử v.v..</p>
						</form>						
					</div>
						<div class="col-sm-3" style="margin-top: 0px;">
							<form action="{{url('/create-momo')}}" id="frmCreateOrder" method="post">
							    @csrf    
    							<input type="hidden" class="total_price_momopay"
    							 id="total_price_momopay" name="momo_Amount" value="">
							<button style="border-radius: 20px;width: 170px;background: #FF006EFF;" class="btn btn-default check_out" id="vnpay_button" type="submit"><strong><span>MoMo</span></strong></button>
							<p style="color: red;font-size: 10px;">lưu ý: Chỉ thanh toán dưới 50 triệu VND</p>
						</form>						
					</div>
					</div>
				</div>
					@elseif(!Session::get('address')&&!Session::get('phone'))
					<div class="col-sm-12" style="color: red">Bạn cần điền đầy đủ thông tin người gửi để thanh toán giỏ hàng  <a href="{{URL('/avata')}}">tại đây</a> </div>
					@elseif(!Session::get('fee')&&Session::get('address')&&Session::get('phone'))
						<div class="col-sm-12" style="color: red">Bạn cần tính phí vận chuyển để thanh toán giỏ hàng</div>
@endif
				</div>
			</div>
		</div>
</form>

<?php }
else{
	?>
	<div class="container">
			<img src="{{(URL::to('public/frontend/2.png'))}}" alt="avatar" style="width: 100%">
<a style="margin:10px 30% 100px 35%; width: 30%; height:20%;
" href="{{(URL::to('/'))}}" class="btn btn-fefault cart">MUA NGAY</a>
	</div>
<?php } ?>
</div>
</div>
	</section><!--/#do_action-->
<script type="text/javascript">
	bang_thanh_toan_check();
	function bang_thanh_toan_check(){
		$.ajax({
			url:"{{url('/bang-thanh-toan-check')}}",
			method:"get",
			success:function(data){
				$('.total_area').html(data);
				vnpay();
				momopay();
				dem_so();
			}
		});
	}
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
                            bang_thanh_toan_check();
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
                            bang_thanh_toan_check();
                }else{
                        toastr.warning('Không thể xóa, Không tồn tại mã giảm giá')

                    }
                }  
                
            });
        });
        $('.pay_by_cash').click(function(){
            // var order_total=$('.total_price').val();
            var shipping_name=$('.shipping_name').val();
            var shipping_phone=$('.shipping_phone').val();
            var order_message=$('.order_message').val();
            var order_fee=$('.order_fee').val();
            var coupon_text=$('.coupon_text').val();
            var _token=$('input[name="_token"]').val();
            var payment='Trả tiền mặt';

            if (order_fee==' ') {
                alert('Bạn cần tính phí vận chuyển trước khi đặt hàng')
            }

            else{
            if(shipping_name==''||shipping_phone==''){
                alert('Bạn cần điền đủ thông tin người nhận')
            }
            else{
            $.ajax({
                url: '{{url('/order-place')}}',
                method:'post',
                data:{payment:payment,shipping_name:shipping_name,shipping_phone:shipping_phone,order_message:order_message,order_fee:order_fee,coupon_text:coupon_text,_token:_token},
                success:function(data){
                        location.href = "{{url('/thanh-toan-thanh-cong')}}";
            
                }
            });
        }}
        });
});
</script>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<script type="text/javascript">
	vnpay();
	function vnpay(){
	var total_price=0;
		$(document).ready(function(){
			total_price=$('.total_price').val();
		});
	document.getElementById('total_price_vnpay').value=total_price;
}
</script>
<script type="text/javascript">
	momopay();
	function momopay(){
	var total_price=0;
		$(document).ready(function(){
			total_price=$('.total_price').val();
		});
	document.getElementById('total_price_momopay').value=total_price;
}
</script>
<script type="text/javascript">
        $('.choose').change(function(){
                var action=$(this).attr('id');
                var ma_id=$(this).val();
                var _token=$('input[name="_token"]').val();
                var result='';

                if (action=='city') {
                    result='province';
                }
                else{
                    result='wards';
                }
                $.ajax({
                    url : '{{url('/select-delivery-home')}}',
                    method: 'post',
                    data: {action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                });
        });
        $('.add_fee').click(function(){
            var city=$('.city').val();
            var province=$('.province').val();
            var wards=$('.wards').val();
            var _token=$('input[name="_token"]').val();
            var city_text=$('.city').find('option:selected').text();
            var province_text=$('.province').find('option:selected').text();
            var wards_text=$('.wards').find('option:selected').text();
            var shipping_address=$('.shipping_address').val();
            var shipping_name=$('#shipping_name').val();
            var shipping_phone=$('#shipping_phone').val();
             if(shipping_name==""||shipping_phone==""){
                Swal.fire({
                            position: "",
                            icon: "error",
                            title: "Bạn chưa nhập thông tin người nhận!",
                            showConfirmButton: false,
                            timer: 1500
                        });     
            }
            else if(city==' '||province==' '||wards==' '||shipping_address==''){
                Swal.fire({
                            position: "",
                            icon: "error",
                            title: "Bạn chưa nhập dịa chỉ!",
                            showConfirmButton: false,
                            timer: 1500
                        });     
            }
            else{
            $.ajax({
                url: '{{url('/insert-fee')}}',
                method: 'post',
                data: {city:city,province:province,wards:wards,_token:_token,city_text:city_text,province_text:province_text,wards_text:wards_text,shipping_address:shipping_address,shipping_name:shipping_name,shipping_phone:shipping_phone},
                success:function(data){
                    Swal.fire({
                            position: "",
                            icon: "success",
                            title: "Thêm thông tin vận chuyển thành công!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    $('#myModal2').modal('hide');
                            // setTimeout(function(){
                            //    window.location.reload(1);
                            // }, 1500);
                            $('.fetch_checkout').html(data);
                            bang_thanh_toan_check();
                        }
            });}
        });
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
				bang_thanh_toan_check();
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
				bang_thanh_toan_check();
			}
			}
		});
	});
</script>
<script type="text/javascript">
    function pay(){
            // var order_total=$('.total_price').val();
            var shipping_name=$('.shipping_name').val();
            var shipping_phone=$('.shipping_phone').val();
            var order_message=$('.order_message').val();
            var order_fee=$('.order_fee').val();
            var coupon_text=$('.coupon_text').val();
            var _token=$('input[name="_token"]').val();
            var payment='Paypal';
            $.ajax({
                url: '{{url('/order-place')}}',
                method:'post',
                data:{payment:payment,shipping_name:shipping_name,shipping_phone:shipping_phone,order_message:order_message,order_fee:order_fee,coupon_text:coupon_text,_token:_token},
                success:function(data){
                        location.href = "{{url('/thanh-toan-thanh-cong')}}";
                }
            });
    }
</script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
	var vnd_usd=0;
	$(document).click('#paypal-button',function(){
    vnd_usd=$('#paypal_total').val();
});
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AU6V3tMjm0p5FUQSpGxvfw0w0HbCy-dnSj5sI5XilsZ6U62I1pv3cQmGZ8Q6l-dkO4lztuiPwZh-th4v',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: `${vnd_usd}`,
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment

    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {

        // Show a confirmation message to the buyer
		Swal.fire({
		            position: "",
		            icon: "success",
					title: "Thanh toán thành công!!",
		            showConfirmButton: false,
		            timer: 5500
		        });    location.href = "{{url('/thanh-toan-thanh-cong')}}";

        pay();
      });
    }
  }, '#paypal-button');
</script>