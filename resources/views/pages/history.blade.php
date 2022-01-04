@extends('layout')
@section('content')
<div class="container">
<div id="" class="">
      Liệt kê tất cả đơn hàng
    </div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Mã đơn hàng</th>
            <th>Ngày tháng đặt hàng</th>
            <th>Hình thức thanh toán</th>
            <th>Tình trạng đơn hàng</th>
          </tr>
        </thead>
        <tbody>
          @foreach($getorder as $key => $ord)
          <tr>
            <td ><a style="color:#0094FFFF" href="{{URL::to('/view-history-order/'.$ord->order_id)}}" class="active styling-edit" ui-toggle-class="">{{ $ord->order_id }}</a></td>

            <td>{{ $ord->created_at }}</td>
            <td>{{$ord->payment_type}}</td>
                @if($ord->order_status==1)
                  <td>Đang xử lý</td>
                @elseif($ord->order_status==2)
                  <td >Đang giao giao hàng</td>
                @elseif($ord->order_status==4)
                  <td>Giao hàng thành công</td>
                @elseif($ord->order_status==3)
                  <td>Đơn hàng đã hủy</td> 
                @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
   

    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {!!$getorder->links()!!}
          </ul>
        </div>
      </div>
    </footer>
   
  </div>
</div></div>
</div>					
@endsection
