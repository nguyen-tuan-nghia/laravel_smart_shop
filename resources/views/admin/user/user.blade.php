@extends('layout_Admin')
@section('admin_content')
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      liệt kê người dùng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">          
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">

        <form action="" method="GET">
    <input type="text" placeholder="Search" name="Search"/>
    <button class="btn btn-sm btn-default"  type="submit">tìm kiếm</button>
</form>
      </div>
    </div>            


    <div class="table-responsive">
      <table class="table table-striped b-t b-light" {{-- id="myTable" --}}>
        <thead>
          <tr>
          
            <th>Tên user</th>
            <th>Email</th>
            <th>Phone</th>
{{--             <th>Password</th>
 --}}            <th>Author</th>
            <th>Admin</th>
            <th>reply</th>
		<th style="width:100px;"></th>

          </tr>
        </thead>
        <tbody>
          @foreach($admin as $key => $user)                   
          <form action="{{url('/assign-roles')}}" method="POST">

              @csrf

              <tr>
               
                <td>{{ $user->admin_name }}</td>
                <td>
                  {{ $user->admin_email }} 
                  <input type="hidden" name="admin_email" value="{{ $user->admin_email }}">
                  <input type="hidden" name="admin_id" value="{{ $user->admin_id }}">
                </td>
                <td>{{ $user->admin_phone }}</td>
{{--                 <td>{{ $user->admin_password }}</td>
 --}}
                <td><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="admin_role"  {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="reply_role"  {{$user->hasRole('reply') ? 'checked' : ''}}></td>
             
              <td>
                  
                    
                 <p><input type="submit" value="Phân quyền" class="btn btn-sm btn-default"></p>
                 <p><a style="margin:5px 0;" class="btn btn-sm btn-danger" onClick="return confirm('Bạn có chắc muốn xóa người dùng này?')" href="{{url('/delete-user-roles/'.$user->admin_id)}}">Xóa user</a></p>                
              </td> 

              </tr>
            </form>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm"></small>

        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
          	{{$admin->links()}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection