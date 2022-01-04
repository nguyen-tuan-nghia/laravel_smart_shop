    @extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Đổi mật khẩu
                        </header>
        @php
        $id=Session::get('admin_id');
         @endphp
    <div class="panel-body">
        <div class="position-center">
        <form>
            {{csrf_field()}}
            <div id="sai_mk_old"></div>
       <div class="form-group">
            <label for="exampleInputEmail1">Mật khẩu cũ</label>
            <input type="password" class="form-control password-old-<?php echo $id ?>" value="" placeholder="PASSWORD" required="">
        </div>         
       <div class="form-group">
            <label for="exampleInputEmail1">Mật khẩu mới</label>
            <input type="password" class="form-control password-new-<?php echo $id ?>" value="" placeholder="PASSWORD" required="">
        </div>                                  
                                
            <button type="button" data-admin_id="<?php echo $id ?>" class="btn btn-info xac-nhan-mk">Đổi mật khẩu</button>
        </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection