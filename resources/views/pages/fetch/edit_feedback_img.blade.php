<div class="row">
@foreach($feedback_img as $key =>$val)
<div class="col-sm-2" id="edit_feedback_img{{$val->feedback_img_id}}">
	<img style="height: 70px" src="{{asset('public/upload/coment_img/'.$val->feedback_name)}}">
<p><a  href="javascript:void(0)" onclick="xoa_feedback_img({{$val->feedback_img_id}})">Xóa</a></p>
</div>
@endforeach
</div>
<script type="text/javascript">
	function xoa_feedback_img(id){
		$.ajax({
			url:"{{url('/delete-feedback-img')}}/"+id,
			method:"get",
			success:function(data){
				$('#edit_feedback_img'+id).remove();
				fetch_feedback_edit();
			}
		});
	}
</script>