@extends('layout')
@section('content')
<style type="text/css">
    .c1 { filter: hue-rotate(0deg)   }
.c2 { filter: hue-rotate(30deg)  }
.c3 { filter: hue-rotate(60deg)  }
.c4 { filter: hue-rotate(90deg)  }
.c5 { filter: hue-rotate(120deg) }
.c6 { filter: hue-rotate(150deg) }
.c7 { filter: hue-rotate(180deg) }
.c8 { filter: hue-rotate(210deg) }
.c9 { filter: hue-rotate(240deg) }
/* Prevent cursor being `text` between checkboxes */
</style>
<div class="container">
    @csrf
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($brand_product as$key=>$brand)
                                    {{-- <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_name)}}"> <span class="pull-right"></span>{{($brand->brand_name)}}</a></li> --}}
                                        <div class="form-check">
                                          <input class="form-check-input c6 fetch_brand" type="checkbox" value="{{($brand->brand_id)}}" id="flexCheckDefault">
                                          <label class="form-check-label" for="flexCheckDefault">
                                            {{($brand->brand_name)}}
                                          </label>
                                        </div></br>
                                        @endforeach

                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        <div class="brands_products"><!--brands_products-->
                            <h2>Giá :</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                <div class="form-check">
                                  <input class="form-check-input c6 price-filter" type="checkbox" value="" id="1">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    Dưới 1.000.000 vnđ
                                  </label>
                                </div>
                            </br>
                                <div class="form-check">
                                  <input class="form-check-input c6 price-filter" type="checkbox" value="" id="2">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    Từ 1.000.000 đến 5.500.000 vnđ
                                  </label>
                                </div>
                            </br>
                                <div class="form-check">
                                  <input class="form-check-input c6 price-filter" type="checkbox" value="" id="3">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    Từ 5.500.000 đến 10.500.000 vnđ
                                  </label>
                                </div>
                            </br>    
                                <div class="form-check">
                                  <input class="form-check-input c6 price-filter" type="checkbox" value="" id="4">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    Từ 10.500.000 đến 20.500.000 vnđ
                                  </label>
                                </div>
                            </br>
                                <div class="form-check">
                                  <input class="form-check-input c6 price-filter" type="checkbox" value="" id="5">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    Từ 20.500.000 vnđ trở lên
                                  </label>
                                </div>
                            </br>
                            </div>
                        </div><!--/brands_products-->


{{--                         <div class="price-range"><!--price-range-->
                            <h2>Thanh giá</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range--> --}}
                    
                    </div>
                </div><input type="hidden" id="slug_category" value="{{$category->slug_category}}">
                    <div class="features_items" id="load_product"><!--features_items-->
                        @include('pages.fetch.category')
                </div>
</div>
<script type="text/javascript">
    $('.form-check-input').change(function(){
        $('.price-filter').change(function(){
            $('.price-filter').not(this).prop('checked', false);
        })
        var slug=$('#slug_category').val();
        var price =$(".price-filter:checked").attr('id');
        var _token=$('input[name="_token"]').val();
        var brand=[];
        $.each($(".fetch_brand:checked"),function(){
            brand.push($(this).val());
        });
        if (typeof price=="undefined") {
        $.ajax({
            url:"{{url('/category-fetch-home-brand')}}",
            method:"post",
            data:{brand:brand,slug:slug,_token:_token},
            success:function(data){
                $('#load_product').html(data).fadeIn('slow');
            },
            error:function(data){
                $('#load_product').html("<center><h2>Không có sản phẩm liên quan</h2></center>").fadeIn('slow');
            }
        });
    }
        else if(brand==""){
        $.ajax({
            url:"{{url('/category-fetch-home-price')}}",
            method:"post",
            data:{price:price,slug:slug,_token:_token},
            success:function(data){
                $('#load_product').html(data).fadeIn('slow');
            },
            error:function(data){
                $('#load_product').html("<center><h2>Không có sản phẩm liên quan</h2></center>").fadeIn('slow');
            }
        });
        }
        else{
        $.ajax({
            url:"{{url('/category-fetch-home-all')}}",
            method:"post",
            data:{price:price,brand:brand,slug:slug,_token:_token},
            success:function(data){
                $('#load_product').html(data).fadeIn('slow');
            },
            error:function(data){
                $('#load_product').html("<center><h2>Không có sản phẩm liên quan</h2></center>").fadeIn('slow');
            }
        });
    }
    });
</script>
@endsection