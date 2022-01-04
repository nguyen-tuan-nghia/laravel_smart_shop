@extends('layout_Admin')
@section('admin_content')
@csrf

		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      liệt kê sản phẩm
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
      </div>
    </div>
        <div id="chart_product" style="height: 350px"></div>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Thuộc tính</th>
            <th>Thư viện ảnh</th>
            <th>slug</th>
            <th>Số lượng</th>
            <th>Giá vốn</th>
            <th>Giá bán</th>
            <th>Thương hiệu</th>
            <th>Danh mục sản phẩm</th>
            <th>Trang thái</th>
            <th>Ngày thêm</th>
{{--             <th>Ngày sửa</th>
 --}}            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $cate_pro)
          <tr>
            <td>{{($cate_pro->product_id)}}</td>
            <td>{{($cate_pro->product_name)}}</td>
            <td><img src="{{URL::to('public/upload/product/'.$cate_pro->product_image)}}" style="cursor: zoom-in;" width="60"/></td>
            <td><a href="{{URL::to('thuoc-tinh/'.$cate_pro->product_id)}}">Thuộc tính sản phẩm</a></td>

            <td><a href="{{url::to('add-gallery/'.$cate_pro->product_id)}}">Thêm thư viện ảnh</a></td>
            <td><span class="text-ellipsis">{{($cate_pro->product_slug)}}</span></td>
            <td><span class="text-ellipsis">{{($cate_pro->quantity)}}</span></td>
            <td><span class="text-ellipsis">{{number_format($cate_pro->import_price,0,',','.').'VNĐ'}}</span></td>
       <td><span class="text-ellipsis">{{number_format($cate_pro->product_price,0,',','.').'VNĐ'}}</span></td>
            <td><span class="text-ellipsis">{{($cate_pro->brand_name)}}</span></td>
            <td><span class="text-ellipsis">{{($cate_pro->category_name)}}</span></td>


            <td><span class="text-ellipsis"><?php 
           if($cate_pro->product_status==0){
              ?>
              <a href="{{URL::to('/unaction-product/'.$cate_pro->product_id)}}">Hiện</a>
              <?php
            }
            else{
            ?>
              <a href="{{URL::to('/action-product/'.$cate_pro->product_id)}}">Ẩn</a>
              <?php
            }
            ?></span></td>
            <td><span class="text-ellipsis">{{($cate_pro->created_at)}}</span></td>
{{--             <td><span class="text-ellipsis">{{($cate_pro->updated_at)}}</span></td>
 --}}
            <td>
              <a href="{{URL::to('/edit-product/'.$cate_pro->product_id)}}" class="active_styling_edit"><i class="fa fa-cog"></i>
              	<a onClick="return confirm('Bạn có chắc muốn xóa thương hiệu này?')" href="{{URL::to('/delete-product/'.$cate_pro->product_id)}}" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
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
{{$all_product->links()}}
          </ul>
        </div> --}}
       <form action="{{url('/export-csv')}}" method="POST">
          @csrf
       <input type="submit" value="Export CSV" name="export_csv" class="btn btn-success">
      </form>
      </div>
    </footer>
  </div>
</div>

@endsection
