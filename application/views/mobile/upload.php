<!DOCTYPE html>
<html>
<body>
	{$test}
	<p id="cc">123</p>
	<form id="form_photo" name="form_photo" action="{$baseurl}post/mobile_upload" enctype="multipart/form-data" accept-charset="utf-8" method="post">
		<div class="form-group">
			<input type="file" id="head_image" name="head_image">
			<p id="file_info" class="help-block">支持gif、jpg、png图片格式，大小不要超过2M</p>
		</div>
		<button id="btn_upload" type="button" class="btn btn-primary btn-lg">上 传</button>
	</form>

	<input type="file" />
	<script src="{$baseurl}js/jquery.js"></script>
	<script src="{$baseurl}js/bootstrap.js"></script>
	<script>
		alert($("#cc").html());
		
		$("#btn_upload").click(function() {
			alert("CC");
			// if ($("#head_image").val() == '') {
			// 	$("#file_info").html('请先选择一张图片！支持gif、jpg、png图片格式，大小不要超过2M');
			// 	return;
			// }
			// // 判断上传格式，判断图片大小好像只能在服务端检测，所以预览图片必须先传上去
			// var options = {
			// 	success : showResponse,// 上传成功回调函数
			// 	dataType : 'json'
			// };

			// $("#form_photo").ajaxSubmit(options);
			// $("#file_info").html('正在上传');
			// $("#btn_upload_head").html('<i class="icon-spinner icon-spin"></i> 上传中');
			// //$("#btn_upload_head").attr('disabled', true);
		});
		function showResponse(){

		}
	</script>
</body>

</html>