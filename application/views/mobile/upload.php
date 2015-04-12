<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="jinxi">
	<meta name="author" content="jinxi">
	<link rel="shortcut icon" href="{$baseurl}img/icon/icon.png">
	<title>{$title}</title> 
	<link href="{$baseurl}css/bootstrap.css" rel="stylesheet"/>
	<link href="{$baseurl}css/flat-ui.css" rel="stylesheet"/>
	<style type="text/css">
		html,body{ 
			margin:0px; 
			height:100%; 
		} 
		#upload_btn{
			background: #1abc9c;
			height:100%;
			position: absolute;
			font-size:9em;
		}
		#form_picture{
			text-align: center;
			position: relative;
			width: 100%;
			height: 100%;
			background: #CCCCCC;
			font-family: Microsoft Yahei, "Helvetica Neue", Helvetica, Arial, sans-serif;
		}

	</style>
</head>
<body>

	<form id="form_picture" name="form_picture" action="{$baseurl}post/upload_picture" enctype="multipart/form-data" accept-charset="utf-8" method="post">
		<input type="file" id="picture" name="picture" style="display:none" />
		<button type="button" id="upload_btn" class="btn btn-lg btn-primary btn-block" onclick="javascript:openBrowse();">点此上传</button>
		<!-- <p id="file_info" class="help-block">支持gif、jpg、png图片格式，大小不要超过2M</p> -->
		<input type="hidden" name="timespec" id="timespec" value="{$timespec}">
		<input type="hidden" name="user_id" id="user_id" value="{$user_id}">
		<input type="hidden" name="from" value="mobile">
<!-- 		<button id="btn_upload" type="button" class="btn btn-primary btn-lg">上 传</button> -->
	</form>
	<script src="{$baseurl}js/jquery.js"></script>
	<script src="{$baseurl}js/jquery.form.js"></script>
	<script type="text/javascript">

		$("#picture").change(function(){
			if ($("#picture").val() == '') {
				$("#file_info").html('请先选择一张图片！支持gif、jpg、png图片格式，大小不要超过2M');
				return;
			}
			// 判断上传格式，判断图片大小好像只能在服务端检测，所以预览图片必须先传上去
			$("#upload_btn").attr('disabled',true);
			$("#upload_btn").html('<i class="icon-spinner icon-spin"></i> 上传中');
			var options = {
				success : showResponse,// 上传成功回调函数
				error : showError,
				dataType : 'json'
			};

			$("#form_picture").ajaxSubmit(options);
			
		});
		function showResponse(data){
			$("#upload_btn").attr('disabled',false);
			$("#upload_btn").css('font-size','6em');
			$("#upload_btn").html('上传成功<br>继续上传或回电脑预览');
		}
		function showError(data){
			$("#upload_btn").attr('disabled',false);
			$("#upload_btn").css('font-size','6em');
			$("#upload_btn").html('上传失败<br>继续上传或回电脑预览');
		}
		function openBrowse(){ 
			var ie=navigator.appName=="Microsoft Internet Explorer" ? true : false; 
			if(ie){ 
				document.getElementById("picture").click(); 
			}else{
				var a=document.createEvent("MouseEvents");//FF的处理 
				a.initEvent("click", true, true);  
				document.getElementById("picture").dispatchEvent(a); 
			} 
		} 
	</script>
</body>

</html>