@extends('layout')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/feedback.css')}}">
@php
										$id=Session::get('customer_id');
										$address=Session::get('address');
										$phone=Session::get('phone');
										$name=Session::get('customer_name');
										$email=Session::get('email');
									@endphp
<style type="text/css">
* {box-sizing: border-box}

/* Style the tab */
.tab {
  float: left;
  background-color: #FFFFFF;
  width: 20%;
/*  height: 300px;
*/}
/* Style the buttons that are used to open the tab content */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #80808080;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #CCC;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  width: 70%;
  border-left: none;
}
/*.upload-icon{
  width: 120px;
  height: 120px;
  border: 2px solid #5642BE;
  border-style: dotted;
  border-radius: 50%;
}
.upload-icon img{
  width: 120px;
  height: 120px;
  border-radius: 50%;
}*/
.customer-img
{
    display: none;
}

#profileImage
{
    cursor: pointer;
}

#profile-container {
    width: 150px;
    height: 150px;
    overflow: hidden;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
}

#profile-container img {
    width: 150px;
    height: 150px;
}
</style>
<div  style="margin: 45px;">
<div class="tab">
  <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'taikhoan')"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg>  Tài khoản</button>
        <button class="tablinks" onclick="openCity(event, 'giamgia')"><img class="icon" src="https://frontend.tikicdn.com/_desktop-next/static/img/mycoupon/coupon_code.svg"> Mã giảm giá</button>
        <button class="tablinks" onclick="openCity(event, 'nhanxet')"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4V6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"></path></svg> Nhận xét của bạn</button>

</div>

<div id="taikhoan" class="tabcontent">
	<br/>
      <form >
        @csrf
          <center>
            <div class="img" id="load_customer_img">
{{--         <div class="image-upload">
         <label for="file-input">
           <div class="upload-icon"> --}}
          <div id="profile-container">
            @if($customer->customer_img!==null)
            <img id="profileImage" src="{{asset('public/upload/avata/'.$customer->customer_img)}}">
            <input style="background:white" class="customer-img" type="file" name="file" id="file-{{$customer->customer_id}}" accept="image/*" data-customer_id="{{$customer->customer_id}}" capture>
          </div>
            @else
            <img id="profileImage" src="{{asset('public/frontend/images/avatardefault_92824.png')}}">
            <input style="background:white" class="customer-img" type="file" name="file" id="file-{{$customer->customer_id}}" accept="image/*" data-customer_id="{{$customer->customer_id}}" capture>
            @endif
          </div>
        </p><input style="background:white" type="button" class="delete-img" data-customer_id="{{$customer->customer_id}}" value="Để về mặc định"></p>
</center>
          <div id="delete_img"></div>
        	<div class="form-group">
          <label>Tên khách hàng:</label>
          <input class="form-control customer_name" type="text" name="customer_name" value=" <?php echo $name ?>">
      </div>
        	<div class="form-group">
          <p><label>Email:</label></p>
			<input class="form-control customer_email" type="text" disabled name="customer_email" value="<?php echo $email ?>">
		</div>
        	<div class="form-group">
          <p><label>Số điện thoại:</label></p>
          <input class="form-control customer_phone" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="customer_phone" value="<?php echo $phone ?>">
      </div>
        	<div class="form-group">
          <p><label>Địa chỉ:</label></p>
          <input class="form-control customer_address" type="text" name="customer_address" value="<?php echo $address ?>">
      </div>
		<button type="button" data-customer_id="<?php echo $id ?>" class="btn btn-default edit_customer_checkout">Xác nhận</button>
    </form>
<br/>
    <div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Đổi mật khẩu</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <form>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Đổi mật khẩu</h4>
        </div>
        <div id="sai_mk_old"></div>
        <div class="modal-body">
          <label>Mật khẩu cũ</label>
          <input class="form-control password-old-<?php echo $id ?>" type="password" name="password-old" value="">
        </div>
        <div class="modal-body">
          <label>Mật khẩu mới</label>
          <input class="form-control password-new-<?php echo $id ?>" type="password" name="password" value="">
        </div>
        <div class="form-group">
        <button class="btn btn-info btn-lg xac-nhan-mk" style="margin-left: 20px" type="button" data-customer_id="<?php echo $id ?>" >Xác nhận</button>
      </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  
</div>
</div>
<div id="giamgia" class="tabcontent" style="min-height: 400px;">
   <div class="container">
    @if($coupon->count()<=0)
      <center><h2>Hiện không có chương trình giảm giá</h2></center>
    @else
    @foreach($coupon as $key => $cate_pro)
      <div class="cardd">
        <div class="main">
          <div class="co-img">
            <img
              src="{{asset('public/upload/logo/'.$web->web_logo)}}"
              alt=""
            />
          </div>
          <div class="content">
            <h2>{{($cate_pro->coupon_name)}}</h2>
            <h1>
              @if($cate_pro->coupon_condition==1)
                {{($cate_pro->coupon_number).'%'}}
              @else
                {{number_format($cate_pro->coupon_number,0,',','.').'vnđ'}}
              @endif
              <span>Coupon</span></h1>
            <p>Khuyễn mãi đến ngày: <span style="color:red;">{{($cate_pro->coupon_date_end)}}</span></p>
          </div>
        </div>
        <div class="copy-button">
          <input id="copyvalue_{{$cate_pro->coupon_id}}" type="text" readonly value="{{($cate_pro->coupon_code)}}" />
          <button onclick="copyIt({{$cate_pro->coupon_id}})" class="copybtn_{{$cate_pro->coupon_id}}">COPY</button>
        </div>
      </div>
      @endforeach
      @endif
    </div>
</div>
<div id="nhanxet" class="tabcontent" style="min-height: 400px;">
   <div id="fetch_feedback_edit" class="container" style="margin-left: 30px">
      @include('pages.fetch.fetch_feedback_edit')
    </div>
</div>
</div>
<div class="modal fade" id="edit_feedback_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nhận xét</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data">
          @csrf
          <center>
            <input type="hidden" name="" id="edit_feedback_id" value="">
          <div class="stars">
                <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                <label class="star star-5" for="star-5"></label>
                <input class="star star-4" id="star-4" type="radio" name="star" value="4" />
                <label class="star star-4" for="star-4"></label>
                <input class="star star-3" id="star-3" type="radio" name="star" value="3" />
                <label class="star star-3" for="star-3"></label>
                <input class="star star-2" id="star-2" type="radio" name="star" value="2" />
                <label class="star star-2" for="star-2"></label>
                <input  class="star star-1" id="star-1" type="radio" name="star" value="1" />
                <label class="star star-1" for="star-1"></label>
            </div>
          </center>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Ghi nhận xét của bạn :</label>
            <textarea class="form-control" rows="5" id="message_text"></textarea>
        <output id="Filelist"></output>
        <output id="Filelist_feedback_img">
          @include('pages.fetch.edit_feedback_img')
        </output>
          </div>
      </form>
      </div>
      <div class="modal-footer">
        <span class="btn btn-light fileinput-button">
            <span><img style="width: 20px" src="https://salt.tikicdn.com/ts/upload/1b/7a/3b/d8ff2d5d709c730e12e11ba0b70a1285.jpg"> Thêm ảnh</span>
            <input type="file" name="files[]" id="files" multiple accept="image/jpeg, image/png, image/gif,"><br />
        </span>
                <button style="margin-top:0px;width: 75%" id="edit_feedback" type="button" class="btn btn-primary">Gửi nhận xét</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    function fetch_feedback_edit(){
    $.ajax({
      url:"{{url('/fetch-feedback-edit')}}",
      method:"get",
      success:function(data){
        $('#fetch_feedback_edit').html(data);
      },
      error:function(data){
      alert("error 500");
      }
    });
  }
</script>
<script type="text/javascript">
  $('#edit_feedback').click(function(){
    var star=$('.star:checked').val();
    if(typeof star=="undefined"){
      star=0;
    }
    var mess=$('#message_text').val();
    // var _token=$('input[name="_token"]').val();
    var id=$('#edit_feedback_id').val();
    var form_data = new FormData();
    var totalfiles = document.getElementById('files').files.length;
    for (var index = 0; index < totalfiles; index++) {
      form_data.append("files[]", document.getElementById('files').files[index]);
   }
   form_data.append('star',star);
   form_data.append('mess',mess);
   form_data.append('id',id);
    $.ajax({
      url:"{{url('/edit-feedback')}}",
      method:"POST",
      headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data:form_data,
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
          Swal.fire({
                position: "",
                icon: "success",
                title: "Cảm ơn bạn đã đánh giá",
                showConfirmButton: false,
                timer: 1500
            });
          $('#edit_feedback_modal').modal('hide');
          fetch_feedback_edit();
    },
    error:function(data){
      alert("error 500");
    }
    });
  });
</script>
<script type="text/javascript">
  function edit_feeedback_modal(id){
    $.get("{{url('/fetch-feedback-edit-modal')}}/"+id,function(data){
      for(var i=1;i<6;i++){
        if(data.number==i){
        $('#star-'+i).prop('checked', true);
      }
      }
      $('#message_text').text(data.message);
      $('#edit_feedback_id').val(data.feedback_id);
      $('#edit_feedback_modal').modal('show');
    })
    $.get("{{url('/fetch-feedbackimg-edit-modal')}}/"+id,function(data){
      $('#Filelist_feedback_img').html(data)
    })
}
</script>
<script type="text/javascript">
  $("#profileImage").click(function(e) {
    $(".customer-img").click();
});

function fasterPreview( uploader ) {
    if ( uploader.files && uploader.files[0] ){
          $('#profileImage').attr('src', 
             window.URL.createObjectURL(uploader.files[0]) );
    }
}

$(".customer-img").change(function(){
    fasterPreview( this );
});
</script>
<script type="text/javascript">
function copyIt(id){
  let copyInput = document.querySelector('#copyvalue_'+id);
  copyInput.select();
  $('.copybtn_'+id).text("COPIED");
}
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
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<script>
function openCityy(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontentt");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinkss");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>										
<script type="text/javascript">
    $('.customer-img').on('change',function(){
        var id=$(this).data('customer_id');
        var image = document.getElementById("file-"+id).files[0];
            var form_data = new FormData();
            form_data.append("file", document.getElementById("file-"+id).files[0]);
            form_data.append("id",id);
                $.ajax({
                    url:"{{url('/update-avata')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
                        }
                });
    });
</script>
<script type="text/javascript">
        $('.delete-img').on('click',function(){
        var id=$(this).data('customer_id');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/delete-img')}}",
            method:"POST",
            data:{id:id,_token:_token},
            success:function(respone){
                if(respone==1){
                     $("#profileImage").attr("src","{{asset('public/frontend/images/avatardefault_92824.png')}}");
                    $('#delete_img').html('<center><span class="text text-success">Để ảnh mạc định thành công</span></center>').fadeOut(300);
                }
                else if (respone==2) {
                    $('#delete_img').html('<center><span class="text text-danger">Đã để ảnh mặc định</span></center>').fadeOut(300);
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $('.xac-nhan-mk').click(function(){
        var id=$(this).data('customer_id');
        var password_old=$('.password-old-'+id).val();
        var password_new=$('.password-new-'+id).val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('doi-mat-khau-kh')}}",
            method:"POST",
            data:{id:id,password_new:password_new,password_old:password_old,_token:_token},
            success:function(respone){
                if(respone==1){
                    $('#sai_mk_old').html('<center><span class="text text-danger">Bạn không nhập đúng mật khẩu</span></center>');
                }
                else if (respone==2) {
                    $('#sai_mk_old').html('<center><span class="text text-success">Đổi mật khẩu thành công</span></center>');

                }
            }
        });
    });
</script>
<script type="text/javascript">
  //I added event handler for the file upload control to access the files properties.
document.addEventListener("DOMContentLoaded", init, false);

//To save an array of attachments
var AttachmentArray = [];

//counter for attachment array
var arrCounter = 0;

//to make sure the error message for number of files will be shown only one time.
var filesCounterAlertStatus = false;

//un ordered list to keep attachments thumbnails
var ul = document.createElement("ul");
ul.className = "thumb-Images";
ul.id = "imgList";

function init() {
  //add javascript handlers for the file upload event
  document
    .querySelector("#files")
    .addEventListener("change", handleFileSelect, false);
}

//the handler for file upload event
function handleFileSelect(e) {
  //to make sure the user select file/files
  if (!e.target.files) return;

  //To obtaine a File reference
  var files = e.target.files;

  // Loop through the FileList and then to render image files as thumbnails.
  for (var i = 0, f; (f = files[i]); i++) {
    //instantiate a FileReader object to read its contents into memory
    var fileReader = new FileReader();

    // Closure to capture the file information and apply validation.
    fileReader.onload = (function(readerEvt) {
      return function(e) {
        //Apply the validation rules for attachments upload
        ApplyFileValidationRules(readerEvt);

        //Render attachments thumbnails.
        RenderThumbnail(e, readerEvt);

        //Fill the array of attachment
        FillAttachmentArray(e, readerEvt);
      };
    })(f);

    // Read in the image file as a data URL.
    // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
    // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
    fileReader.readAsDataURL(f);
  }
  document
    .getElementById("files")
    .addEventListener("change", handleFileSelect, false);
}

//To remove attachment once user click on x button
jQuery(function($) {
  $("div").on("click", ".img-wrap .close", function() {
    var id = $(this)
      .closest(".img-wrap")
      .find("img")
      .data("id");

    //to remove the deleted item from array
    var elementPos = AttachmentArray.map(function(x) {
      return x.FileName;
    }).indexOf(id);
    if (elementPos !== -1) {
      AttachmentArray.splice(elementPos, 1);
    }

    //to remove image tag
    $(this)
      .parent()
      .find("img")
      .not()
      .remove();

    //to remove div tag that contain the image
    $(this)
      .parent()
      .find("div")
      .not()
      .remove();

    //to remove div tag that contain caption name
    $(this)
      .parent()
      .parent()
      .find("div")
      .not()
      .remove();

    //to remove li tag
    var lis = document.querySelectorAll("#imgList li");
    for (var i = 0; (li = lis[i]); i++) {
      if (li.innerHTML == "") {
        li.parentNode.removeChild(li);
      }
    }
  });
});

//Apply the validation rules for attachments upload
function ApplyFileValidationRules(readerEvt) {
  //To check file type according to upload conditions
  if (CheckFileType(readerEvt.type) == false) {
    alert(
      "The file (" +
        readerEvt.name +
        ") does not match the upload conditions, You can only upload jpg/png/gif files"
    );
    e.preventDefault();
    return;
  }

  //To check file Size according to upload conditions
  if (CheckFileSize(readerEvt.size) == false) {
    alert(
      "The file (" +
        readerEvt.name +
        ") does not match the upload conditions, The maximum file size for uploads should not exceed 300 KB"
    );
    e.preventDefault();
    return;
  }

  //To check files count according to upload conditions
  if (CheckFilesCount(AttachmentArray) == false) {
    if (!filesCounterAlertStatus) {
      filesCounterAlertStatus = true;
      alert(
        "You have added more than 10 files. According to upload conditions you can upload 10 files maximum"
      );
    }
    e.preventDefault();
    return;
  }
}

//To check file type according to upload conditions
function CheckFileType(fileType) {
  if (fileType == "image/jpeg") {
    return true;
  } else if (fileType == "image/png") {
    return true;
  } else if (fileType == "image/gif") {
    return true;
  } else {
    return false;
  }
  return true;
}

//To check file Size according to upload conditions
function CheckFileSize(fileSize) {
  if (fileSize < 300000) {
    return true;
  } else {
    return false;
  }
  return true;
}

//To check files count according to upload conditions
function CheckFilesCount(AttachmentArray) {
  //Since AttachmentArray.length return the next available index in the array,
  //I have used the loop to get the real length
  var len = 0;
  for (var i = 0; i < AttachmentArray.length; i++) {
    if (AttachmentArray[i] !== undefined) {
      len++;
    }
  }
  //To check the length does not exceed 10 files maximum
  if (len > 9) {
    return false;
  } else {
    return true;
  }
}

//Render attachments thumbnails.
function RenderThumbnail(e, readerEvt) {
  var li = document.createElement("li");
  ul.appendChild(li);
  li.innerHTML = [
    '<div class="img-wrap"> <span class="close">&times;</span>' +
      '<img class="thumb" src="',
    e.target.result,
    '" title="',
    escape(readerEvt.name),
    '" data-id="',
    readerEvt.name,
    '"/>' + "</div>"
  ].join("");

  var div = document.createElement("div");
  div.className = "FileNameCaptionStyle";
  // li.appendChild(div);
  div.innerHTML = [readerEvt.name].join("");
  document.getElementById("Filelist").insertBefore(ul, null);
}

//Fill the array of attachment
function FillAttachmentArray(e, readerEvt) {
  AttachmentArray[arrCounter] = {
    AttachmentType: 1,
    ObjectType: 1,
    FileName: readerEvt.name,
    FileDescription: "Attachment",
    NoteText: "",
    MimeType: readerEvt.type,
    Content: e.target.result.split("base64,")[1],
    FileSizeInBytes: readerEvt.size
  };
  arrCounter = arrCounter + 1;
}
</script>
@endsection
