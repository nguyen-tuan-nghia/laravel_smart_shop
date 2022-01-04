@extends('layout_Admin')
@section('admin_content')
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      liệt kê danh mục bài viết
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

            <th>Tên danh mục bài viết</th>
            <th>slug</th>
            <th>Mô tả</th>
            <th>Trang thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_post as $key => $cate_pro)
          <tr>
            <td>{{($cate_pro->category_post_name)}}</td>
            <td><span class="text-ellipsis">{{($cate_pro->category_post_slug)}}</span></td>
            <td>{{$cate_pro->category_post_desc}}</td>
            <td><span class="text-ellipsis"><?php 
           if($cate_pro->category_post_status==0){
              ?>
              <a href="{{URL::to('/unaction-category-post/'.$cate_pro->category_post_id)}}">Hiện</a>
              <?php
            }
            else{
            ?>
              <a href="{{URL::to('/action-category-post/'.$cate_pro->category_post_id)}}">Ẩn</a>
              <?php
            }
            ?>
            <td>
              <a href="{{URL::to('/edit-category-post/'.$cate_pro->category_post_id)}}" class="active_styling_edit"><i class="fa fa-cog"></i>
                <a onClick="return confirm('Bạn có chắc muốn xóa thương hiệu này?')" href="{{URL::to('/delete-category-post/'.$cate_pro->category_post_id)}}" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
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
      </div>
    </footer>
  </div>
</div>
@endsection