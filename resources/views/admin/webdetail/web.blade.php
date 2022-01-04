    @extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thông tin website
                        </header>
{{--     @if (count($errors) > 0)
      <div class="alert alert-danger">
          Thông tin không đầy đủ, bạn cần chỉnh sửa như sau:
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif --}}
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-web-detail')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên website :</label>
                                    <input type="text" class="form-control" name="web_name" placeholder="Tên website" value="{{$web->web_name}}">
                                </div>                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Logo web :</label>
                                    <input type="file" class="form-control" name="file" placeholder="ảnh sản phẩm" onchange="loadFile(event)">
                                    <img id="output" style="height: 80px" src="{{asset('public/upload/logo/'.$web->web_logo)}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ :</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="web_address" placeholder="Địa chỉ" id="ckeditor1" >{{$web->web_address}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung web :</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="web_infomation" placeholder="Nội dung web" id="ckeditor2" >{{$web->web_infomation}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Fanpage :</label>
                                    <textarea class="form-control" style="resize: none" rows="8" name="web_fanpage" placeholder="Nội dung fanpage" >{{$web->web_fanpage}}</textarea>
                                </div>
                                <br>
                                <button type="submit"  class="btn btn-info">Lưu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
@endsection