@extends('layout_Admin')
@section('admin_content')
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nhận xét
    </div>
    @csrf
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
{{--         <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>    --}}             
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
{{--         <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div> --}}
{{--           <input class="form-control" id="myInput" type="text" placeholder="Search..">
 --}}
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Tên sản phẩm</th>
            <th>Nội dung</th>
            <th>Trạng thái</th>
            <th>Ngày đăng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($feedback as $key => $val)
          <tr id="load_feedback_list{{$val->feedback_id}}">
            <td>{{$val->feedback_id}}</td>
            <td>{{$val->customer_name}}</td>
            <td><a href="{{URL('/chi-tiet-san-pham/'.$val->product_slug)}}">{{$val->product_name}}</a></td>
            <td>{{$val->message}}</br><div class="row" style="height: 60px">
            @foreach($feedback_img as $key2 => $val2)
            @if($val2->feedback_id==$val->feedback_id)
            <img style="height: 60px" src="{{asset('public/upload/coment_img/'.$val2->feedback_name)}}">
            @endif
            @endforeach
          </div>
            </td>
            <td>@if($val->feedback_status==0)
              <button type="button" data-feedback_id="{{$val->feedback_id}}" id="1" class="btn btn-primary feedback_update">Duyệt</button>
              @else
              <button type="button" data-feedback_id="{{$val->feedback_id}}" id="0" class="btn btn-danger feedback_update">Bỏ duyệt</button>
              @endif
            </td>
            <td>{{$val->created_at}}</td>
            <td>
              	<a onClick="delete_feedback({{$val->feedback_id}})" href="javascript::void(0)" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">Ahii</small>
        </div>

      </div>
    </footer>
  </div>
</div>
<script type="text/javascript">
  function delete_feedback(id) {
    // var _token=$('input[name="_token"]').val();
    if(confirm('Bạn có chắc muốn xóa nhận xét này?')){
    $.ajax({
        url:"{{url('/delete-feedback')}}/"+id,
        method:"get",
        success:function(data){
          $('#load_feedback_list'+id).remove();
        }
    });}
  }
</script>
<script type="text/javascript">
    $('.feedback_update').click(function(){
    var feedback_status=$(this).attr('id');
    var feedback_id=$(this).data('feedback_id');
    var _token=$('input[name="_token"]').val();
    $.ajax({
        url:"{{url('/update-feedback')}}",
        method:"post",
        data:{feedback_id:feedback_id,feedback_status:feedback_status,_token:_token},
        success:function(data){
          location.reload();
        }
    });
  });
</script>
@endsection