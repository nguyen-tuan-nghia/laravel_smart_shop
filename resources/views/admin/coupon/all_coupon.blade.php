@extends('layout_Admin')
@section('admin_content')
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      liệt kê mã giảm giá
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
           
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">

      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
{{--             <th>Điều kiện giảm giá</th>
 --}}            <th>Số giảm</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>trạng thái</th>
            <th></th>
          </tr>
        </thead>
        <tbody  >
          @foreach($coupon as $key => $cate_pro)
          <tr>
            <td>{{($cate_pro->coupon_name)}}</td>
            <td><span class="text-ellipsis">{{($cate_pro->coupon_code)}}</span></td>
            <td><span class="text-ellipsis">{{($cate_pro->coupon_quantity)}}</span></td>
{{--             <td><span class="text-ellipsis">
              <?php
              if($cate_pro->coupon_condition==1){
                 echo "giảm giá theo phần trăm"; 
               } 
               else{
                echo "giảm giá theo tiền"; 
               }
              ?>

            </span></td> --}}
            <td><span class="text-ellipsis">
          
              @if($cate_pro->coupon_condition==1)
                {{($cate_pro->coupon_number).'%'}}
              @else
                {{number_format($cate_pro->coupon_number,0,',','.').'vnđ'}}
              @endif
              
{{--             </span></td> --}}
            <td><span class="text-ellipsis">{{($cate_pro->coupon_date_start)}}</span></td>
            <td><span class="text-ellipsis">{{($cate_pro->coupon_date_end)}}</span></td>
            <td>
              @if($cate_pro->coupon_date_end>$today)
                <span style="color: green">vẫn còn hạn</span>
              @else
                <span style="color: red">đã hết hạn</span>
              @endif
            </td>
            <td>
              <a style="padding-right: 20px;" href="{{URL::to('/send-coupon/'.$cate_pro->coupon_id)}}" class="active_styling_edit"><i class="fa fa-envelope"></i>Gửi mail</a>
              <a href="{{URL::to('/edit-coupon/'.$cate_pro->coupon_id)}}" class="active_styling_edit"><i class="fa fa-cog"></i></a>
              	<a onClick="return confirm('Bạn có chắc muốn xóa mục này?')" href="{{URL::to('/delete-coupon/'.$cate_pro->coupon_id)}}" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
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