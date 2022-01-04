@extends('layout')
@section('content')
<div class="container">
<div class="row" style="font-size: 20px;">
<div style="background: #F008;float: left;margin: 6px;padding: 3px">MỚI NHẤT</div>
@foreach($category_post as $key =>$cate)
    <div style="float: left;margin: 6px;padding: 3px" ><a href="{{URL::to('/tin-tuc/'.$cate->category_post_slug)}}">{{$cate->category_post_name}}</a></div>
@endforeach
</div>
<br>
<div class="col-sm-12" style="margin-bottom: 30px">
<div class="row">
    <div class="col-sm-7">
<a  href="{{URL::to('/tin-tuc/'.$top->category_post->category_post_slug.'/'.$top->post_slug)}}">
    <img style="width:630px" src="{{URL::to('public/upload/post/'.$top->post_img)}}" alt="{{($top->post_title)}}" />
    <div class="clearfix"></div>
    <b style="font-size: 20px;color: #808080">{{($top->post_title)}}</b>
</a>
<br>
    <p>{{($top->post_desc)}}</p>
</div>

    <div class="col-sm-5">
    <b>Tin được quan tâm :</b>
    <br><br>
    @foreach($post_top_view as$key =>$post_top_view)
<a href="{{URL::to('/tin-tuc/'.$post_top_view->category_post->category_post_slug.'/'.$post_top_view->post_slug)}}">
<p>{{($post_top_view->post_title)}}</p></a>
    <hr>
    @endforeach
</div>
</div>
</div>

                        @foreach($post as$key =>$posst)
                        <hr>
                            <a href="{{URL::to('/tin-tuc/'.$posst->category_post->category_post_slug.'/'.$posst->post_slug)}}">
                        <div class="col-sm-12">
                            <div class="product-image-wrapper">
                                <div {{-- class="single-products" --}}>
                                        <div class="productinfo text-center">
                                            <div class="row">
                                                <div class="col-sm-5">
                                            <img style="width: 300px;height: 300px;" src="{{URL::to('public/upload/post/'.$posst->post_img)}}" alt="{{($posst->post_title)}}" /></div>
                                            <div class="col-sm-5" style="padding-top: 30px; text-align: left;">
                                                <P>Danh mục: {{$posst->category_post->category_post_name}}</P>
                                            <b style="font-size: 30px" >{{($posst->post_title)}}</b>
                                            <p>{{($posst->post_desc)}}</p>
                                            <p>Tác giả: {{($posst->admin->admin_name)}}   ||   {{($posst->created_at)}}</p>
</div></div>
                                        </div>
                                        
                                </div>
   {{--                              <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        </a>
                        <hr>
                        @endforeach<div>
                            {{$post->links()}}
                        </div>
                    </div>
    @endsection