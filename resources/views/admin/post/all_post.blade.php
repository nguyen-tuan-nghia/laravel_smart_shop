@extends('layout_Admin')
@section('admin_content')
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      liệt kê bài viết
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
            <th>Ảnh</th>
            <th>Tên bài viết</th>
            <th>slug</th>
            <th>từ khóa</th>
            <th>Tác giả</th>
            <th>Danh mục</th>
            <th>ngày viết</th>
            <th>Trang thái</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_post as $key => $pro)
          <tr>
            <td><img src="{{URL::to('public/upload/post/'.$pro->post_img)}}" style="cursor: zoom-in;" width="60"/></td>            
            <td>{{$pro->post_title}}</td>

            <td><span class="text-ellipsis">{{($pro->post_slug)}}</span></td>
            <td>{{$pro->post_keywwords}}</td>

            <td>{{$pro->admin->admin_name}}</td>
            <td>{{$pro->category_post->category_post_name}}</td>
            <td>{{$pro->created_at}}</td>
            <td><span class="text-ellipsis"><?php 
           if($pro->post_status==0){
              ?>
              <a href="{{URL::to('/unaction-post/'.$pro->post_id)}}">Hiện</a>
              <?php
            }
            else{
            ?>
              <a href="{{URL::to('/action-post/'.$pro->post_id)}}">Ẩn</a>
              <?php
            }
            ?>
            <td>
              <a href="{{URL::to('/edit-post/'.$pro->post_id)}}" class="active_styling_edit"><i class="fa fa-cog"></i>
                <a onClick="return confirm('Bạn có chắc muốn xóa thương hiệu này?')" href="{{URL::to('/delete-post/'.$pro->post_id)}}" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
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