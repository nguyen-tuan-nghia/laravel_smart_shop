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
						<h2>Nhập Email:</h2>
						<form method="post" id="re_password">
							{{csrf_field()}}
							<input type="email" id="email" name="email" placeholder="email" required="" />
							<div id="error_pass" style="color: red"></div>
							<button type="submit" class="btni btn-default">Gửi</button>
						</form>
					</div>
	</section><!--/form-->
<script type="text/javascript">
	$('#re_password').submit(function(e){
		e.preventDefault();
		var email=$('#email').val();
    var _token = $('input[name="_token"]').val();
		if(email==""){
			$('#error_pass').html('Bạn chưa nhập email');
		}
		else{
			$.ajax({
				url:"{{url('/re-password')}}",
				method:"post",
				data:{email,_token},
				success:function(response){
					if(response==1){
             Swal.fire({
                 position: "",
                 icon: "success",
                 title: "Mật khẩu đã được gửi về mai của bạn!!",
                 showConfirmButton: false,
                 timer: 2500
             });						
					}
					else if(response==2){
             Swal.fire({
                 position: "",
                 icon: "",
                 title: "webstile không hỗ trợ đăng nhập của bên thứ ba",
                 showConfirmButton: false,
                 timer: 2500
             });						
					}
				},
				error:function(response){
							Swal.fire({
                 position: "",
                 icon: "error",
                 title: "Không tồn tại email này",
                 showConfirmButton: false,
                 timer: 2500
             });				
				}
		});
		}
	});
</script>
@endsection