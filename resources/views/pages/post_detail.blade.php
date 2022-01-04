@extends('layout')
@section('content')
                        @foreach($post_by_id as$key =>$posst)
<style>
img {
    width: 100%;
  object-fit: cover;
}
</style>
<div class="container" style="width: 70%;">
                                            <div class="row" style="border-bottom: 1px solid blacK;text-align: center;">
                                                <h1>{{$posst->post_title}}</h1>
                                                <br>
                                                <p style="text-align: right;">Tác giả : {{$posst->admin->admin_name}} // {{$posst->created_at}}</p>
                                        </div>
                                        <div style="padding-top: 40px">{!!$posst->post_content!!}</div>
<style type="text/css">
    .productinfo img {
    width: 159px;
    height: 170px;
    margin: 15px;
}
</style>

                <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">có thể bạn sẽ thích</h2>
                        
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                @foreach($related_product as $key =>$related)
                                <a href="{{URL::to('/chi-tiet-san-pham/'.$related->product_slug)}}">
    
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
<img style="width: 160px;height: 200px;" src="{{URL::to('public/upload/product/'.$related->product_image)}}" alt="" />
                                            <p style="height: 30px">{{($related->product_name)}}</p>
                                            @if($related->sale_off!=null)
                                            <div class="bottom-left">Giảm giá : {{number_format($related->sale_off,0,',','.')}}Đ</div>
                                            @endif
                                            <h4>{{number_format($related->product_price,0,',','.')}} Đ</h4>
{{--                                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>thêm vào giỏ hàng</button>
 --}}                                               </div>
                                            </div>
                                        </div>
                                    </div></a>
                                    @endforeach
                                </div>
                            </div>
{{--                             <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>           --}}
                        </div>
                    </div><!--/recommended_items-->                      
</div>
                        @endforeach
    @endsection