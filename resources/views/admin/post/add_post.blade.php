    @extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm bài viết
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
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài viết</label>
                                    <input type="text" class="form-control" id="slug" name="post_title" placeholder="Tên sản phẩm" onkeyup="ChangeToSlug();"  required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">slug</label>
                                    <input type="text" class="form-control" id="convert_slug" name="post_slug" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ khóa</label>
                                    <input type="text" class="form-control" name="post_keywords" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tóm tắt bài viết</label>
                                    <input type="text" class="form-control" name="post_desc" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" class="form-control" name="post_img" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="post_content" placeholder="Nội dung" id="ckeditor1"></textarea>

                                </div>

                            <div class="form-group">
                                 <label for="exampleInputPassword1">Thuộc danh mục bài viết</label>
                                    <select name="post_category" class="form-control input-sm m-bot15">
                                    <option value="">--Chọn--</option>
                                    @foreach($category_post as $key =>$category_post)
                                    <option value="{{$category_post->category_post_id}}">{{$category_post->category_post_name}}</option>
                                    @endforeach
                                </select>
                            </div>                                

                        <div class="form-group">
                             <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="post_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                                {{-- <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Check me out
                                    </label>
                                </div> --}}
                                <br>
                                <button type="submit"  class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection