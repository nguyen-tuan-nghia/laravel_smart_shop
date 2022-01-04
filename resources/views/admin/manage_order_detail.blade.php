@extends('layout_Admin')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người mua
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">

      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên Khách hàng</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
{{--             <th>Hình thức thanh toán</th>
 --}}            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($shipping_detail as $key => $val)
          @php
            $order_status= $val->order_status;
          @endphp
          <tr>
            <td>{{($val->customer_id)}}</td>
            <td>{{($val->customer_name)}}</td>
            <td>{{($val->address)}}</td>
            <td><span class="text-ellipsis">{{($val->phone)}}</span></td>
{{--             <td>{{($val->payment_type)}}</td>
 --}}          </tr>
        @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người nhận
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">

      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên Khách hàng</th>
            
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>ghi chú</th>
            <th>Hình thức thanh toán</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($shipping as $key => $val)

          <tr>
            <td>{{($val->shipping_name)}}</td>
            <td>{{($val->shipping_phone)}}</td>
            <td>{{($val->shipping_address)}}</td>
            
            <td>{{($val->shipping_notes)}}</td>
            <td>{{($val->shipping_method)}}</td>
        @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
<br>
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin đơn hàng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
{{--             <th></th>
 --}}            <th>Tên sản phẩm</th>
            <td>Số lương tồn kho</td>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total=0;
           ?>
          @foreach($order_detail as $key => $val)
          <tr class="color_qty_{{$val->product_id}}">
{{--           <td><img src="{{URL::to('public/upload/product/'.$val->product_image)}}" alt=""style="cursor: zoom-in;" width="60" /></td>
 --}}
            <td>{{($val->product_name)}}
              @if($val->attribute_id!=null)
              <p>Màu sắc: {{($val->product_color)}}</p>
              <p>Dung lượng: {{($val->product_size)}}</p>
              @endif
            </td>
            @if($val->attribute_id!=null)
            @foreach($attribute as $key =>$att)
            @if($att->attribute_id==$val->attribute_id)
            <td>{{($att->attribute_quantity)}}</td>
            <input type="hidden" class="order_qty_storage_{{$val->order_detail_id}}" name="" value="{{($att->attribute_quantity)}}">
            @endif
            @endforeach
            @else
            @foreach($product as $key =>$pro)
            @if($pro->product_id==$val->product_id)
            <td>{{($pro->quantity)}}</td>
            <input type="hidden" class="order_qty_storage_{{$val->order_detail_id}}" name="" value="{{($pro->quantity)}}">
            @endif
            @endforeach
            @endif
            <form>
              @csrf
            <td><input {{$order_status==2||$order_status==4||$order_status==3?'disabled':''}} class="product_sales_quantity_{{$val->order_detail_id}}" type="number" min="1" name="product_sales_quantity" value="{{($val->product_sales_quantity)}}" min="1">
              <input type="hidden" class="order_product_id" name="order_product_id" value="{{$val->product_id}}">
              @if($val->attribute_id)
              <input type="hidden" class="attribute_order" name="attribute_order" value="{{$val->attribute_id}}">
              @endif

{{--               <input type="hidden" class="order_attr_id" name="order_attr_id" value="{{$val->attribute_id}}">
 --}}{{--               <input type="hidden" class="product_sales_quantity"name="product_sales_quantity" value="{{$val->product_sales_quantity}}">
 --}}       @if($order_status!=2 && $order_status!=4 && $order_status!=3)
              <button class="btn btn-info update_quantity_order_detail" data-order_detail_id="{{$val->order_detail_id}}" type="button">Cập nhật</button>
              @endif
            </td>
          </form>
{{--             <td><span class="text-ellipsis">{{($val->product_sales_quantity)}}</span></td>
 --}}       <td><span class="text-ellipsis">{{number_format($val->product_price,0,',','.').'VNĐ'}}</span></td>
       <td><span class="text-ellipsis">{{number_format($val->product_sales_quantity*$val->product_price,0,',','.').'VNĐ'}}</span></td>


            <td>@if($order_status==1)
              	<a onClick="return confirm('Bạn có chắc muốn xóa sản phẩm này này?')" href="{{URL::to('/delete-order-detail/'.$val->order_detail_id)}}" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
                @endif
            </td>
          </tr>
          <?php
          $sobtotal=$val->product_sales_quantity*$val->product_price;
          $total+=$sobtotal;
          
          $coupon_text=$val->coupon_text;

          $order_fee=$val->product_feeship;
          ?>
        @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">Ahii</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
          </ul>
        </div>
      </div>
    </footer>
  </div>
 <p><label>Tổng: {{number_format($total,0,',','.').' VNĐ'}}</label></p>
  <p><label>phí vận chuyển: {{number_format($order_fee,0,',','.').' VNĐ'}}</label></p>
  @if($coupon_text ==null)        
    <p><label>giảm giá: không có</label></p>
    <p><label>Tổng tiền thanh toám: {{number_format($total+$order_fee,0,',','.').' VNĐ'}}</label></p>
    <input type="hidden" class="tong-tien" value="{{$total+$order_fee}}">

  @else

    @if($coupon_condition==1)
      <?php
      $coupon_after=($total*$coupon_number)/100;
      ?>
      <p><label>giảm giá: {{$coupon_number}} %</label></p>
      <p><label>Tổng tiền thanh toám: {{number_format($total+$order_fee-$coupon_after,0,',','.').' VNĐ'}}</label></p>
      <input type="hidden" class="tong-tien" value="{{$total+$order_fee-$coupon_after}}">

    @else
      <?php
      $coupon_after=$total-$coupon_number;
      ?>
      <p><label>giảm giá: {{number_format($coupon_number,0,',','.')}} VMĐ</label></p>

      <p><label>Tổng tiền thanh toám: {{number_format($coupon_after+$order_fee,0,',','.').' VNĐ'}}</label></p>
      <input type="hidden" class="tong-tien" value="{{$coupon_after+$order_fee}}">
    @endif
  @endif

  <br>  @foreach($shipping_detail1 as $key =>$val)
  <td colspan="6">
   <div class="form-group">
  <label for="exampleInputPassword1">trạng thái đơn hàng</label>                      
  <select {{$val->order_status==3?'disabled':''}} class="form-control input-sm m-bot15 order_status" data-order_id="{{$val->order_id}}">
    @if($val->order_status==1)
      <option value="1">Chưa xử lý</option>
}      <option value="2">Đang giao giao hàng</option>
    @elseif($val->order_status==2)
        <option value="2">Đang giao giao hàng</option>
        <option value="4">Đã xử lý</option>
      <option value="1">Chưa xử lý</option>
    @elseif($val->order_status==4)
      <option value="4">Đã xử lý</option>
      <option value="1">Chưa xử lý</option>
      <option value="2">Đang giao giao hàng</option>
    @elseif($val->order_status==3)
      <option value="3">Đơn hàng đã bị hủy</option>
    @endif
  </select>
</div>
</td>
@endforeach
  <a href="{{url('/In-hoa-don/'.$val->order_id)}}">In hóa đơn</a>

</div>
@endsection
