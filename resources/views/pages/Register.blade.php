@extends('layout')
@section('content')
<style type="text/css">
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 50%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
</style>
<div class="container">
  
<div class="stepwizard col-md-offset-3">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
        <p>Bước 1</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
        <p>Bước 2</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
        <p>Bước 3</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
        <p>Bước 4</p>
      </div>
    </div>
  </div>
  
  <form >
    <div class="row setup-content" id="step-1">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>Bước 1</h3>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input id="email" maxlength="100" type="email" required="required" class="form-control" placeholder="Enter email"  />
            <label class="control-label">Mã xác nhận sẽ được gửi vào mail bạn</label>
          </div>
          <button class="btn btn-primary nextBtn btn-lg pull-right" id="send_mail" type="button" >Xác thực</button>
        </div>
      </div>
    </div>
    <div class="row setup-content" id="step-2">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>Bước 2</h3>
          <div class="form-group">
            <label class="control-label">Mã OTP:</label>
            <input id="otp" maxlength="200" type="text" required="required" class="form-control" placeholder="Enter OTP" />
            <label class="control-label">Vui lòng nhập mã xác nhận để tiếp tục</label>
          </div>
          <button class="btn btn-primary nextBtn btn-lg pull-right" id="res_otp" type="button" >Tiếp tục</button>
        </div>
      </div>
    </div>
    <div class="row setup-content" id="step-3">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>Bước 2</h3>
          <div class="form-group">
            <label class="control-label">Tên tài khoản:</label>
            <input maxlength="200" type="text" id="name" required="required" class="form-control" placeholder="Enter accout name" />
          </div>
          <div class="form-group">
            <label class="control-label">Mật khẩu:</label>
            <input maxlength="200" type="password" id="pass" required="required" class="form-control" placeholder="Enter password" />
          </div>
          <div class="form-group">
            <label class="control-label">Đại chỉ:</label>
            <input maxlength="200" type="text" id="address" required="required" class="form-control" placeholder="Enter address" />
          </div>
          <div class="form-group">
            <label class="control-label">Số điện thoại:</label>
            <input maxlength="200" type="text" id="phone" required="required" class="form-control" placeholder="Enter phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
          </div>
          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Tiếp tục</button>
        </div>
      </div>
    </div>
    <div class="row setup-content" id="step-4">
      <div class="col-xs-6 col-md-offset-3">
        <div class="col-md-12">
          <h3>Bước 4</h3>
          <div class="form-group">
            <label class="control-label">Hãy xác nhận lại thông tin của bạn trước khi gửi yêu cầu đăng ký</label>
          </div>
          <button class="btn btn-success btn-lg pull-right" id="submit_register" type="button">Gửi</button>
        </div>
      </div>
    </div>
  </form>
  
</div>
<script type="text/javascript">
  $(document).ready(function () {
  $('#res_otp').click(function(){
  var otp=$('#otp').val();
  var email=$('#email').val();
  var _token = $('input[name="_token"]').val();
    if(otp!=""&& email!=""){
    $.ajax({
      url:"{{url('/otp-mail')}}",
      method:"post",
      data:{otp:otp,_token:_token},
      success:function(data){
        if(data==1){
        toastr.error('Nhập sai mã OTP', 'Thông báo');
        window.setTimeout(function () {
          window.location.reload();
        }, 3000);    
        }else{
            toastr.success('Nhập mã OTP thành công!!', 'Thông báo');
    }   
        },
      error:function(data){
          alert("Lỗi đăng nhập");
          window.location.reload();
    }
    });
    }
  });
  $('#send_mail').one('click',function(){
  var email=$('#email').val();
  var _token = $('input[name="_token"]').val();
  if (email!=""){
    $.ajax({
      url:"{{url('/register-mail')}}",
      method:"post",
      data:{email:email,_token:_token},
      success:function(data){
        if(data==1){
        toastr.error('Tài khoản của bạn đã tồn tại', 'Thông báo');
        window.setTimeout(function () {
          window.location.reload();
        }, 3000);        
      }else{
      toastr.success('Mã xác minh đã được gửi vào mail của bạn!', 'Thông báo');
    }   
        },
      error:function(data){
          alert("Lỗi đăng nhập");
          window.location.reload();
          }
    });
  }
  });
  $('#submit_register').click(function(){
  var name=$('#name').val();
  var phone=$('#phone').val();
  var email=$('#email').val();
  var address=$('#address').val();
  var password=$('#pass').val();
  var _token = $('input[name="_token"]').val();
  if(password==""||name==""||phone==""||email==""||address=="")
  {
    toastr.warning('Điền đủ thông tin chước khi xác nhận!!');
  }
  else{
   $.ajax({
      url:"{{url('/save-customer')}}",
      method:"post",
      data:{email:email,name:name,password:password,phone:phone,address:address,_token:_token},
      success:function(data){
        if(data==1){
        toastr.error('Tài khoản của bạn đã tồn tại', 'Thông báo');
        window.setTimeout(function () {
          window.location.reload();
        }, 3000);  
        }else if(data==2){
      Swal.fire({
                position: "",
                icon: "success",
                title: "Đăng ký thành công",
                showConfirmButton: false,
                timer: 4500
            });
      window.location.href="{{url('/')}}";
    }else if(data==3){
           alert("Email của bạn chưa được xác nhận!");
          window.location.reload();
    }   
        },error:function(data){
          // alert("Lỗi đăng nhập");
          // window.location.reload();
          }
    });
 } 
 });

  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='password'],input[type='email'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});
  </script>
@endsection