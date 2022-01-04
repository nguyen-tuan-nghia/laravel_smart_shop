
@extends('layout_Admin')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thông tin sản phẩm
                        </header>
    @if (count($errors) > 0)
      <div class="alert alert-danger">
          Thông tin không đầy đủ, bạn cần chỉnh sửa như sau:
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
                        <div class="panel-body">
                            @foreach($all_product as $key=>$edit)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/insert-attr-product/'.$edit->product_id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" id="product_id" value="{{$edit->product_id}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" disabled="" value="{{($edit->product_name)}}" name="product_name" placeholder="Tên sản phẩm" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá bán trong kho: {{number_format($edit->product_price,0,',','.')}}VNĐ - Số lượng tồn: {{$edit->quantity}} chiếc</label>
                                </div>
                                    <label for="exampleInputEmail1">Thuộc tính (tối đa 5)</label>
                                <div class="field_wrapper">
                                        <div>
                                            <div style="width: 25%;float: left">Màu sắc
                                            <input type="text" class="form-control" name="color[]" value="" placeholder="color" required="" /></div>
                                            <div style="width: 25%;float: left">Dung lượng
                                                <input type="text" class="form-control" name="size[]" value="" placeholder="size" required="" /></div>
                                            <div style="width: 25%;float: left">Số lượng
                                                <input type="number" class="form-control" name="quantity[]" value="" placeholder="size" required="" /></div>
                                            <div style="width: 25%;float: left">Giá
                                                <input type="text" class="form-control price_format" name="price[]" value="" placeholder="giá" required="" /></div>
                                            <a href="javascript:void(0);" class="add_button" title="Add field">Thêm</a>
                                        </div>

                                    </div>
                                @endforeach
                                <div class="clearfix"></div>
                                <br/>
                                <button type="submit" class="btn btn-info">Thêm</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
        </div>
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      liệt kê thuộc tính
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
            <th>Màu sắc</th>
            <th>Dung lượng</th>
            <th>số lượng</th>
            <th>Gía</th>
            <th>Chức năng</th>
          </tr>
        </thead>
        <tbody>
            @foreach($attr as $key =>$attr)
          <tr id="load_atrribute{{$attr->attribute_id}}">
            <td>{{$attr->attribute_color}}</td>
            <td>{{$attr->attribute_size}}</td>
            <td>{{$attr->attribute_quantity}}</td>
            <td>{{number_format($attr->attribute_price,0,',','.')}}VNĐ</td>
            <td>
              <a href="javascript::void(0)" class="active_styling_edit" onclick="edit_attr({{$attr->attribute_id}})"><i class="fa fa-cog"></i></a>
                <a onClick="return confirm('Bạn có chắc muốn xóa thương hiệu này?')" href="{{URL::to('/delete-attribute/'.$attr->attribute_id)}}" class="active_styling_edit"><i class="fa fa-times text-danger text"></i></a>
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

<div class="modal fade" id="edit_attr_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sửa thuộc tính sản phẩm :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_eđit_attr">
            @csrf
            <input type="hidden" name="" id="edit_attr_id" value="">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Màu sắc:</label>
            <input type="text" class="form-control" name="color" id="edit_attr_color" required="">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">dung lượng:</label>
            <input type="text" class="form-control" name="size" id="edit_attr_size" required="">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Số lượng:</label>
            <input type="number" class="form-control" name="quantity" id="edit_attr_quantity" required="">
            <div id="error" style="color: red"></div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Giá:</label>
            <input type="text" class="form-control price_format" name="price" id="edit_attr_price" required="">
          </div>
        <button type="submit" class="btn btn-primary" id="update_attribute">Lưu</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
        </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input  class="form-control" style="width: 25%;float: left" type="text" name="color[]" value="" required=""/><input  class="form-control" style="width: 25%;float: left" type="text" name="size[]" value="" required=""/><input  class="form-control" style="width: 25%;float: left" type="number" name="quantity[]" value="" required=""/><input  class="form-control price_format" style="width: 25%;float: left" type="text" name="price[]" value="" required=""/><a href="javascript:void(0);" class="remove_button_attr">Xóa</a></div>'; //New input field html //New input field html 
    var x = 1; //Initial field counter is 1
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_attr', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script type="text/javascript">
    function edit_attr(id) {
        $('#edit_attr_modal').modal('show');
        $.get("{{url('/attribute-edit')}}/"+id,function(data){
            $('#edit_attr_color').val(data.attribute_color);
            $('#edit_attr_size').val(data.attribute_size);
            $('#edit_attr_price').val(data.attribute_price);
            $('#edit_attr_quantity').val(data.attribute_quantity);
            $('#edit_attr_id').val(data.attribute_id);
        })
    }
</script>
{{-- <script type="text/javascript">
    $(document).ready(function() {
                $("#form_eđit_attr").validate({
                    onfocusout: false,
                    onkeyup: false,
                    onclick: false,
                    rules: {
                    "color":{required:true},
                    "size":{required:true},
                    "price":{required:true},
                    "quantity":{required:true}
                },
                messages: {
                    "color":{required: "Bạn chưa điền màu sắc"},
                    "size":{required: "Bạn chưa điền dung luọng"},
                    "price":{required: "Bạn chưa điền giá"},
                    "quantity":{required: "Bạn chưa điền số lượng"}
                }
            });
    });
</script> --}}
<script type="text/javascript">
$(document).ready(function(){
    $("#form_eđit_attr").submit(function(e){
    e.preventDefault();
    var color=$('#edit_attr_color').val();
    var size=$('#edit_attr_size').val();
    var price=$('#edit_attr_price').val();
    var quantity= $('#edit_attr_quantity').val();
    var _token=$('input[name="_token"]').val();
    var product_id=$('#product_id').val();
    var attribute_id= $('#edit_attr_id').val();

    $.ajax({
        url:"{{url('/update-attribute')}}",
        method:"post",
        data:{product_id:product_id,attribute_id:attribute_id,quantity:quantity,color:color,quantity:quantity,size:size,price:price,_token:_token},
        success:function(data){
            $('#load_atrribute'+data.attribute_id +' td:nth-child(1)').text(data.attribute_color);
            $('#load_atrribute'+data.attribute_id +' td:nth-child(2)').text(data.attribute_size);
            $('#load_atrribute'+data.attribute_id +' td:nth-child(3)').text(data.attribute_quantity);
            $('#load_atrribute'+data.attribute_id +' td:nth-child(4)').html(data.attribute_price);
            $('#edit_attr_modal').modal('hide');
         }
    ,error:function(data){
            $('#error').show();
            $('#error').text("Đã vượt quá số lượng cho phép").slideUp(1500);
    }
    });
        });});
</script>