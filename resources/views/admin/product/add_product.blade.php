    @extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="slug" name="product_name" placeholder="Tên sản phẩm" onkeyup="ChangeToSlug(); " required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">slug</label>
                                    <input type="text" class="form-control" id="convert_slug" name="product_slug" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="number" class="form-control" name="quantity" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gía nhập</label>
                                    <input type="text" class="form-control price_format" name="import_price" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá bán</label>
                                    <input type="text" class="form-control price_format" name="product_price" required>
                                </div>                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="product_image" placeholder="ảnh sản phẩm" required>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="product_desc" placeholder="Mô tả sản phẩm" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="product_content" placeholder="Nội dung sản phẩm" id="ckeditor1" required></textarea>
                                </div>
                                <div class="form-group">
                             <label for="exampleInputPassword1">Thuộc danh mục</label>
                                <select name="category_id" class="form-control input-sm m-bot15" required>
                                <option value="">--Chọn--</option>
                                    @foreach($cate_product as $key => $cate)
                                    @if($cate->category_parent==0)
                                        <option value="{{($cate->category_id)}}">{{($cate->category_name)}}</option>
                                    @endif
                                    @foreach($cate_product as $key2 => $cate2)
                                    @if($cate2->category_parent==$cate->category_id)
                                        <option value="{{($cate2->category_id)}}">--{{($cate2->category_name)}}</option>
                                    @endif
                                    @endforeach
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">Thương hiệu</label>
                                <select name="brand_id" class="form-control input-sm m-bot15" required>
                                <option value="">--Chọn--</option>
                                    @foreach($brand_product as $key => $brand)
                                <option value="{{($brand->brand_id)}}">{{($brand->brand_name)}}</option>
                                    @endforeach                            
                                </select>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">Trạng thái</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
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