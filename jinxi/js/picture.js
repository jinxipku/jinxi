!function($) {
	$(function() {
		var file;
		var file_thumb;
		var erweima = "";
		var baseurl = "http://www.xn--wmqr18c.cn/";

		$("#form_picture_upload").ajaxForm();// ajaxForm()只是绑定表单事件，并不是提交表单。。。
		$("#picture").bind('change', function() {
			// 判断上传格式，判断图片大小好像只能在服务端检测，所以预览图片必须先传上去
			var options = {
				success : showResponse,// 上传成功回调函数
				dataType : 'json'
			};

			$("#form_picture_upload").ajaxSubmit(options);
			$("#file_info").text('正在上传');
			$("#btn_upload_picture").html('<i class="icon-spinner icon-spin"></i> <span>上传中</span>');
			$("#btn_upload_picture").attr('disabled', true);
		});
		$("#btn_upload_picture").click(function() {
			var ie=navigator.appName=="Microsoft Internet Explorer" ? true : false; 
			if(ie){ 
				document.getElementById("picture").click(); 
			}else{
				var a=document.createEvent("MouseEvents");//FF的处理 
				a.initEvent("click", true, true);  
				document.getElementById("picture").dispatchEvent(a); 
			}
		});
		function showResponse(data) {
			$("#btn_upload_picture").html('<span>本地上传图片</span><br/>点击右侧相机可手机上传图片');
			$("#btn_upload_picture").attr('disabled', false);
			$("#file_info").text("支持jpg和png图片格式，大小不要超过2M。");
			if (data.status == 0) {
				if (data.data == 'The filetype you are attempting to upload is not allowed.')
					$("#file_info").text('您上传的图片格式不符合要求，请重新上传。');
				else if (data.data == 'The uploaded file exceeds the maximum allowed size in your PHP configuration file.')
					$("#file_info").text('您上传的图片大小超过了2M，请重新上传。');
				else
					$("#file_info").text(data.data + "点击左侧相机图片可进行手机拍照上传。");
				return;
			}
			file = data.data.file_name;
			file_thumb = data.data.file_name_thumb;
			addView(file, file_thumb);
			
		};
		$("div#newpost_picture>div.post_img>div:nth-child(1)").bind('click', function() {
			//获取二维码
			$("#img_erweima").attr("src", baseurl + "img/info/success.png");
			$("div#newpost_picture>div.post_img>div:nth-child(1)").fadeOut(500, function() {
				$("div#newpost_picture>div.post_img>div:nth-child(2)").fadeIn(500, function() {
					$("#btn_mobile_picture").fadeIn(500);
					$("#btn_upload_picture").html('<span>本地上传图片</span>');
				});

			});

		});
		function addView(file, file_thumb) {
			var index = $("div#preview_boxes>div").length;

			var preview_box = $("<div></div>");
			preview_box.addClass("preview_box");
			preview_box.css("display", "none");

			var div1 = $("<div></div>");
			var div2 = $("<div></div>");
			var picture = $("<img>");
			picture.addClass("passive");
			picture.attr("src", file_thumb);
			picture.attr("alt", file);
			div1.append(picture);
			var preview_p = $("<p></p>");
			preview_p.text("点击预览");
			div1.append(preview_p);
			div1.click(function() {
				$("#big_picture_view").attr("src", file);
				$("#picture_modal").modal();
			});
			preview_box.append(div1);

			var textarea = $("<textarea></textarea");
			textarea.addClass("form-control flat");
			textarea.attr("rows", "4");
			textarea.attr("placeholder", "请填写图片描述");
			textarea.attr("maxlength", "30");
			div2.append(textarea);
			var label = $("<label></label>");
			label.addClass("radio");
			if (index == 0)
				label.addClass("checked");
			var input = $("<input>");
			input.attr("type", "radio");
			input.attr("name", "first_picture");
			input.attr("data-toggle", "radio");
			if (index == 0)
				input.attr("checked", true);
			input.val(index + 1);
			label.append(input);
			label.append("设为首图");
			div2.append(label);
			var button = $("<button></button>");
			button.attr("type", "button");
			button.addClass("btn btn-default");
			button.html('删除<span class="fui-cross"></span>');
			button.click(function() {
				$.post(
					"http://www.xn--wmqr18c.cn/post/delete_picture",
					{
						picture_url: file + "," + file_thumb,
					},
					function(res) {
						if(res.status == 0) {
							alert("删除失败！");
						}
		  			},
		  			'json'
		  		);
		  		preview_box.slideUp(500, function() {
					preview_box.remove();
					if ($("div#preview_boxes>div").length > 0) {
						$("#preview_boxes>div:nth-child(1)>div>label").addClass("checked");
						$("#preview_boxes>div:nth-child(1)>div>label input").attr("checked", true);
					}
				});
			});
			div2.append(button);
			preview_box.append(div2);

			$("#preview_boxes").append(preview_box);
			$(':radio').radio();
			preview_box.slideDown(500);
			$("#picture").val("");
		}
		$("#btn_mobile_picture").bind('click', function() {
			//展示手机图片
		});
		window.onbeforeunload = function() {
			$.post(
				baseurl + "post/delete_picture",
				{
					picture_url: $("#preview_boxes>div img").attr("alt"),
					timespec: $("#form_picture_upload").attr("name")
				},
				function(res) {
					if(res.status == 0) {
						alert("删除失败！");
					}
	  			},
	  			'json'
	  		);
	  		alert($("#form_picture_upload").attr("name"));
	  		alert($("#preview_boxes>div img").attr("alt"));
		} 
	});
}(window.jQuery)