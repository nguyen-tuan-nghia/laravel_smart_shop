@extends('layout')
@section('content')
<div class="container">
<h1><?php echo ''.$category_post_name.'';  ?></h1>
                        @foreach($post as$key =>$posst)
                            <a href="{{URL::to('/tin-tuc/'.$posst->category_post_slug.'/'.$posst->post_slug)}}">

                        <div class="col-sm-12">
                            <div class="product-image-wrapper">
                                <div {{-- class="single-products" --}}>
                                        <div class="productinfo text-center">
                                            <div class="row">
                                                <div class="col-sm-5">
                                            <img style="width: 300px;height: 300px;" src="{{URL::to('public/upload/post/'.$posst->post_img)}}" alt="{{($posst->post_title)}}" /></div>
                                            <div class="col-sm-5" style="padding-top: 30px; text-align: left;">
                                                <P>Danh mục: {{$posst->category_post_name}}</P>
                                            <b style="font-size: 30px" >{{($posst->post_title)}}</b>
                                            <p>{{($posst->post_desc)}}</p>
                                            <p>Tác giả: {{($posst->admin->admin_name)}}   ||   {{($posst->created_at)}}</p>
</div></div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                        </a>
                        @endforeach<div>
                            {{$post->links()}}
                        </div></div>
    @endsection