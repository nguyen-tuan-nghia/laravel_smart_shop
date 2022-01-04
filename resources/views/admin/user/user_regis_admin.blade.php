    @extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Người dùng
                        </header>
                            <?php
    $message=Session::get('message');
    if($message){
        echo '<div><i style="color:white; text-align:center;">',$message,'</i></div>';
        Session::put('message',null);
    }
    ?>
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
        <form action="{{URL::to('/user-add')}}" method="post">
            {{csrf_field()}}

        <div class="form-group">
            <label for="exampleInputEmail1">Họ tên: </label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Name" required="">
        </div>
       <div class="form-group">
            <label for="exampleInputEmail1">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Phone" required="">
        </div>
       <div class="form-group">
            <label for="exampleInputEmail1">Địa chỉ</label>
            <input type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="Adress" required="">
        </div>
       <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="E-MAIL" required="">
        </div>        
       <div class="form-group">
            <label for="exampleInputEmail1">Mật khẩu</label>
            <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="PASSWORD" required="">
        </div>                                  {{-- <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Check me out
                                    </label>
                                </div> --}}
                        
                                <button type="submit"  class="btn btn-info">Thêm</button>
        </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection