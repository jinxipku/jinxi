<!DOCTYPE html>
<html>
<body>

	<form id="form_picture" name="form_picture" action="{$baseurl}post/upload_picture" enctype="multipart/form-data" accept-charset="utf-8" method="post">
		<div class="form-group">
			<input type="file" id="picture" name="picture">
			<p id="file_info" class="help-block">支持gif、jpg、png图片格式，大小不要超过2M</p>
			<input type="hidden" name="timespec" id="timespec" value="{$timespec}">
			<input type="hidden" name="user_id" id="user_id" value="{$user_id}">
			<input type="hidden" name="from" value="mobile">
		</div>
		<button id="btn_upload" type="button" class="btn btn-primary btn-lg">上 传</button>
	</form>

	<script src="{$baseurl}js/jquery.js"></script>
	<script src="{$baseurl}js/bootstrap.js"></script>
	<script src="{$baseurl}js/jquery.form.js"></script>
	<script>
		function showResponse(data){

		}
		
		$("#btn_upload").click(function() {
			alert("click");
			if ($("#picture").val() == '') {
				$("#file_info").html('请先选择一张图片！支持gif、jpg、png图片格式，大小不要超过2M');
				return;
			}
			// 判断上传格式，判断图片大小好像只能在服务端检测，所以预览图片必须先传上去
			var options = {
				success : showResponse,// 上传成功回调函数
				dataType : 'json'
			};

			$("#form_picture").ajaxSubmit(options);
			$("#file_info").html('正在上传');
			//$("#btn_upload").html('<i class="icon-spinner icon-spin"></i> 上传中');
			//$("#btn_upload").attr('disabled', true);
		});
		
	</script>
</body>

</html>