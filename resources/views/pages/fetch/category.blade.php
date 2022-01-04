<style type="text/css">
.category {
    display:none;
    padding: 10px;
    background-color: #FFFFFFFF;
}
.totop {
    position: fixed;
    bottom: 10px;
    right: 20px;
}
.totop a {
    display: none;
}
a, a:visited {
    color: #ee4d2d;
    text-decoration: none;
    display: block;
/*    margin: 10px 0;
*/}
a:hover {
    text-decoration: none;
}
#loadMore {
    padding: 10px 0px 10px 0px ;
    text-align: center;
    width: 400px;
    margin: auto;
    background-color: #404040;
    color: #fff;
    border-width: 0 1px 1px 0;
    border-style: solid;
    border-color: #fff;
    box-shadow: 0 1px 1px #ccc;
    transition: all 600ms ease-in-out;
    -webkit-transition: all 600ms ease-in-out;
    -moz-transition: all 600ms ease-in-out;
    -o-transition: all 600ms ease-in-out;
}
#loadMore:hover {
    background-color: #fff;
    color: #33739E;}
</style>
                        <h2 class="title text-center">{{($category_name->category_name)}}</h2>
                        @foreach($category_by_id as$key =>$new_product)
                        <a href="{{URL::to('/chi-tiet-san-pham/'.$new_product->product_slug)}}">
                        <div class="category col-sm-4">
                            <div class="product-image-wrapper">
                                <div >
                                        <div class="productinfo text-center">
                                            <img style="width: 160px;height: 200px;" src="{{URL::to('public/upload/product/'.$new_product->product_image)}}" alt="" />     
                                            <p style="height: 30px">{{($new_product->product_name)}}</p>
                                            @if($new_product->sale_off!=null)
                                            <div class="bottom-left">Giảm giá : {{number_format($new_product->sale_off,0,',','.')}}Đ</div>
                                            @endif
                                            <h4>{{number_format($new_product->product_price,0,',','.')}} Đ</h4>
                                        </div>    
                                </div>
                            </div>
                        </div>
                        </a>
                        @endforeach
                    <div class="clearfix"></div>
                        @if($category_by_id->count()>6)
                        <a  href="#" id="loadMore">Xem Thêm</a>
                        <p class="totop"> 
                            <a href="#top">Back to top</a> 
                        </p>
                        @endif    
{{--                             <div>
                            {{$category_by_id->links()}}
                        </div> --}}
<script type="text/javascript">
    $(function () {
    $('.category').slice(0, 6).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $('.category:hidden').slice(0, 6).slideDown();
        if ($('.category:hidden').length == 0) {
            $("#load").fadeOut('slow');
        }
        // $('html,body').animate({
        //     scrollTop: $(this).offset().top
        // }, 1300);
    });
});

$('a[href=#top]').click(function () {
    $('body,html').animate({
        scrollTop: 0
    }, 600);
    return false;
});

// $(window).scroll(function () {
//     if ($(this).scrollTop() > 50) {
//         $('.totop a').fadeIn();
//     } else {
//         $('.totop a').fadeOut();
//     }
// });
</script>