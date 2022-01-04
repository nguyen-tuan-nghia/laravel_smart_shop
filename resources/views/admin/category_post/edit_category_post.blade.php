@extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa danh mục bài viết
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
                                <form role="form" action="{{URL::to('/update-category-post/'.$edit->category_post_id)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                                    <input type="text" class="form-control" id="slug" name="category_post_name" placeholder="Tên sản phẩm" onkeyup="ChangeToSlug();" value="{{$edit->category_post_name}}"  required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">slug</label>
                                    <input type="text" class="form-control" id="convert_slug" name="category_post_slug" value="{{$edit->category_post_slug}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung</label>
                                    <input type="text" class="form-control" name="category_post_desc" value="{{$edit->category_post_desc}}" required="">
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