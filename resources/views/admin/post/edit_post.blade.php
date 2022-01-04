@extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa bài viết
                        </header>
    @if (count($errors) > 0)
      <div class="alert alert-danger">
          Thông tin không đầy đủ, bạn cần chỉnh sửa như sau:
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
                        <div class="panel-body">
                            @foreach($edit_post as $key=>$edit)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-post/'.$edit->post_id)}}" method="post"  enctype="multipart/form-data">>
                                {{csrf_field()}}
                               <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài viết</label>
                                    <input type="text" class="form-control" id="slug" name="post_title" placeholder="Tên sản phẩm" value="{{$edit->post_title}}" onkeyup="ChangeToSlug();"  required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">slug</label>
                                    <input type="text" class="form-control" id="convert_slug" name="post_slug" value="{{$edit->post_slug}}" required="" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ khóa</label>
                                    <input type="text" class="form-control" name="post_keywords" value="{{$edit->post_keywords}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tóm tắt bài viết</label>
                                    <input type="text" class="form-control" name="post_desc" value="{{$edit->post_desc}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" class="form-control" name="post_img">
                                    <img src="{{URL::to('public/upload/post/'.$edit->post_img)}}" style="width: 200px">
                                </div>                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="post_content" placeholder="Nội dung" id="ckeditor1">{{$edit->post_content}}</textarea>

                                </div>

                            <div class="form-group">
                                 <label for="exampleInputPassword1">Thuộc danh mục bài viết</label>
                                    <select name="post_category" class="form-control input-sm m-bot15">
                                    @foreach($category_post as $key =>$category)
                                    @if($category->category_post_id==$edit->post_category)
                                    <option value="{{$category->category_post_id}}">{{$category->category_post_name}}</option>
                                    @else
                                    <option value="{{$category->category_post_id}}">{{$category->category_post_name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>              

                                <br>
                                <button type="submit"  class="btn btn-info">Thêm</button>
                            </form>
                            </div>
@endforeach
                        </div>
                    </section>

            </div>
        </div>
@endsection