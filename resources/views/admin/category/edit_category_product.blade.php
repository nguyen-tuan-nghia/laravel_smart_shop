 required@extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa danh mục sản phẩm
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
                            @foreach($edit_category_product as $key=>$edit)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit->category_id)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" class="form-control" value="{{($edit->category_name)}}" name="category_product_name" id="slug" placeholder="Tên danh mục" onkeyup="ChangeToSlug();" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">slug</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="slug_category" placeholder="Mô tả danh mục" id="convert_slug" required>{{($edit->slug_category)}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="category_product_desc" placeholder="Mô tả danh mục" required>{{($edit->category_desc)}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khóa</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="meta_keywords" placeholder="Mô tả danh mục" required>{{($edit->meta_keywords)}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thuộc danh mục</label>
                                      <select name="category_parent" class="form-control input-sm m-bot15">
                                        <option {{$edit->category_parent==0?'checked':''}} value="0">-----------Danh mục cha-----------</option>
                                        @foreach($category as $key => $val)
                                            @if($val->category_parent==0)     
                                                <option {{$val->category_id==$edit->category_parent ? 'selected' : '' }} value="{{$val->category_id}}">{{$val->category_name}}</option>
                                            @endif
                                            @foreach($category as $key => $val2)
                                                @if($val2->category_parent==$val->category_id) 
                                                    <option {{$val2->category_id==$edit->category_parent ? 'selected' : '' }} value="{{$val2->category_id}}">---{{$val2->category_name}}</option> 
                                                @endif

                                            @endforeach

                                        @endforeach
                                            
                                            
                                    </select>
                                </div>

                                @endforeach
                                <br>
                                <button type="submit" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection