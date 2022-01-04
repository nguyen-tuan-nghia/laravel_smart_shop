@extends('layout')
@section('content')
<style>
* {
  box-sizing: border-box;
}
.main_body {
  background-color: #f1f1f1;
}
</style>
					<div class="signup-form" ><!--sign up form-->

		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4" style="background: white;">
{{-- 		@if (count($errors) > 0)
      <div class="alert alert-danger">
          Thông tin không đầy đủ, bạn cần chỉnh sửa như sau:
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
			@if(session()->has('error'))
			<div class="alert alert-danger">
				{{Session()->get('error')}}
			</div>
			@endif --}}
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập bằng tài khoản</h2>
						<form id="loginn">
							{{csrf_field()}}
							<div id="login_error"></div>
							<input id="login_email" type="text" placeholder="Tài khoản"  required=""/>
							<input id="login_pass" type="password" placeholder="Mật khẩu"  required=""/>
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập							
							</span>

							<button type="submit" class="btni btn-default">Đăng nhập</button>
						</form>
			
			<div class="col">
        <a href="{{url('/login-facebook')}}" class="fb btni">
          <i class="fa fa-facebook fa-fw"></i> Login with Facebook
         </a>
        <a href="{{url('/login-google')}}" class="google btni"><i class="fa fa-google fa-fw">
          </i> Login with Google+
        </a>
      </div>
								<span>
								<a href="{{url('/re-password')}}">Quên mật khẩu</a>
							</span>
								<span style="float:right">
								<a href="{{url('/register')}}">Đăng ký</a>
							</span>					
						</div><!--/login form-->
				</div>
			</div>
	</section><!--/form-->
<script type="text/javascript">
$(document).ready(function(){
$('#loginn').submit(function(e){	
	e.preventDefault();	
  var email=$('#login_email').val();
  var password=$('#login_pass').val();
  var _token = $('input[name="_token"]').val();
   $.ajax({
      url:"{{url('/login')}}",
      method:"POST",
      data:{email:email,password:password,_token:_token},
      success:function(data){
        if(data==1){	
        	$('#login_error').show();
          $('#login_error').addClass("alert alert-danger").html('Nhập sai tài khoản hoặc mật khẩu').slideUp(1500);
        }else if(data==2){
      window.location.href="{{url('/')}}";
    }   
        },error:function(data){
          $('#login_error').addClass("alert alert-danger").html('Lỗi đăng nhập').slideUp(1500);
          }
    });  
 });});
</script>
@endsection