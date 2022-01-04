<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$meta_desc}}">
    <meta name="robots" content="index,follow">
    <meta name="title" content="{{$meta_title}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="author" content="">
    <link  rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link  rel="icon" type="image/x-icon" href="" />
    
{{--       <meta property="og:image" content="{{$image_og}}" />
 --}}      <meta property="og:site_name" content="nghiashop.com" />
      <meta property="og:description" content="{{$meta_desc}}" />
      <meta property="og:title" content="{{$meta_title}}" />
      <meta property="og:url" content="{{$url_canonical}}" />
      <meta property="og:type" content="website" />
        <meta name="csrf-token" content="{{csrf_token()}}">

    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
{{--     <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
 --}}    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert2.css')}}" rel="stylesheet">
{{-- 
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script> --}}
     <link href="{{asset('public/frontend/css/load.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/load.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head><!--/head-->
<style type="text/css">
    .bottom-left {
  position: absolute;
  bottom: 100px;
  left: 16px;
  border: 2px solid red;
  border-radius: 25px;
  background: red;
  color: white;
}
.bottom-right {
/*   position: absolute;
   bottom: -5px;
    right: 210px;*/
   float: right;
   border: 1px solid red;
   border-radius: 50%;
   background: red;
   color: white;
   text-align: center;
   width:20px ;
}
.logo{
    color: #FF2A00FF;
/*    padding-left: 10px;
*/}
/* style inputs and link buttons */
.btni {
  width: 100%;
  height: 100%;
  padding: 12px;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; /* remove underline from anchors */
}
input:hover,
.btn:hover {
  opacity: 1;
}
/* add appropriate colors to fb, twitter and google buttons */
.fb {
  background-color: #3B5998;
  color: white;
}
.google {
  background-color: #dd4b39;
  color: white;
}
.search-ajax {
    background-color: none;
  color: black; 
}
#dem_so{
 position:absolute;
  left:50%;
  bottom:0%;
  font-size:20px;
  padding:.2em;
  border-radius:50%;
  color: white;
  background:rgba(255,0,0,.85);
  text-align:center;
}

.dropbtn {
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  padding: 10px 10px 10px 10px;
  display: none;
  position: absolute;
  background-color: #FFFFFFFF;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 5px 5px 5px 5px;
  text-decoration: none;
  display: block;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>
<body class="preloading">
    <div id="preload" class="preload-container text-center">
        <span class="glyphicon glyphicon-repeat preload-icon rotating"></span>
    </div>
    <header id="header"><!--header-->
        <div class="container">
        <div class="header-middle"><!--header-middle-->
                <div class="row">
                    <div class="col-sm-3">
                        <div><a style="  text-decoration: none" href="{{URL::to('/')}}"><h2 class="logo">{{$web->web_name}}</h2></a></div>
                    </div>
                    <div class="col-sm-6" &nbsp style="padding-top: 20px">
                        <div class="shop-menu">
                            <ul class="nav navbar-nav">
                                <li>                        
                    <form action="{{URL::to('/search')}}" autocomplete="off" method="post">
                        <div class="search_box" >
                        {{csrf_field()}}
                        <div>
                            <input type="text" name='Search' id="keywords" placeholder="Tìm kiếm"/>
<button style="background-color: #FF2300FF;color: #FFFFFFFF;" type="submit" class="btn btn-solid-primary btn--s btn--inline">
    <svg height="19" viewBox="0 0 19 19" width="19" class="shopee-svg-icon "><g fill="white" stroke="none" stroke-width="1"><g transform="translate(-1016 -32)"><g><g transform="translate(405 21)"><g transform="translate(611 11)"><path d="m8 16c4.418278 0 8-3.581722 8-8s-3.581722-8-8-8-8 3.581722-8 8 3.581722 8 8 8zm0-2c-3.3137085 0-6-2.6862915-6-6s2.6862915-6 6-6 6 2.6862915 6 6-2.6862915 6-6 6z"></path><path d="m12.2972351 13.7114222 4.9799555 4.919354c.3929077.3881263 1.0260608.3842503 1.4141871-.0086574.3881263-.3929076.3842503-1.0260607-.0086574-1.414187l-4.9799554-4.919354c-.3929077-.3881263-1.0260608-.3842503-1.4141871.0086573-.3881263.3929077-.3842503 1.0260608.0086573 1.4141871z"></path></g></g></g></g></g></svg>
</button>
                            <div class="search-ajax" id="search_ajax"></div>
                         </div>
                        </form>
                        </li>
                        </ul></div></div>
    <div class="col-sm-3 shop-menu" >
      <ul class="nav navbar-nav">
      <li class="nav-item dropdown">
        <div class="dropdown">
        <div style="padding-top: 27px;" class="dropbtn" ><i class="fa fa-user"></i>
        @if(!Session::get('customer_name'))
          Tài khoản
          @else
          <?php 
          $customer_name=Session::get('customer_name');
          $count_name_customer=strlen(Session::get('customer_name'));
          if($count_name_customer>14){
            echo substr($customer_name, -14);
          }else{
            echo Session::get('customer_name');
          }
      ?>
          @endif
        </div>
        <div class="dropdown-content">
        @if(!Session::get('customer_name'))
          <a href="#"><button  style="border-style: none; width: 250px; background-color:#FFFFFF;"><a style="color: white; background-color:#FF8A00FF; padding: 7px 0px 7px 0px" href="{{URL::to('/login-checkout')}}" class="btni"><i class="fa fa-user"></i>Đăng nhập</a></button></a></br>
          <a href="#"><button style="border-style: none; width: 250px; background-color:#FFFFFFFF;"><a style="color: white;; padding: 7px 0px 7px 0px" href="{{url('/login-facebook')}}" class="fb btni"><i class="fa fa-facebook fa-fw"></i> Login with Facebook</a></button></a></br>
          <a href="#"><button style="border-style: none; width: 250px; background-color:#FFFFFFFF;"><a style="color: white;; padding: 7px 0px 7px 0px" href="{{url('/login-google')}}" class="google btni"><i class="fa fa-google fa-fw"></i> Login with Google+</a></button></a></br>
        @else
          <a href="#"><a  href="{{URL::to('/avata')}}"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path></svg> <?php echo "Thông tin tài khoản"; ?></a></a></br>
          <a href="#"><a  href="{{URL::to('/history')}}"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M13 12h7v1.5h-7zm0-2.5h7V11h-7zm0 5h7V16h-7zM21 4H3c-1.1 0-2 .9-2 2v13c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 15h-9V6h9v13z"></path></svg> <?php echo "Theo dõi đơn hàng"; ?></a></a></br>
          <div class="dropdown-divider"></div>
          <a href="#"><a  href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></a>
        </div>
        @endif
    </div>
      </li>
      <li  class="dropdown shop-svg-icon"><a href="{{URL::to('/show-cart')}}"><svg style="padding-top: 20px;" width="45" viewBox="0 0 26.6 25.6" class="shopee-svg-icon navbar__link-icon icon-shopping-cart-2"><polyline fill="black" points="2 1.7 5.5 1.7 9.6 18.3 21.2 18.3 24.6 6.1 7 6.1" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2.5"></polyline><circle cx="10.7" cy="23" r="2.2" stroke="none"></circle><circle cx="19.7" cy="23" r="2.2" stroke="none"></circle></svg><div id="dem_so"></div></a>
                                <ul id="gio" role="menu" class="sub-menu2">
                                </ul> 
                                </li>
  </ul>
                        </div>
                    </div>
                </div>
        </div><!--/header-middle-->
    </div>
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">HOME</a></li>
                                @foreach($cate_product as $key =>$cate)
                                @if($cate->category_parent==0)
                                <li class="dropdown"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->slug_category)}}">{{$cate->category_name}}<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($cate_product as $key => $cate1)

                                        @if($cate1->category_parent!=0&&$cate1->category_parent==$cate->category_id)
                                            <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate1->slug_category)}}">{{$cate1->category_name}}</a></li>
                                        @endif
                                        @endforeach 
                                    </ul> 
                                </li> 

                                @endif
                               
                                @endforeach
                                <li class="dropdown"><a href="{{URL::to('/tin-tuc')}}">TIN TỨC<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category_post as $key => $category_post)
                                            <li><a href="{{url('/tin-tuc/'.$category_post->category_post_slug)}}">{{$category_post->category_post_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    

    
    <section>
        <div class="main_body">
            <div style="padding-top: 30px;" class="row">
                    @yield ("content")
        </div>
    </div>
    </section>
    
    <footer id="footer" style="min-height: 200px;margin-top: 30px">

         <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="single-widget">
                            <h2>Địa chỉ :</h2>
                            <div style="margin-left: -37px">{!!$web->web_address!!}</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Thông tin :</h2>
                            <div style="margin-left: -37px">{!!$web->web_infomation!!}</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>FANPAGE :</h2>
                            {!!$web->web_fanpage!!}
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Hỗ trợ: 24/24 h</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>liên hệ ngay <br />để biết thêm chi tiết</p>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </footer><!--/Footer-->
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="lIXdj67N"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
{{--     <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
 --}}    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert2.min.js')}}"></script>

    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
{{--     <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
 --}}    <script src="{{asset('public/frontend/js/lazy-loading.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JL6YR30Q78"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JL6YR30Q78');
</script>

<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "100356452287036");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
<script type="text/javascript">
    them_gio();
    function them_gio(){
      $.ajax({
        url:"{{url('/them-gio')}}",
        method:"get",
        success:function(data){
            $('#gio').html(data);
        }
      });
    }
</script>
<script type="text/javascript">
    $('#keywords').keyup(function(){
        var query = $(this).val();
          if(query != '')
            {
             var _token = $('input[name="_token"]').val();

             $.ajax({
              url:"{{url('/autocomplete-ajax')}}",
              method:"POST",
              data:{query:query, _token:_token},
              success:function(data){
               $('#search_ajax').fadeIn();  
                $('#search_ajax').html(data);
              }
             });

            }else{

                $('#search_ajax').fadeOut();  
            }
    });

    $(document).on('click', '.li_search_ajax', function(){  
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut();  
    }); 
</script>
<script type="text/javascript">
    dem_so();
    function dem_so() {
            $.ajax({
              url:"{{url('/dem-so')}}",
              method:"get",
              success:function(data){
                $('#dem_so').html(data);
              }
            });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:3,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
  });
</script>
<script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                // var cart_product_name = $('.cart_product_name_' + id).val();
                // var cart_product_image = $('.cart_product_image_' + id).val();
                // var cart_product_price = $('.cart_product_price_' + id).val();
                var product_qty=$('.product_qty_'+id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                // var cart_update_quantity = $('.cart_update_quantity_' + id).val();
                var color=$('.attribute-color' + id).val();
                var size=$('.attribute-size' + id).val();
                var price=$('.attribute-price' + id).val();
                var attribute_id=$('.attribute-id' + id).val();
                var _token = $('input[name="_token"]').val();
                if(typeof color=="undefined"){
                    color=0;
                    size=0;
                    price=0;
                    attribute_id=0;
                }
                if(parseInt(product_qty)<parseInt(cart_product_qty)){
                        Swal.fire({
                                    position: "",
                                    icon: "",
                                    title: "Sản phẩn tồn kho còn "+product_qty +" chiếc!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });                  
                    }
                else{
                $.ajax({
                    url: '{{url('/save-cart')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_qty:cart_product_qty,_token:_token,color:color,size:size,price:price,attribute_id:attribute_id},
                    success:function(respone){
                        if(respone==1){
                            Swal.fire({
                                    position: "",
                                    icon: "",
                                    title: "Sản phẩn tồn kho còn "+product_qty +" chiếc!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                        }
                        else if(respone==2){
                            them_gio();
                            dem_so();
                                Swal.fire({
                                    position: "",
                                    icon: "success",
                                    title: "Bạn đã thêm sản phẩm vào giỏ",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                    }}
                });}
            });
        $('.edit_customer_checkout').click(function(){
            var customer_id=$(this).data('customer_id');
            var address=$('.customer_address').val();
            var phone=$('.customer_phone').val();
            var name=$('.customer_name').val();
            var email=$('.customer_email').val();
            var _token=$('input[name="_token"]').val();
            if (address==""||phone==""||name==""||email=="") {
                alert("Bạn chưa nhập đủ thông tin");
            }
            else{
            $.ajax({
                url: '{{url('/edit-customer-checkout')}}',
                method: 'post',
                data:{customer_id:customer_id,address:address,phone:phone,name:name,email:email,_token:_token},
                success:function(data){
                    alert('Sửa thành công');
                    location.reload();
                    // fetch_customer();
                }
            });}
        });
    });
    </script>

</body>
</html>