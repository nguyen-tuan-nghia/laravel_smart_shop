@extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục required
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" id="slug" name="category_product_name" placeholder="Tên danh mục" onkeyup="ChangeToSlug();" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">slug</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="slug_category" placeholder="Mô tả danh mục" id="convert_slug" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="category_product_desc" placeholder="Mô tả danh mục" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khóa</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="meta_keywords" placeholder="Mô tả danh mục" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thuộc danh mục</label>
                                      <select name="category_parent" class="form-control input-sm m-bot15">
                                        <option value="0">---Danh mục cha---</option>
                                        @foreach($category as $key => $val)
                                           <option value="{{$val->category_id}}">{{$val->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                             <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="category_product_status" class="form-control input-sm m-bot15">
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