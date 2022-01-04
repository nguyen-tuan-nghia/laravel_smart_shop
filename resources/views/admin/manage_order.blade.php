@extends('layout_Admin')
@section('admin_content')
<style type="text/css">
  .pay{
    border: 1px solid black;
    border-radius: 10%;
    padding: 5px;
\  }
</style>
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
{{--         <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>      --}}           
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">


{{--         <form action="" method="GET">
    <input type="text" placeholder="Search" name="Search"/>
    <button class="btn btn-sm btn-default"  type="submit">tìm kiếm</button>
</form> --}}
{{--   <input class="form-control" id="myInput" type="text" placeholder="Search..">
 --}}      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light"id="myTable">
        <thead>

            <th>ID</th>
            <th>Tên khách hàng</th>
            <th>Số điênh thoại</th>
            <th>Tình trạng</th>
            <th>Hình thức tanh toán</th>
            <th>Ngày đặt</th>
            <th>Trang thái</th>
          </tr>
        </thead>
        <tbody >
          @foreach($all_order as $key => $val)
          <tr>
            <td>{{($val->order_id)}}</td>
            <td>{{($val->customer_name)}}</td>
            <td>{{($val->phone)}}</td>
            <td>
              <?php
              if($val->order_status==1){
                echo'<b >Đơn hàng mới</b>';
              }
              elseif ($val->order_status==2) {
                echo'<b style="color:blue">Đơn hàng đang giao</b?';

              }
              elseif ($val->order_status==3) {
                echo'<b style="color:red">Đơn hàng đã hủy</b?';
              }
              elseif ($val->order_status==4) {
                echo'<b style="color:green">Đã xử lý</b>';
              }
               ?>
            </td>
            @if($val->payment_type!="Paypal")
            <td><span class="pay" style="background-color: #3c5b76;color: white">{{($val->payment_type)}}</span></td>
            @else
            <td><span class="pay" style="background-color: #0062ccc9;color: white">{{($val->payment_type)}}</span></td>

            @endif
            <td>{{($val->created_at)}}</td>

            <td>
              <a href="{{URL::to('/manage-order-detail/'.$val->order_id)}}" class="active_styling_edit"><i class="fa fa-cog"></i>
              	<a onClick="return confirm('Bạn có chắc muốn xóa đươn hàng này')" href="{{URL::to('/delete-order/'.$val->order_id)}}" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
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
{{--         <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
{{$all_order->links()}}
          </ul>
        </div> --}}
      </div>
    </footer>
  </div>
</div>
@endsection
