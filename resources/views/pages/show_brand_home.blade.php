@extends('layout')
@section('content')
<div class="container">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($brand_product as$key=>$brand)
                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_name)}}"> <span class="pull-right"></span>{{($brand->brand_name)}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range-->
                        
                        <div class="shipping text-center"><!--shipping-->
                            <img src="images/home/shipping.jpg" alt="" />
                        </div><!--/shipping-->
                    
                    </div>
                </div>
                    <div class="features_items"><!--features_items-->
                        @foreach($brand_by_name as $key=>$brand_name)
                        <h2 class="title text-center">{{($brand_name->brand_name)}}</h2>
                        @endforeach
                        @foreach($brand_by_id as$key =>$new_product)
                            <a href="{{URL::to('/chi-tiet-san-pham/'.$new_product->product_slug)}}">

                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div {{-- class="single-products" --}}>
                                        <div class="productinfo text-center">
                                            <img style="width: 160px;height: 200px;" src="{{URL::to('public/upload/product/'.$new_product->product_image)}}" alt="" />
                                            <p style="height: 30px">{{($new_product->product_name)}}</p>
                                            @if($new_product->sale_off!=null)
                                            <div class="bottom-left">Giảm giá : {{number_format($new_product->sale_off,0,',','.')}}Đ</div>
                                            @endif
                                            <h4>{{number_format($new_product->product_price,0,',','.')}} Đ</h4>
{{--                                             <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a> --}}
                                        </div>
                                        
                                </div>
{{--                                 <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        </a>
                        @endforeach<div>
                            {{$brand_by_id->links()}}
                        </div>
</div>
                        @endsection