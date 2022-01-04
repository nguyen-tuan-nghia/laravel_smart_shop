@extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa Mã giảm giá
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
                            @foreach($coupon as $key =>$cou)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-coupon-'.$cou->coupon_id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" class="form-control" name="coupon_name"value="{{$cou->coupon_name}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text" class="form-control" name="coupon_code" value="{{$cou->coupon_code}}" required="">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng </label>
                                    <input type="number" class="form-control" name="coupon_quantity"value="{{$cou->coupon_quantity}}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tính măng mã</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15" required="">
                                    <option value="">--Chọn--</option>
                                    <option {{($cou->coupon_condition==1)?'selected':''}} value="">Giảm theo phần trăm</option>
                                    <option {{($cou->coupon_condition==2)?'selected':''}} value="">Giảm theo tiền</option>
                                    </select>
                                </div>

                        <div class="form-group">
                             <label for="exampleInputPassword1">Nhập số phần chăm & tiền giảm</label>
                                    <input type="number" class="form-control" name="coupon_number" value="{{$cou->coupon_number}}" required="">
                        </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày đắt đầu </label>
                                    <input type="text" class="form-control" id="coupon_date_1"  name="coupon_date_start" value="{{$cou->coupon_date_start}}" required="">
                                </div>                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày kết thúc </label>
                                    <input type="text" class="form-control" id="coupon_date_2"  name="coupon_date_end" value="{{$cou->coupon_date_end}}" required="">
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