@extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm slider
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
                                <form role="form" action="{{URL::to('/save-slider')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slider</label>
                                    <input type="text" class="form-control" name="slider_name" placeholder="Tên sản phẩm" required>
                                </div>        
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh slide</label>
                                    <input type="file" class="form-control" name="slider_img" placeholder="ảnh sản phẩm" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả </label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="slider_desc" placeholder="Mô tả sản phẩm" required></textarea>
                                </div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">vị trí</label>
                                <select name="slider_type" class="form-control input-sm m-bot15" required>
                                <option value="0">Đầu trang</option>
                                <option value="1">Đầu trang bên phải</option>
                                <option value="2">Gữa trang </option>
                                <option value="3">Gữa trang bên trái</option>
                                <option value="4">Gữa trang bên phải</option>
                            </select>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="slider_status" class="form-control input-sm m-bot15">
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