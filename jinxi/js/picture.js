var imgnum = 0;
$("#picform1").ajaxForm();// ajaxForm()只是绑定表单事件，并不是提交表单。。。
$("#picform2").ajaxForm();// ajaxForm()只是绑定表单事件，并不是提交表单。。。
$("#picform3").ajaxForm();// ajaxForm()只是绑定表单事件，并不是提交表单。。。
function ulpicture() {
	var options = {
		success : showResponse1,// 上传成功回调函数
	};
	if ($("#image1").val() != '')
		$("#picform1").ajaxSubmit(options);
	else
		showResponse1('none');
	$("#pictureinfo0").html('<i class="icon-spinner icon-spin"></i> 正在上传图片');
}
function showResponse1(data) {
	if (data != 'success!' && data != 'none' ) {
		if (data == 'The filetype you are attempting to upload is not allowed.')
			data = '您上传的图片1格式不符合要求，请重新上传。';
		else if (data == 'The uploaded file exceeds the maximum allowed size in your PHP configuration file.')
			data = '您上传的图片1大小超过了2M，请重新上传。';
		$("#pictureinfo1").html(data);
		$("#pictureinfo0")
				.html(
						'<button id="ulpicture" type="button" class="btn btn-primary btn-hg btn-wide" onclick="ulpicture()">完成发布</button>');
		imgnum = 0;
		return;
	} else {
		if (data != 'none')
			imgnum += 1;
		$("#pictureinfo1").html('');
		var options = {
			success : showResponse2,// 上传成功回调函数
		};
		if ($("#image2").val() != '')
			$("#picform2").ajaxSubmit(options);
		else
			showResponse2('none');
	}
}
function showResponse2(data) {
	if (data != 'success!' && data != 'none') {
		if (data == 'The filetype you are attempting to upload is not allowed.')
			data = '您上传的图片2格式不符合要求，请重新上传。';
		else if (data == 'The uploaded file exceeds the maximum allowed size in your PHP configuration file.')
			data = '您上传的图片2大小超过了2M，请重新上传。';
		$("#pictureinfo2").html(data);
		$("#pictureinfo0")
				.html(
						'<button id="ulpicture" type="button" class="btn btn-primary btn-hg btn-wide" onclick="ulpicture()">完成发布</button>');
		imgnum = 0;
		return;
	} else {
		if (data != 'none')
			imgnum += 2;
		$("#pictureinfo2").html('');
		var options = {
			success : showResponse3,// 上传成功回调函数
		};
		if ($("#image3").val() != '')
			$("#picform3").ajaxSubmit(options);
		else
			showResponse3('none');
	}
}
function showResponse3(data) {
	if (data != 'success!' && data != 'none') {
		if (data == 'The filetype you are attempting to upload is not allowed.')
			data = '您上传的图片3格式不符合要求，请重新上传。';
		else if (data == 'The uploaded file exceeds the maximum allowed size in your PHP configuration file.')
			data = '您上传的图片3大小超过了2M，请重新上传。';
		$("#pictureinfo3").html(data);
		$("#pictureinfo0")
				.html(
						'<button id="ulpicture" type="button" class="btn btn-primary btn-hg btn-wide" onclick="ulpicture()">完成发布</button>');
		imgnum = 0;
		return;
	} else {
		if (data != 'none')
			imgnum += 4;
		$("#pictureinfo3").html('');
		window.location.href = "http://xn--wmqr18c.cn/item/newpost/complete/"+imgnum;
	}
}