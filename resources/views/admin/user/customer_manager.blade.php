@extends('layout_Admin')
@section('admin_content')
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      liệt kê người dùng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
{{--         <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>  --}}               
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">

{{--         <form action="" method="GET">
    <input type="text" placeholder="Search" name="Search"/>
    <button class="btn btn-sm btn-default"  type="submit">tìm kiếm</button>
</form> --}}
{{--   <input class="form-control" id="myInput" type="text" placeholder="Search..">
 --}}
 <style type="text/css">
   .cus-img{
    border: 1px solid white;
    border-radius: 50%;
    width: 30px;
    height: 30px;
   }
 </style>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>Hình ảnh</th>
            <th>Tên khách hàng</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($customer as $key => $cus)
          <tr>
            @if($cus->customer_img!=null)
            <td><img class="cus-img" src="{{URL::to('public/upload/avata/'.$cus->customer_img)}}" style="cursor: zoom-in;"/></td>
            @else 
            <td><img class="cus-img" src="{{URL::to('public/frontend/images/avatardefault_92824.png')}}" style="cursor: zoom-in;"/></td>
            @endif
            <td>{{$cus->customer_name}}</td>
            <td>{{$cus->address}}</td>
            <td>{{$cus->phone}}</td>
            <td>{{$cus->email}}</td>
            <td>
              	<a onClick="return confirm('Bạn có chắc muốn xóa người dùng này?')" href="{{URL::to('/delete-customer/'.$cus->customer_id)}}" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
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
@endsection