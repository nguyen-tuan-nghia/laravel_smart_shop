@extends('layout')
@section('content')
<style type="text/css">
    .main_body{
          background-color: #f5f5f5; /* For browsers that do not support gradients */
/*  background-image: linear-gradient(to bottom right ,#f5f5f5,white);
*/    }
</style>
<div class="container">
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>                       
                        <div class="carousel-inner"> 
                        @php
                            $i=0;
                        @endphp
                        @foreach($slider as $key =>$value)
                        @php
                            $i++;
                        @endphp
                            <div class="item {{$i==1?'active':' '}}">
                                    <img alt="{{$value->dactiveesc}}" src="{{URL::to('public/upload/slider/'.$value->slider_img)}}" style="width: auto;height: auto"  alt="" />
                            </div>
                           @endforeach   
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
                <div class="col-sm-4">
                    @foreach($slider1 as $key =>$value)

                        <img alt="{{$value->desc}}" src="{{URL::to('public/upload/slider/'.$value->slider_img)}}"
                        class="girl img-responsive" style="margin-top: 5px"  alt="" />

                    @endforeach
                </div>
                
            </div>@foreach($slider2 as $key =>$value)
                        <img alt="{{$value->desc}}" src="{{URL::to('public/upload/slider/'.$value->slider_img)}}"
                         class="girl img-responsive" style="margin-top: 10px;" alt="" />

                        @endforeach
        </div>
    </section><!--/slider-->
<br>
                      
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Sản phẩm mới</h2>
                        <div class="row">
                        @foreach($new_product as$key =>$new_product)

                                            <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div {{-- class="single-products" --}}>
                                        <div class="productinfo text-center">
                                            <div class="image1">
                                                <a href="{{URL::to('/chi-tiet-san-pham/'.$new_product->product_slug)}}">
                                            @if($new_product->sale_off!=null)
                                            <div class="bottom-left">Giảm giá : {{number_format($new_product->sale_off,0,',','.')}}</div>
                                            @endif
                                            <img class="lazy" style="width: 160px;height: 200px;" data-src="{{URL::to('public/upload/product/'.$new_product->product_image)}}" alt="" /></div>
                                            <h4 style="height: 23px;">{{($new_product->product_name)}}</h4>
                                            <h2 >{{number_format($new_product->product_price,0,',','.').'VNĐ'}} </h2>
                                </a>
                            </div>
                                        
                                </div>
                            </div>
                        </div>
                    

                        @endforeach
                        </div>
                    </div><!--features_items-->

                <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Sản phẩm được quan tâm</h2>
                        <div class="row">
                            <div class="col-sm-12" >
                        @foreach($all_product as$key =>$all_product)

                                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div {{-- class="single-products" --}}>
                                        <div class="productinfo text-center">
                                            <div class="image1">
                                                <a href="{{URL::to('/chi-tiet-san-pham/'.$all_product->product_slug)}}">
                                            @if($all_product->sale_off!=null)
                                            <div class="bottom-left">Giảm giá : {{number_format($all_product->sale_off,0,',','.')}}</div>
                                            @endif
                                            <img class="lazy" style="width: 100px;height: 150px;" data-src="{{URL::to('public/upload/product/'.$all_product->product_image)}}" alt="" /></div>
                                            <h4 style="height: 23px;">{{($all_product->product_name)}}</h4>
                                            <h2 >{{number_format($all_product->product_price,0,',','.').'VNĐ'}} </h2>
                                </a>
                            </div>
                                        
                                </div>
                            </div>
                        </div>
                    

                        @endforeach
                    </div>
                        </div>
                    </div><!--features_items-->
                <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Laptop</h2>
                        <div class="row">

                            <div class="col-sm-12" >
                        @foreach($laptop as$key =>$all_product)

                                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div>
                                        <div class="productinfo text-center">
                                            <div class="image1">
                                                <a href="{{URL::to('/chi-tiet-san-pham/'.$all_product->product_slug)}}">
                                            @if($all_product->sale_off!=null)
                                            <div class="bottom-left">Giảm giá : {{number_format($all_product->sale_off,0,',','.')}}</div>
                                            @endif
                                            <img class="lazy" style="width: 100px;height: 150px;" data-src="{{URL::to('public/upload/product/'.$all_product->product_image)}}" alt="" /></div>
                                            <h4 style="height: 23px;">{{($all_product->product_name)}}</h4>
                                            <h2 >{{number_format($all_product->product_price,0,',','.').'VNĐ'}} </h2>
                                </a>
                            </div>
                                        
                                </div>
                            </div>
                        </div>
                    

                        @endforeach
                        @foreach($mac as$key =>$all_product)

                                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div>
                                        <div class="productinfo text-center">
                                            <div class="image1">
                                                <a href="{{URL::to('/chi-tiet-san-pham/'.$all_product->product_slug)}}">
                                            @if($all_product->sale_off!=null)
                                            <div class="bottom-left">Giảm giá : {{number_format($all_product->sale_off,0,',','.')}}</div>
                                            @endif
                                            <img class="lazy" style="width: 100px;height: 150px;" data-src="{{URL::to('public/upload/product/'.$all_product->product_image)}}" alt="" /></div>
                                            <h4 style="height: 23px;">{{($all_product->product_name)}}</h4>
                                            <h2 >{{number_format($all_product->product_price,0,',','.').'VNĐ'}} </h2>
                                </a>
                            </div>
                                        
                                </div>

                            </div>
                        </div>
                    

                        @endforeach
                    </div>
                        </div>
                    </div><!--features_items-->
</div>
@endsection