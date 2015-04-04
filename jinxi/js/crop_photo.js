!function($) {
	$(function() {
		var truewidth;
		var trueheight;
		var file;
		$("#form_photo").ajaxForm();// ajaxForm()只是绑定表单事件，并不是提交表单。。。
		$("#save_photo").ajaxForm();// ajaxForm()只是绑定表单事件，并不是提交表单。。。
		$("#btn_upload_head").click(function() {
			if ($("#head_image").val() == '') {
				$("#file_info").html('请先选择一张图片！支持gif、jpg、png图片格式，大小不要超过2M');
				return;
			}
			// 判断上传格式，判断图片大小好像只能在服务端检测，所以预览图片必须先传上去
			var options = {
				success : showResponse,// 上传成功回调函数
				dataType : 'json'
			};

			$("#form_photo").ajaxSubmit(options);
			$("#file_info").html('正在上传');
			$("#btn_upload_head").html('<i class="icon-spinner icon-spin"></i> 上传中');
			$("#btn_upload_head").attr('disabled', true);
		});
		function showResponse(data) {
			$("#btn_upload_head").html('上 传');
			$("#btn_upload_head").attr('disabled', false);
			if (data.status == 0) {
				if (data.data == 'The filetype you are attempting to upload is not allowed.')
					$("#file_info").html('您上传的图片格式不符合要求，请重新上传。');
				else if (data.data == 'The uploaded file exceeds the maximum allowed size in your PHP configuration file.')
					$("#file_info").html('您上传的图片大小超过了2M，请重新上传。');
				else
					$("#file_info").html(data.data);
				return;
			}
			truewidth = data.data.image_width;
			trueheight = data.data.image_height;
			file = data.data.file_name;
			$("#file_name").val(file);
			$("#file_info").html('上传成功，请截取你喜欢的部分并点击"保存"按钮。');
			$img4cut = '<div><img class="img4cut" style="width: 292px;" id="jcrop_photo" alt="" src="http://www.xn--wmqr18c.cn/img/head/'
					+ file + '" />';
			$img4disp = '<div id="view_img_box" class="panel panel-default"><img class="img4cut" id="preview_photo" alt="" src="http://www.xn--wmqr18c.cn/img/head/'
					+ file
					+ '" /></div><div><button id="btn_save_head" type="button" class="btn btn-primary btn-lg">保 存</button><button id="btn_cancel_head" type="button" class="btn btn-default btn-lg">取 消</button></div></div>';
			$("#show_head").html(
					'<p class="help-block">头像截取（右侧预览）</p>' + $img4cut + $img4disp);
			// 现在开始准备
			init_photo();// 初始化jcrop
			$("html,body").animate({
				scrollTop : 395
			}, 700);
			$("#btn_save_head").click(function() {
				$("#btn_save_head").html('<i class="icon-spinner icon-spin"></i> 保存中');
				$("#btn_save_head").attr('disabled', true);
				var options = {
					success : saveResponse,// 上传成功回调函数
					dataType : 'json'
				};

				$("#save_photo").ajaxSubmit(options);
			});
			$("#btn_cancel_head").click(function() {
				$.post(
					'http://www.xn--wmqr18c.cn/user/delete_file/' + file,
					function(){
						window.location.href = "http://www.xn--wmqr18c.cn/user/setup/2";
					}
				);
				window.onbeforeunload = function() { 
				} 
			});
			window.onbeforeunload = function() {
				$.post('http://www.xn--wmqr18c.cn/user/delete_file/' + file);
			} 
		}
		function saveResponse(data) {
			window.onbeforeunload = function() { 
			}
			if (data.status == 1) {
				$("#info_modal").find('.modal-title').text("设置成功");
				$("#info_modal").find('.modal-cont').text("恭喜，头像设置成功！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					window.location.href = "http://www.xn--wmqr18c.cn/user/setup/2";
				});
				$("#info_modal").modal();
			} else {
				$("#info_modal").find('.modal-title').text("设置失败");
				$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					window.location.href = "http://www.xn--wmqr18c.cn/user/setup/2";
				});
				$("#info_modal").modal();
			}
		}
		var photo_width = 292;// 设置显示预览图片的最大尺寸
		var photo_height =  Math.round(292*trueheight/truewidth);
		function init_photo() {
			var k = 0;// 记录图片伸缩比例
			var screen_img = $("#jcrop_photo");// 通过new_img获取ajax加载的图片
			var new_img = new Image(); // 直接获取ajax加载图片的尺寸有问题
			new_img.src = screen_img.attr("src");// 反正我是这样才获得了真实的尺寸
			setTimeout(function() { // 由于图片加载时间，可能要通过
				// 挂起一段时间后才能读取图片尺寸
				k = new_img.width / 292;
				$("#p_k").val(k); // 将伸缩比例传给hidden表单
				$('#jcrop_photo').Jcrop({
					onChange : show_preview,// 剪切预览图 //这时候图片的DOM才被获取，不要在
					onSelect : show_preview, // ready的时候绑定，也不要jquery添
					minSize : [ 50, 50 ],
					aspectRatio : 1, // 选中区域宽高比为1，即选中区域为正方形
					setSelect : [ 100, 100, 200, 200 ]
				// 初始化选中区域
				});
			}, 100);
		}
		function show_preview(coords) { // 显示剪切后图片预览
			if (parseInt(coords.w) > 0) {
				var i_k = 200 / coords.w; // 146为设置的预览图区域大小
				$("#preview_photo").css({
					"height" : (i_k * photo_height) + 'px', // Jcrop官方文档中给出的是
					"width" : (i_k * photo_width) + 'px', // 指定的图片长宽，这也就是
					"marginLeft" : '-' + (i_k * coords.x) + 'px', // 为什么要获得真实图片尺寸
					"marginTop" : '-' + (i_k * coords.y) + 'px',// 的原因，具体图片原理见后文
				}).show();
				$("#p_x").val(coords.x);// 将剪切位置传给hidden表单
				$("#p_y").val(coords.y);
				$("#p_h").val(coords.h);
				$("#p_w").val(coords.w);
			}
		}
	});
}(window.jQuery)