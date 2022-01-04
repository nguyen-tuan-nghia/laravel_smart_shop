    @extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục bài viết
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
                                <form role="form" action="{{URL::to('/save-category-post')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                                    <input type="text" class="form-control" id="slug" name="category_post_name"  onkeyup="ChangeToSlug();"  required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">slug</label>
                                    <input type="text" class="form-control" id="convert_slug" name="category_post_slug" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung</label>
                                    <input type="text" class="form-control" name="category_post_desc" required="">
                                </div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="category_post_status" class="form-control input-sm m-bot15">
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