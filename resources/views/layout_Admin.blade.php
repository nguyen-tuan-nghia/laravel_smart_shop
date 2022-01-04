<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
{{-- <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
 --}}<!-- font CSS -->
<meta name="csrf-token" content="{{csrf_token()}}">

<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
{{-- <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
 --}}<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
{{-- <link rel="stylesheet" href="{{asset('public/backend/"css/morris.css')}}" type="text/css"/>
 --}}<!-- calendar -->

{{-- <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
 --}}<link rel="stylesheet" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">


<link rel="stylesheet" href="{{asset('public/backend/css/code.jquery.com.ui.1.12.1.themes.base.jquery-ui.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/css/morris.js.0.5.1.morris.css')}}">

<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
{{-- <script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script> --}}
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        admin 
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>

    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="username">
                    <?php
                    $admin_name=Session::get('admin_name');
                    if($admin_name){
                        echo"$admin_name";
                    }
                    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="{{URL::to('/change-pass')}}"><i class="fa fa-cog"></i>Đổi mật khẩu</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{url('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Thống kê</span>
                    </a>
                </li>
                 @hasany_role(['admin','reply'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Web</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/web-detail')}}">Thông tin trang web</a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm </a></li>
                        <li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bình luận</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/comment')}}">Liệt kê bình luận</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Nhận xét</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/list-feedback')}}">Liệt kê nhận xét</a></li>
                    </ul>
                </li>
                @endhasany_role

                 @hasany_role(['admin','author'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục bài viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-category-post')}}">Thêm danh mục bài viết </a></li>
                        <li><a href="{{URL::to('/all-category-post')}}">Liệt kê danh mục bài viết</a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-post')}}">Thêm bài viết </a></li>
                        <li><a href="{{URL::to('/all-post')}}">Liệt kê bài viết</a></li>
                    </ul>
                 </li>
                @endhasany_role

                 @has_role('admin')
            <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-order')}}">Danh sách đơn hàng </a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm </a></li>
                        <li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
                    </ul>
                 </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>danh mục thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-brand')}}">Thêm thương hiệu sản phẩm </a></li>
                        <li><a href="{{URL::to('/all-brand')}}">Liệt kê thương hiệu sản phẩm</a></li>
                    </ul>
                 </li>                           
              <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>User</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/user-regis-admin')}}">Thêm người dùng</a></li>
                        <li><a href="{{URL::to('/user')}}">Quản lý người dùng</a></li>
                        <li><a href="{{URL::to('/customer-manager')}}">Quản lý khách hàng</a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Vận chuyển</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a></li>
                    </ul>
                 </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-slider')}}">Thêm slider</a></li>
                        <li><a href="{{URL::to('/all-slider')}}">Liệt kê slider</a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-coupon')}}">Thêm mã giảm giá </a></li>
                        <li><a href="{{URL::to('/all-coupon')}}">Liệt kê mã giảm giá</a></li>
                    </ul>
                 </li>

                 @endhas_role
    </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
            <div class="container">
      @if(session()->has('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger">
                {{Session()->get('error')}}
            </div>
            @endif
    </div>
        @yield("admin_content")



<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>

<script src="{{asset('public/backend/js/code.jquery.com.ui.1.12.1.jquery-ui.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js.0.5.1.morris.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael.2.1.0.raphael.min.js')}}"></script>

<script src="{{asset('public/backend/js/simple.money.format.js')}}"></script>
<script type="text/javascript">
// $(document).ready(function(){

  charts_product();

        var chart_product = new Morris.Bar({
             
              element: 'chart_product',
              //option chart
              lineColors: ['#819C79','#FC0206FF'],
                parseTime: false,
                hideHover: 'auto',
                xkey: 'period',
                ykeys: ['product_sold'],
                labels: ['lượng bán']
            });

          function charts_product(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/chart-product')}}",
                method:"POST",
                dataType:"JSON",
                data:{_token:_token},
                success:function(data)
                    {
                      chart_product.setData(data);
                    }   
            });
          }
      //})
</script>
<script type="text/javascript">
   
  $( function() {
    $( "#coupon_date_1" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
        duration: "slow"
    });
    $( "#coupon_date_2" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
        duration: "slow"
    });
  } );
 
</script>
<script type="text/javascript">
    $('.xac-nhan-mk').click(function(){
        var id=$(this).data('admin_id');
        var password_old=$('.password-old-'+id).val();
        var password_new=$('.password-new-'+id).val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/edit-pass')}}",
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
    $('.price_format').simpleMoneyFormat();
</script>
<script type="text/javascript">
    $(document).ready(function(){
   $(document).on('keypress','.price_format',function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errmsg").html("Number Only").stop().show().fadeOut("slow");
      return false;
    }
   });
});
</script>
<script type="text/javascript">
   
  $( function() {
    $( "#datepicker" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
        duration: "slow"
    });
    $( "#datepicker2" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
        duration: "slow"
    });
  } );
 
</script>
<script type="text/javascript">
      
        //     });
        var donut = Morris.Donut({
          element: 'donut',
          resize: true,
          colors: [
            '#FF328E',
            '#61D2CE',
            '#CCFF00',
            // '#f5b942',
            '#4842f5'
            
          ],
          //labelColor:"#cccccc", // text color
          //backgroundColor: '#333333', // border color
          data: [
            {label:"San pham", value:<?php echo $app_product ?>},
            {label:"Bai viet", value:<?php echo $app_post ?>},
            {label:"Don hang", value:<?php echo $app_order ?>},
            {label:"Khach hang", value:<?php echo $app_customer ?>} 
          ]
        });
     
</script>
<script type="text/javascript">
// $(document).ready(function(){
        chart60daysorder();
        var chart = new Morris.Bar({
              element: 'chart',
              //option chart
              lineColors: ['#819C79', '#fc8710','#FF6541', '#A4ADD3', '#766B56'],
                parseTime: false,
                hideHover: 'auto',
                xkey: 'period',
                ykeys: ['order','sales','profit','quantity'],
                labels: ['đơn hàng','doanh số','lợi nhuận','số lượng']
            });
        function chart60daysorder(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/days-order')}}",
                method:"POST",
                dataType:"JSON",
                data:{_token:_token},
                
                success:function(data)
                    {
                        chart.setData(data);

                    }   
            });
            $.ajax({
                url:"{{url('/sum')}}",
                method:"POST",
                data:{_token:_token},
                
                success:function(data)
                    {
                        $('#sum').html(data);
                    }   
            });
        }

    $('.dashboard-filter').change(function(){
        var dashboard_value = $(this).val();
        var _token = $('input[name="_token"]').val();
        // alert(dashboard_value);
        $.ajax({
            url:"{{url('/dashboard-filter')}}",
            method:"POST",
            dataType:"JSON",
            data:{dashboard_value:dashboard_value,_token:_token},
            
            success:function(data)
                {
                    chart.setData(data);
                }   
            });
        $.ajax({
                url:"{{url('/sum-dashboard-filter')}}",
                method:"POST",
            data:{dashboard_value:dashboard_value,_token:_token},
                
                success:function(data)
                    {
                        $('#sum').html(data);
                    }   
            });

    });

    $('#btn-dashboard-filter').click(function(){
        var _token = $('input[name="_token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
         $.ajax({
            url:"{{url('/filter-by-date')}}",
            method:"POST",
            dataType:"JSON",
            data:{from_date:from_date,to_date:to_date,_token:_token},
            success:function(data)
                {
                    chart.setData(data);
                }   
        });
        $.ajax({
                url:"{{url('/sum-filter-by-date')}}",
                method:"POST",
            data:{from_date:from_date,to_date:to_date,_token:_token},
                
                success:function(data)
                    {
                        $('#sum').html(data);
                    }   
            });
    });

// });
    
</script>
<script type="text/javascript">
    $('.comment_duyet_btn').click(function(){
        var comment_status = $(this).data('comment_status');

        var comment_id = $(this).data('comment_id');
        var comment_product_id = $(this).attr('id');
        if(comment_status==0){
            var alert = 'Thay đổi thành duyệt thành công';
        }else{
            var alert = 'Thay đổi thành không duyệt thành công';
        }
          $.ajax({
                url:"{{url('/allow-comment')}}",
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id},
                success:function(data){
                    location.reload();
                   $('#notify_comment').html('<span class="text text-alert">'+alert+'</span>');

                }
            });


    });
    $('.btn-reply-comment').click(function(){
        var comment_id = $(this).data('comment_id');
        var comment = $('.reply_comment_'+comment_id).val();
        var comment_product_id = $(this).data('product_id');
        // alert(comment);
        // alert(comment_id);
        // alert(comment_product_id);
          $.ajax({
                url:"{{url('/reply-comment')}}",
                method:"POST",

                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment:comment,comment_id:comment_id,comment_product_id:comment_product_id},
                success:function(data){
                    $('.reply_comment_'+comment_id).val('');
                   $('#notify_comment').html('<span class="text text-alert">Trả lời bình luận thành công</span>');
                    location.reload();

                }
            });


    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        load_gallery();

        function load_gallery(){
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);
            $.ajax({
                url:"{{url('/select-gallery')}}",
                method:"POST",
                data:{pro_id:pro_id,_token:_token},
                success:function(data){
                    $('#gallery_load').html(data);
                }
            });
        }

        $('#file').change(function(){
            var error = '';
            var files = $('#file')[0].files;

            if(files.length>5){
                error+='<p>Bạn chọn tối đa chỉ được 5 ảnh</p>';
            }else if(files.length==''){
                error+='<p>Bạn không được bỏ trống ảnh</p>';
            }else if(files.size > 2000000){
                error+='<p>File ảnh không được lớn hơn 2MB</p>';
            }

            if(error==''){

            }else{
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                return false;
            }

        });

        $(document).on('blur','.edit_gal_name',function(){
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/update-gallery-name')}}",
                method:"POST",
                data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
                }
            });
        });

        $(document).on('click','.delete-gallery',function(){
            var gal_id = $(this).data('gal_id');
            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn muốn xóa hình ảnh này không?')){
                $.ajax({
                    url:"{{url('/delete-gallery')}}",
                    method:"POST",
                    data:{gal_id:gal_id,_token:_token},
                    success:function(data){
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                    }
                });
            }
        });

        $(document).on('change','.file_image',function(){

            var gal_id = $(this).data('gal_id');
            var image = document.getElementById("file-"+gal_id).files[0];
            var form_data = new FormData();

            form_data.append("file", document.getElementById("file-"+gal_id).files[0]);
            form_data.append("gal_id",gal_id);
          alert(image);
                $.ajax({
                    url:"{{url('/update-gallery')}}",
                    method:"POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:form_data,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công</span>');
                    }
                });
            
        });



    });
</script>
<script type="text/javascript">
 
    function ChangeToSlug()
        {
            var slug;
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
</script>
<script type="text/javascript">
    CKEDITOR.replace( 'ckeditor1',{
        filebrowserUploadUrl: "{{url('/ckeditor-upload?_token='.csrf_token() )}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace( 'ckeditor2',{
        filebrowserUploadUrl: "{{url('/ckeditor-upload?_token='.csrf_token() )}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
        $('#myTable').DataTable();
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add_delivery').click(function(){
            var city=$('.city').val();
            var province=$('.province').val();
            var wards=$('.wards').val();
            var fee_ship=$('.fee_ship').val();
            var _token=$('input[name="_token"]').val();
             if(fee_ship==''||city==''||province==''||wards==''){
                alert('Bạn chưa nhập đủ thông tin');
            }
            else{
            $.ajax({
                url: '{{url('/insert-delivery')}}',
                method: 'post',
                data: {city:city,province:province,wards:wards,fee_ship:fee_ship,_token:_token},
                success:function(respone){
                    if (respone==1) {
                    alert('thêm thành công');
                    fetch_delivery();
                }
                    else{
                    alert('thêm thất bại');
                    fetch_delivery();
                    }
                    }
            });}
        });
        $(document).on('blur','.feeship_edit',function(){
            var feeship_id=$(this).data('feeship_id');
            var fee_value=$(this).text();
            var _token=$('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/update-delivery')}}',
                method:'post',
                data: {fee_value:fee_value,feeship_id:feeship_id,_token:_token},
                success:function(){
                    alert('cập nhật thành công');
                    fetch_delivery();
                }
            });
        });        
        fetch_delivery();
        function fetch_delivery(){
            var _token=$('input[name="_token"]').val();
            // alert(_token);
                $.ajax({
                    url : '{{url('/select-feeship')}}',
                    method: 'post',
                    data: {_token:_token},
                    success:function(data){
                        $('#load_delivery').html(data);
                    }
        });
        }
        $('.choose').on('change',function(){
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
                    url : '{{url('/select-delivery')}}',
                    method: 'post',
                    data: {action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);

                    }
                });
        });
        $('.update_quantity_order_detail').click(function(){
            var id=$(this).data('order_detail_id');
            var quantity_attr=$('.order_qty_storage_'+id).val();
            var quantity=$('.product_sales_quantity_'+id).val();
            var _token=$('input[name="_token"]').val();
            if ( parseInt(quantity_attr)<parseInt(quantity)) {
                alert('Sô lượng tồn ko đủ');
                location.reload();
            }
            else if (quantity==0) {
                alert('Cập nhật thất bại');
                location.reload();
            }
            else if( parseInt(quantity_attr)>=parseInt(quantity)){
            $.ajax({
                url:'{{url('/update-quantity-order-detail')}}',
                method:'post',
                data:{id:id,quantity:quantity,_token:_token},
                success:function(data){
                    alert('Cập nhật số lượng thành công');
                    location.reload();
                }
            });}
        });
    });
</script>
<script type="text/javascript">
        $('.order_status').change(function(){
            var id =$(this).data('order_id');
            var values=$(this).val();
            var _token=$('input[name="_token"]').val();
            var tong_tien=$('.tong-tien').val();
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        attribute_order = [];
        $("input[name='attribute_order']").each(function(){
            attribute_order.push($(this).val());
        });
        j=0;
        for (i = 0; i < order_product_id.length; i++) {
            var order_qty_storage=$('.order_qty_storage_'+order_product_id[i]).val();
            var order_qty=$('.product_sales_quantity_'+order_product_id[i]).val();
            if (parseInt(order_qty)>parseInt(order_qty_storage)) {
                j=j+1;
                if(j==1){
                    alert('Số lượng tồn không đủ!!!');
                }
                $('.color_qty_'+order_product_id[i]).css('background','red');
            }
        }
        if (j==0) {

            $.ajax({
                url:'{{url('/update-order-status')}}',
                method:'post',
                data:{tong_tien:tong_tien,order_product_id:order_product_id,quantity:quantity,id:id,values:values,_token:_token,attribute_order:attribute_order},
                success:function(data){
                    alert('Cập nhật trạng thái đơn hàng thành công');
                    location.reload();
                }
            });
        }
        });
</script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>

</body>
</html>
