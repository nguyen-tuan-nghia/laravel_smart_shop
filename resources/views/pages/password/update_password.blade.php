@extends('layout')
@section('content')
					<div class="signup-form"><!--sign up form-->
@if (count($errors) > 0)
      <div class="alert alert-danger">
          Thông tin không đầy đủ, bạn cần chỉnh sửa như sau:
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
	<section id="form"><!--form-->
		<div class="container">
			@if(session()->has('error'))
			<div class="alert alert-danger">
				{{Session()->get('error')}}
			</div>
			@endif
			<div class="row">
					<div class="re-pass"><!--login form-->
						<h2>Nhập mật khẩu mới của bạn:</h2>
						<?php
							$email=$_GET['email'];
							$re_token=$_GET['token'];
						 ?>
						<form method="post" id="update_password">
							{{csrf_field()}}
							<input type="hidden" id="email" name="email" value="{{$email}}" />
							<input type="hidden" id="re_token" name="re_token" value="{{$re_token}}" />

							<input type="password" id="password" name="password" placeholder="password" required="" />
							<div id="error_pass" style="color: red"></div>
							<button type="submit" class="btni btn-default">Gửi</button>
						</form>
					</div>
	</section><!--/form-->
<script type="text/javascript">
	$('#update_password').submit(function(e){
		e.preventDefault();
		var password=$('#password').val();
    var _token = $('input[name="_token"]').val();
    var re_token=$('#re_token').val();
    var email=$('#email').val();
		if(password==""){
			$('#error_pass').html('Bạn chưa nhập password');
		}
		else{
			$.ajax({
				url:$(this).attr('action'),
				method:"post",
				data:{password,_token,re_token,email},
				success:function(response){
					if(response==1){
             Swal.fire({
                 position: "",
                 icon: "success",
                 title: "Đổi mật khẩu thành công!!",
                 showConfirmButton: false,
                 timer: 2500
             });						
					}
					else{
							Swal.fire({
                 position: "",
                 icon: "error",
                 title: "Đã hết hạn đổi mật khẩu",
                 showConfirmButton: false,
                 timer: 2500
             });
						}
				},
				error:function(response){
							Swal.fire({
                 position: "",
                 icon: "error",
                 title: "Đã hết hạn đổi mật khẩu",
                 showConfirmButton: false,
                 timer: 2500
             });				
				}
		});
		}
	});
</script>
@endsection