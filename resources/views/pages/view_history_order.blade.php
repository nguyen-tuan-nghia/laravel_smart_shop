@extends('layout')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/feedback.css')}}">
<div class="container">
  @foreach($shipping_detail1 as $key2 =>$val2)
        <div class="card mb-3">
          <div class="card-body">
            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
              <div class="step completed">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-cart"></i></div>
                </div>
                <h4 class="step-title">Đặt hàng</h4>
              </div>
              <div class="step {{$val2->order_status==2||$val2->order_status==4?'completed':''}} ">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-config"></i></div>
                </div>
                <h4 class="step-title">Đang xử lý</h4>
              </div>
              <div class="step {{$val2->order_status==2||$val2->order_status==4?'completed':''}} ">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-car"></i></div>
                </div>
                <h4 class="step-title">Đang giao hàng</h4>
              </div>
              <div class="step {{$val2->order_status==4?'completed':''}} ">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-home"></i></div>
                </div>
                <h4 class="step-title">Nhận hàng</h4>
              </div>
            </div>
          </div>
        </div>
@endforeach
</div>
<div class="container">
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người nhận
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">

      </div>
    </div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Tên Khách hàng</th>
            
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>ghi chú</th>
            <th>Hình thức thanh toán</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($shipping as $key => $val)

          <tr>
            <td>{{($val->shipping_name)}}</td>
            <td>{{($val->shipping_phone)}}</td>
            <td>{{($val->shipping_address)}}</td>
            
            <td>{{($val->shipping_notes)}}</td>
            <td>{{($val->shipping_method)}}</td>
        @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
<br>
		<div class="table-agile-info">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
{{--             <th></th>
 --}}            <th>Tên sản phẩm</th>
            <th>ảnh</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total=0;
           ?>
          @foreach($order_detail as $key => $val)
          <tr class="color_qty_{{$val->product_id}}">
            <td><a href="{{URL::to('/chi-tiet-san-pham/'.$val->product_slug)}}">
            {{$val->product_name}}
            @if($val->attribute_id)
            <p>Màu: {{$val->product_color}}</p>
            <p>Dung lượng: {{$val->product_size}}</p></a></td>
            @endif
            <td><img style="width: 100px" alt="" src="{{asset('public/upload/product/'.$val->product_image)}}" /></td>
            <form>
              @csrf
            <td><input disabled class="product_sales_quantity_{{$val->product_id}}" type="number" min="1" name="product_sales_quantity" value="{{($val->product_sales_quantity)}}" min="{{($val->quantity)}}">
              @foreach($shipping_detail1 as $key2 =>$val2)
              @if($val2->order_status==4)
              <input type="hidden" id="order_id_feedback" value="{{$val2->order_id}}">
              <p></p>
              @if($feedback->count()>0)
              @foreach($feedback as $key => $val3)
              @if($val3->product_id==$val->product_id&&$val3->customer_id==session::get('customer_id'))
              @else
                <button id="nhan_xet{{$val->product_id}}" type="button" onclick="fetchback({{$val->product_id}})" class="btn btn-primary" data-toggle="modal" data-target="#Modal">Để lại nhận xét</button>
              @endif
              @endforeach
              @else
                <button id="nhan_xet{{$val->product_id}}" type="button" onclick="fetchback({{$val->product_id}})" class="btn btn-primary" data-toggle="modal" data-target="#Modal">Để lại nhận xét</button>
              @endif
              <button style="margin-top: 17px;background: white;color: #00BBFFFF;border: 1px solid #00BBFFFF" type="button" class="btn btn-primary"><a href="{{URL::to('/chi-tiet-san-pham/'.$val->product_slug)}}">Mua lại</a></button>
                @endif
              @endforeach
              <input type="hidden" class="order_product_id" name="order_product_id" value="{{$val->product_id}}">
            </td>
          </form>
      <td><span class="text-ellipsis">{{number_format($val->product_price,0,',','.').'VNĐ'}}</span></td>
       <td><span class="text-ellipsis">{{number_format($val->product_sales_quantity*$val->product_price,0,',','.').'VNĐ'}}</span></td>
          </tr>
          <?php
          $sobtotal=$val->product_sales_quantity*$val->product_price;
          $total+=$sobtotal;
          
          $coupon_text=$val->coupon_text;

          $order_fee=$val->product_feeship;
          ?>
        @endforeach
        </tbody>
      </table>
    </div>
 <p><label>Tổng: {{number_format($total,0,',','.').' VNĐ'}}</label></p>
  <p><label>phí vận chuyển: {{number_format($order_fee,0,',','.').' VNĐ'}}</label></p>
  @if($coupon_text ==null)        
    <p><label>giảm giá: không có</label></p>
    @if($shipp=='Paypal'||$shipp=='VNPAY'||$shipp=='MoMo')
    <p><label>Tổng tiền thanh toám: 0 VNĐ</label></p>
    @else
    <p><label>Tổng tiền thanh toám: {{number_format($total+$order_fee,0,',','.').' VNĐ'}}</label></p>
    @endif
  @else

    @if($coupon_condition==1)
      <?php
      $coupon_after=($total*$coupon_number)/100;
      ?>
      <p><label>giảm giá: {{$coupon_number}} %</label></p>
    @if($shipp=='Paypal'||$shipp=='VNPAY'||$shipp=='MoMo')
    <p><label>Tổng tiền thanh toám: 0 VNĐ</label></p>
    @else
      <p><label>Tổng tiền thanh toám: {{number_format($total+$order_fee-$coupon_after,0,',','.').' VNĐ'}}</label></p>
      @endif
      <input type="hidden" class="tong-tien" value="{{$total+$order_fee-$coupon_after}}">

    @else
      <?php
      $coupon_after=$total-$coupon_number;
      ?>
      <p><label>giảm giá: {{number_format($coupon_number,0,',','.')}} VMĐ</label></p>
    @if($shipp=='Paypal'||$shipp=='VNPAY'||$shipp=='MoMo')
    <p><label>Tổng tiền thanh toám: 0 VNĐ</label></p>
    @else
      <p><label>Tổng tiền thanh toám: {{number_format($coupon_after+$order_fee,0,',','.').' VNĐ'}}</label></p>
      @endif
      <input type="hidden" class="tong-tien" value="{{$coupon_after+$order_fee}}">
    @endif
  @endif

  <br>  @foreach($shipping_detail1 as $key =>$val)
@if($val->order_status==1)
  <a onClick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')" style="color: red;float: right;margin-bottom: 200px" href="{{url('/huy-order/'.$val->order_id)}}">Hủy đơn hàng</a>
  @endif
@endforeach
</div>
</div>

<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <label id="product_name"></label>
          <center>
            <input type="hidden" name="" id="product_id" value="">
          <div class="stars">
                <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                <label class="star star-5" for="star-5"></label>
                <input class="star star-4" id="star-4" type="radio" name="star" value="4" />
                <label class="star star-4" for="star-4"></label>
                <input class="star star-3" id="star-3" type="radio" name="star" value="3" />
                <label class="star star-3" for="star-3"></label>
                <input class="star star-2" id="star-2" type="radio" name="star" value="2" />
                <label class="star star-2" for="star-2"></label>
                <input class="star star-1" id="star-1" type="radio" name="star" value="1" />
                <label class="star star-1" for="star-1"></label>
            </div>
          </center>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Ghi nhận xét của bạn :</label>
            <textarea class="form-control" rows="5" id="message_text"></textarea>
        <output id="Filelist"></output>

          </div>
      </form>
      </div>
      <div class="modal-footer">
        <span class="btn btn-light fileinput-button">
            <span><img style="width: 20px" src="https://salt.tikicdn.com/ts/upload/1b/7a/3b/d8ff2d5d709c730e12e11ba0b70a1285.jpg"> Thêm ảnh</span>
            <input type="file" name="files[]" id="files" multiple accept="image/jpeg, image/png, image/gif,"><br />
        </span>
                <button style="margin-top:0px;width: 75%" id="save_feedback" type="button" class="btn btn-primary">Gửi nhận xét</button>
{{--         <button type="button"  class="btn btn-secondary" data-dismiss="modal">Thoát</button>
 --}}      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function fetchback(id){
    $.get("{{url('feedback-model')}}/"+id,function(data){
      $('#product_name').text(data.product_name);
      $('#product_id').val(data.product_id);
    })
  }
</script>
<script type="text/javascript">
  $('#save_feedback').click(function(){
    var star=$('.star:checked').val();
    if(typeof star=="undefined"){
      star=0;
    }
    var mess=$('#message_text').val();
    // var _token=$('input[name="_token"]').val();
    var order_id_feedback=$('#order_id_feedback').val();
    var id=$('#product_id').val();
    var form_data = new FormData();
    var totalfiles = document.getElementById('files').files.length;
    for (var index = 0; index < totalfiles; index++) {
      form_data.append("files[]", document.getElementById('files').files[index]);
   }
   form_data.append('star',star);
   form_data.append('mess',mess);
   form_data.append('id',id);
   form_data.append('order_id_feedback',order_id_feedback);
    $.ajax({
      url:"{{url('/save-feedback')}}",
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
          $('#Modal').modal('hide');
          $('#nhan_xet'+id).remove();
    },
    error:function(data){
      alert("error 500");
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
