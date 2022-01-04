@extends('layout_Admin')
@section('admin_content')
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
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>

            <th>Tên slider</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Nội dung</th>
            <th>vị trí</th>
            <th>Trang thái</th>
          </tr>
        </thead>
        <tbody >
          @foreach($all_slider as $key => $cate_pro)
          <tr>
            <td>{{($cate_pro->slider_name)}}</td>
            <td><img src="{{URL::to('public/upload/slider/'.$cate_pro->slider_img)}}" style="cursor: zoom-in;" width="150px"/></td>
            <td><span class="text-ellipsis">{{($cate_pro->slider_desc)}}</span></td>

            <td>
              <?php 
              if ($cate_pro->slider_type==0) {
                echo'Đầu trang';
              }
              elseif($cate_pro->slider_type==1){
                echo'Đầu trang bên phải';
              }
              elseif($cate_pro->slider_type==2){
                echo'Giữa trang';
              }
              elseif($cate_pro->slider_type==3){
                echo'Giữa trang bên trái';
              }
              else{
                echo'Giữa trang bên phải';
              }
              ?>
            </td>
            <td><span class="text-ellipsis"><?php 
           if($cate_pro->slider_status==0){
              ?>
              <a href="{{URL::to('/unaction-slider/'.$cate_pro->slider_id)}}">Hiện</a>
              <?php
            }
            else{
            ?>
              <a href="{{URL::to('/action-slider/'.$cate_pro->slider_id)}}">Ẩn</a>
              <?php
            }
            ?></span></td>

            <td>
              <a href="{{URL::to('/edit-slider/'.$cate_pro->slider_id)}}" class="active_styling_edit"><i class="fa fa-cog"></i>
              	<a onClick="return confirm('Bạn có chắc muốn xóa thương hiệu này?')" href="{{URL::to('/delete-slider/'.$cate_pro->slider_id)}}" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
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
{{$all_slider->links()}}
          </ul>
        </div> --}}
      </div>
    </footer>
  </div>
</div>
@endsection