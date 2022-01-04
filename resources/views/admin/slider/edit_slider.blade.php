 required
@extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa slider
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
                            @foreach($edit_slider as $key=>$edit)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-slider/'.$edit->slider_id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slider</label>
                                    <input type="text" class="form-control" value="{{($edit->slider_name)}}" name="slider_name" placeholder="Tên sản phẩm" required>
                                </div>                    
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh slider</label>
                                    <input type="file" class="form-control"  name="slider_img" placeholder="ảnh sản phẩm">
                                    <img src="{{URL::to('public/upload/slider/'.$edit->slider_img)}}" style="width: auto">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả </label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="slider_desc" placeholder="Mô tả sản phẩm" required>{{($edit->slider_desc)}}</textarea>
                                </div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">vị trí</label>
                                <select name="slider_type" class="form-control input-sm m-bot15" required>
                                @foreach($edit_slider_notin as $key=>$edit1)
                                @if($edit1->slider_type==$edit->slider_type) 
                                    <option selected value ="{{($edit1->slider_type)}}">{{$edit1->slider_type_name}}</option>;
                                @else
                                    <option value ="{{($edit1->slider_type)}}">{{$edit1->slider_type_name}}</option>;
                                @endif
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