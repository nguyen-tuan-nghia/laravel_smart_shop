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
                <li><a href="{{URL::to('/change-pass')}}"><i class="fa fa-cog"></i>?????i m???t kh???u</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> ????ng xu???t</a></li>
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
                        <span>Th???ng k??</span>
                    </a>
                </li>
                 @hasany_role(['admin','reply'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Web</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/web-detail')}}">Th??ng tin trang web</a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>S???n ph???m</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-product')}}">Th??m s???n ph???m </a></li>
                        <li><a href="{{URL::to('/all-product')}}">Li???t k?? s???n ph???m</a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>B??nh lu???n</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/comment')}}">Li???t k?? b??nh lu???n</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Nh???n x??t</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/list-feedback')}}">Li???t k?? nh???n x??t</a></li>
                    </ul>
                </li>
                @endhasany_role

                 @hasany_role(['admin','author'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh m???c b??i vi???t</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-category-post')}}">Th??m danh m???c b??i vi???t </a></li>
                        <li><a href="{{URL::to('/all-category-post')}}">Li???t k?? danh m???c b??i vi???t</a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>B??i vi???t</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-post')}}">Th??m b??i vi???t </a></li>
                        <li><a href="{{URL::to('/all-post')}}">Li???t k?? b??i vi???t</a></li>
                    </ul>
                 </li>
                @endhasany_role

                 @has_role('admin')
            <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>????n h??ng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-order')}}">Danh s??ch ????n h??ng </a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh m???c s???n ph???m</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-category-product')}}">Th??m danh m???c s???n ph???m </a></li>
                        <li><a href="{{URL::to('/all-category-product')}}">Li???t k?? danh m???c s???n ph???m</a></li>
                    </ul>
                 </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>danh m???c th????ng hi???u s???n ph???m</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-brand')}}">Th??m th????ng hi???u s???n ph???m </a></li>
                        <li><a href="{{URL::to('/all-brand')}}">Li???t k?? th????ng hi???u s???n ph???m</a></li>
                    </ul>
                 </li>                           
              <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>User</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/user-regis-admin')}}">Th??m ng?????i d??ng</a></li>
                        <li><a href="{{URL::to('/user')}}">Qu???n l?? ng?????i d??ng</a></li>
                        <li><a href="{{URL::to('/customer-manager')}}">Qu???n l?? kh??ch h??ng</a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>V???n chuy???n</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/delivery')}}">Qu???n l?? v???n chuy???n</a></li>
                    </ul>
                 </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-slider')}}">Th??m slider</a></li>
                        <li><a href="{{URL::to('/all-slider')}}">Li???t k?? slider</a></li>
                    </ul>
                 </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>M?? gi???m gi??</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-coupon')}}">Th??m m?? gi???m gi?? </a></li>
                        <li><a href="{{URL::to('/all-coupon')}}">Li???t k?? m?? gi???m gi??</a></li>
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
                labels: ['l?????ng b??n']
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
        prevText:"Th??ng tr?????c",
        nextText:"Th??ng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: [ "Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t" ],
        duration: "slow"
    });
    $( "#coupon_date_2" ).datepicker({
        prevText:"Th??ng tr?????c",
        nextText:"Th??ng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: [ "Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t" ],
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
                    $('#sai_mk_old').html('<center><span class="text text-danger">B???n kh??ng nh???p ????ng m???t kh???u</span></center>');
                }
                else if (respone==2) {
                    $('#sai_mk_old').html('<center><span class="text text-success">?????i m???t kh???u th??nh c??ng</span></center>');

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
        prevText:"Th??ng tr?????c",
        nextText:"Th??ng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: [ "Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t" ],
        duration: "slow"
    });
    $( "#datepicker2" ).datepicker({
        prevText:"Th??ng tr?????c",
        nextText:"Th??ng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: [ "Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t" ],
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
                labels: ['????n h??ng','doanh s???','l???i nhu???n','s??? l?????ng']
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
            var alert = 'Thay ?????i th??nh duy???t th??nh c??ng';
        }else{
            var alert = 'Thay ?????i th??nh kh??ng duy???t th??nh c??ng';
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
                   $('#notify_comment').html('<span class="text text-alert">Tr??? l???i b??nh lu???n th??nh c??ng</span>');
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
                error+='<p>B???n ch???n t???i ??a ch??? ???????c 5 ???nh</p>';
            }else if(files.length==''){
                error+='<p>B???n kh??ng ???????c b??? tr???ng ???nh</p>';
            }else if(files.size > 2000000){
                error+='<p>File ???nh kh??ng ???????c l???n h??n 2MB</p>';
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
                    $('#error_gallery').html('<span class="text-danger">C???p nh???t t??n h??nh ???nh th??nh c??ng</span>');
                }
            });
        });

        $(document).on('click','.delete-gallery',function(){
            var gal_id = $(this).data('gal_id');
            var _token = $('input[name="_token"]').val();
            if(confirm('B???n mu???n x??a h??nh ???nh n??y kh??ng?')){
                $.ajax({
                    url:"{{url('/delete-gallery')}}",
                    method:"POST",
                    data:{gal_id:gal_id,_token:_token},
                    success:function(data){
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">X??a h??nh ???nh th??nh c??ng</span>');
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
                        $('#error_gallery').html('<span class="text-danger">C???p nh???t h??nh ???nh th??nh c??ng</span>');
                    }
                });
            
        });



    });
</script>
<script type="text/javascript">
 
    function ChangeToSlug()
        {
            var slug;
            //L???y text t??? th??? input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //?????i k?? t??? c?? d???u th??nh kh??ng d???u
                slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
                slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
                slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
                slug = slug.replace(/??|???|???|???|???/gi, 'y');
                slug = slug.replace(/??/gi, 'd');
                //X??a c??c k?? t??? ?????t bi???t
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
                slug = slug.replace(/ /gi, "-");
                //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
                //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox c?? id ???slug???
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
                alert('B???n ch??a nh???p ????? th??ng tin');
            }
            else{
            $.ajax({
                url: '{{url('/insert-delivery')}}',
                method: 'post',
                data: {city:city,province:province,wards:wards,fee_ship:fee_ship,_token:_token},
                success:function(respone){
                    if (respone==1) {
                    alert('th??m th??nh c??ng');
                    fetch_delivery();
                }
                    else{
                    alert('th??m th???t b???i');
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
                    alert('c???p nh???t th??nh c??ng');
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
                alert('S?? l?????ng t???n ko ?????');
                location.reload();
            }
            else if (quantity==0) {
                alert('C???p nh???t th???t b???i');
                location.reload();
            }
            else if( parseInt(quantity_attr)>=parseInt(quantity)){
            $.ajax({
                url:'{{url('/update-quantity-order-detail')}}',
                method:'post',
                data:{id:id,quantity:quantity,_token:_token},
                success:function(data){
                    alert('C???p nh???t s??? l?????ng th??nh c??ng');
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
                    alert('S??? l?????ng t???n kh??ng ?????!!!');
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
                    alert('C???p nh???t tr???ng th??i ????n h??ng th??nh c??ng');
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
