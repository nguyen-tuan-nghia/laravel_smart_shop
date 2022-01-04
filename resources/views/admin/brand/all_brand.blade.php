@extends('layout_Admin')
@section('admin_content')
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thương hiệu sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
{{--         <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>   --}}              
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
{{--       <input class="form-control" id="myInput" type="text" placeholder="Search..">
 --}}
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>

            
            <th>Tên thương hiệu</th>
            <th>slug</th>
            <th>Trạng thái</th>
            <th>Ngày thêm</th>
            <th>Ngày sửa</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody >
          @foreach($all_brand as $key => $cate_pro)
          <tr>
            <td>{{($cate_pro->brand_name)}}</td>
            <td>{{($cate_pro->brand_slug)}}</td>
            <td><span class="text-ellipsis"><?php 
           if($cate_pro->brand_status==0){
              ?>
              <a href="{{URL::to('/unaction-brand/'.$cate_pro->brand_id)}}">Hiện</a>
              <?php
            }
            else{
            ?>
              <a href="{{URL::to('/action-brand/'.$cate_pro->brand_id)}}">Ẩn</a>
              <?php
            }
            ?></span></td>
            <td><span class="text-ellipsis">{{($cate_pro->created_at)}}</span></td>
            <td><span class="text-ellipsis">{{($cate_pro->updated_at)}}</span></td>

            <td>
              <a href="{{URL::to('/edit-brand/'.$cate_pro->brand_id)}}" class="active_styling_edit"><i class="fa fa-cog"></i>
              	<a onClick="return confirm('Bạn có chắc muốn xóa thương hiệu này?')" href="{{URL::to('/delete-brand/'.$cate_pro->brand_id)}}" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
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