@extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Quản lý vận chuyển
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
                                <form role="form"  method="post" enctype="multipart/form-data">
                                @csrf
                        <div class="form-group">
                             <label for="exampleInputPassword1">Chọn thành phố</label>
                                <select name="city" id="city" class="form-control input-sm m-bot15 city choose">
                                    <option value="">--Chọn tỉnh thành phố--</option>
                                    @foreach($city as $key => $city)
                                <option value="{{($city->matp)}}">{{($city->name_tp)}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">Chọn quận huyện</label>
                                <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                    <option value="">--Chọn quận huyện--</option>
                            </select>
                        </div>
                        <div class="form-group">
                             <label for="exampleInputPassword1">Chọn xã phường</label>
                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value="">--Chọn xã phường--</option>
                            </select>
                        </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input type="text" class="form-control price_format fee_ship" name="fee_ship" placeholder="Tên sản phẩm">
                                </div>
                                <br>
                                <button type="button" name="add_delivery"  class="btn btn-info add_delivery">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
        <div id="load_delivery">
          
        </div>
@endsection