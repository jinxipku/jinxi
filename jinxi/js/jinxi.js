var baseurl = "http://www.xn--wmqr18c.cn/";
$(document).ready( function() {
	$(".carousel").carousel();
	$(".ellipsis").ellipsis();
	$(':radio').radio();
	$("#password").keydown(function(){
		if(event.keyCode==13){
			var url = window.location.href;
			if(url.indexOf("account/login")<0)
				login(baseurl);
			else{
				$.post(baseurl + "ajax/get_mem_url",function(str){
					login(str);
				});
			}
		}
	});
	if ($("#user_tabs").val() != undefined) {
		$.post(
			baseurl + "user/show_user_page",
			{
				tab_id: '#user_post',
				user_id: $("#user_id").val(),
				page: 1
			},
			function(gethtml) {
        		$('#user_post').html(gethtml);
        		$("div#user_panels img.lazy").lazyload({effect: "fadeIn"});
			}
		);
		$('#user_post').html('<div class="user_tab_header panel panel-default"><center><i class="icon-spinner icon-spin"></i> 正在加载</center></div>');
	}
	$("img.lazy").lazyload({effect: "fadeIn"});
});
$(window).bind('scroll', function() {
	$(this).scrollTop() > 510 + head_height ? $("#back_to_top").fadeIn(500) : $("#back_to_top").fadeOut(500);
	if ($("#post_contact").val() != undefined) {
		if ($(this).scrollTop() > $("#post_contact").offset().top) {
			$("#side_view_box").fadeIn(500);
			$("#side_view_box").css("position", "fixed");
		} else {
			$("#side_view_box").fadeOut(500);
		}
	}
});
$("input#qq,input#weixin,input#phone").bind('blur', function() {
	if ($(this).val().length == 0) {
		$(this).val("未填写");
	}
});
$("textarea#signature").bind('blur', function() {
	if ($(this).val().length == 0) {
		$(this).val("我是一只快乐的今昔兔~");
	}
});
$("input#nick").bind('blur', function() {
	if ($(this).val().length == 0) {
		$(this).val("今昔兔");
	}
});
$("input#qq,input#weixin,input#phone").bind('focus', function() {
	if ($(this).val() == "未填写") {
		$(this).val("");
	}
});
$('#choose_school').on('hidden.bs.modal', function () {
	$('#school').attr('disabled', false);
});
$("input").bind('blur', function() {
	if ($(this).attr("id") == "school" || $(this).val().length > 0) {
		$(this).removeClass("flat");
	}
	else {
		$(this).addClass("flat");
	}
});
$("textarea").bind('blur', function() {
	if ($(this).val().length > 0) {
		$(this).removeClass("flat");
	}
	else {
		$(this).addClass("flat");
	}
});
$("button.btn1_post_item").bind('click', function() {
	var thisbtn = $(this);
	$("#info_modal").find('.modal-title').text("取消收藏");
	$("#info_modal").find('.modal-cont').text("您确定要取消收藏此帖吗？");
	$("#info_modal").find('.btn-primary').unbind();
	$("#info_modal").find('.btn-primary').bind('click',function() {
		$("#info_modal").modal('hide');
		setTimeout(function() {
			$.post(
				baseurl + "post/delete_favorite",
				{
					post_id: thisbtn.attr('data-pid'),
					post_type: thisbtn.attr('data-ptype')
				},
				function(res) {
					if (res.status == 1) {
						$("#info_modal").find('.modal-title').text("取消收藏成功");
						$("#info_modal").find('.modal-cont').text("恭喜，取消收藏成功！");
						$("#info_modal").find('.btn-default').css('display','none');
						$("#info_modal").find('.btn-primary').unbind();
						$("#info_modal").find('.btn-primary').bind('click', function() {
							$("#info_modal").modal("hide");
						});
						$("#info_modal").modal();
						thisbtn.html('已取消');
					} else {
						$("#info_modal").find('.modal-title').text("取消失败");
						$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
						$("#info_modal").find('.btn-default').css('display','none');
						$("#info_modal").find('.btn-primary').bind('click',function() {
							$("#info_modal").modal('hide');
						});
						$("#info_modal").modal();
						thisbtn.html('已收藏');
						thisbtn.attr('disabled', false);
					}
				},
				'json'
			);
		}, 1000);
		thisbtn.html('<i class="icon-spinner icon-spin"></i> 处理中');
		thisbtn.attr('disabled', true);
	});
	$("#info_modal").modal();
});
$("button.btn2_post_item").bind('click', function() {
	var thisbtn = $(this);
	$.post(
		baseurl + "post/add_favorite",
		{
			post_id: thisbtn.attr('data-pid'),
			post_type: thisbtn.attr('data-ptype')
		},
		function(res) {
			if (res.status == 1) {
				$("#info_modal").find('.modal-title').text("收藏成功");
				$("#info_modal").find('.modal-cont').text("恭喜，收藏成功！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').unbind();
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#info_modal").modal("hide");
				});
				$("#info_modal").modal();
				thisbtn.html('已收藏');
			} else {
				$("#info_modal").find('.modal-title').text("收藏失败");
				$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').unbind();
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#info_modal").modal('hide');
				});
				$("#info_modal").modal();
				thisbtn.html('<span class="fui-plus"></span>收藏');
				thisbtn.attr('disabled', false);
			}
		},
		'json'
	);
	thisbtn.html('<i class="icon-spinner icon-spin"></i> 处理中');
	thisbtn.attr('disabled', true);
});
$("button.btn1_post_item").bind('mouseover', function() {
	$(this).html('&nbsp;- 取消');
});
$("button.btn1_post_item").bind('mouseout', function() {
	$(this).html('已收藏');
});
function add_favorite(title, url) {
    try {
        window.external.addFavorite(url, title);
    }
    catch (e) {
        try {
            window.sidebar.addPanel(title, url, "");
        }
        catch (e) {
            alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加");
        }

    }
}
function back_to_top1() {
	$("#back_to_top").attr('src',baseurl + 'img/top2.png');
}
function back_to_top2() {
	$("#back_to_top").attr('src',baseurl + 'img/top.png');
}
function go_to_top() {
	$("html,body").animate({scrollTop:0}, 700);
}
function register(){
	$("#email").focus();
	$("input").blur();
	if ($("#check_school").hasClass("fui-cross") || $("#check_email").hasClass("fui-cross") || $("#check_pw").hasClass("fui-cross") || $("#check_pwa").hasClass("fui-cross")){
		return;
	}
	else{
		$.post(
			baseurl + "account/doregister",
			{
				school_id: $("#school_id").val(),
				email: $("#email").val() + $("#email_surfix").text(),
				password: $("#password").val(),
				passworda: $("#passworda").val(),
			},
			function(res) {
   				if (res.status == 1) {
   					var email = $("#email").val() + $("#email_surfix").text();
    				window.location.href=baseurl + "account/reginfo/" + email.split("@")[1];
   				}
   				else {   
					window.location.href=baseurl + "account/reginfo"; 
   				}
  			},
  			'json'
  		);
		$("#btn_register").attr("disable",true);
	}
}
function pre_login() {
	if ($("#login_box").css('display') == 'none') {
		go_to_top();
		$("#login_box").slideDown(700);
	}
	else {
		go_to_top();
		$("#login_box").slideUp(700);
	}
}
function login(mem) {
	$("input").blur();
	if ($("#check_email").hasClass("fui-cross") || $("#check_pw").hasClass("fui-cross")) {
		return;
	} else {
		$.post(
			baseurl + "account/dologin",
			{
				email: $("#email").val(),
				password: $("#password").val()
			},
			function(res) {
				if (res.status == 1 && mem == 1) { 
					window.location.href = res.data;
				} else if (res.status == 1 && mem == 0) {
					window.location.href = baseurl;
				} else {  
					$("#check_pw").html("密码输入错误，请重新输入！")
					$("#check_pw").removeClass("fui-check success");
					$("#check_pw").addClass("fui-cross danger");
				}
			},
			'json'
		);
	}
}
function logout() {
	$.post(
		baseurl + "account/dologout",
		function() {
			window.location.href = window.location.href.replace("#", "");
		}
	);
	return false;
}
function check_school(){
	var school = $("#school").val();   
  	var len = school.length; 
	if(len == 0){
		$("#check_school").html("请选择学校！");
		$("#check_school").removeClass("fui-check success");
		$("#check_school").addClass("fui-cross danger");
	}
	else{
		$("#check_school").html("学校选择完毕！");
		$("#check_school").removeClass("fui-cross danger");
		$("#check_school").addClass("fui-check success");
		return true;
	}
  	return false; 
}
function check_email(login) {
	var email = $("#email").val() + $("#email_surfix").text();
	if (email.length == $("#email_surfix").text().length){
		$("#check_email").html("请输入校园邮箱！");
		$("#check_email").removeClass("fui-check success");
		$("#check_email").addClass("fui-cross danger");
	}
	else if (email.indexOf("@")<0 || email.split("@")[0].length == 0 || email.split("@")[1].length == 0) {
		$("#check_email").html("请输入合法的邮箱格式！");
		$("#check_email").removeClass("fui-check success");
		$("#check_email").addClass("fui-cross danger");
	} else if (email.length > 30) {
		$("#check_email").html("邮箱长度不要超过30个字符！");
		$("#check_email").removeClass("fui-check success");
		$("#check_email").addClass("fui-cross danger");
	} else if (email.indexOf("edu") < 0) {
		$("#check_email").html("请使用你的校园邮箱！");
		$("#check_email").removeClass("fui-check success");
		$("#check_email").addClass("fui-cross danger");
	}
	else {
		$.post(
			baseurl + "account/docheck",
			{
				email: email
			},
			function(res) {
				if (login == 1) {  
					if (res.status == -1) {
						$("#check_email").html("邮箱存在！")
						$("#check_email").removeClass("fui-cross danger");
						$("#check_email").addClass("fui-check success");
						return true;
					} else if (res.status == 1) {   
						$("#check_email").html("您输入的邮箱不存在！请重新输入！");
						$("#check_email").removeClass("fui-check success");
						$("#check_email").addClass("fui-cross danger");
					} else {
						$("#check_email").html("您的邮箱尚未激活，请先激活！");
						$("#check_email").removeClass("fui-check success");
						$("#check_email").addClass("fui-cross danger");
					}
				}
				else {
					if (res.status == 1) {   
						$("#check_email").html("邮箱可用！");
						$("#check_email").removeClass("fui-cross danger");
						$("#check_email").addClass("fui-check success");
						return true;
					} else { 
						$("#check_email").html("您输入的邮箱已被注册！请重新输入！");
						$("#check_email").removeClass("fui-check success");
						$("#check_email").addClass("fui-cross danger");  
					}
				}
			},
			'json'
		);
	}
	return false; 
}
function check_pwo() {
	var passwordo = $("#passwordo").val();   
	var len = passwordo.length; 
	if (len == 0) {
		$("#check_pwo").html("请输入旧密码！");
		$("#check_pwo").removeClass("fui-check success");
		$("#check_pwo").addClass("fui-cross danger");
	}
	else if(len < 6) {
		$("#check_pwo").html("密码长度不能少于6位！");
		$("#check_pwo").removeClass("fui-check success");
		$("#check_pwo").addClass("fui-cross danger");
	}
	else if(len > 16) {
		$("#check_pwo").html("密码长度不要超过16位！");
		$("#check_pwo").removeClass("fui-check success");
		$("#check_pwo").addClass("fui-cross danger");
	}
	else {
		$.post(
			baseurl + "account/docheckpw",
			{
				password: passwordo
			},
			function(res) {
				if (res.status == 1) {   
					$("#check_pwo").html("密码正确！");
					$("#check_pwo").removeClass("fui-cross danger");
					$("#check_pwo").addClass("fui-check success");
					return true;
				} else { 
					$("#check_pwo").html("旧密码输入有误！请重新输入！");
					$("#check_pwo").removeClass("fui-check success");
					$("#check_pwo").addClass("fui-cross danger");  
				}
			},
			'json'
		);
	}
	return false; 
}
function check_pw() {
	var password = $("#password").val();   
	var len = password.length; 
	if (len == 0) {
		$("#check_pw").html("请输入密码！");
		$("#check_pw").removeClass("fui-check success");
		$("#check_pw").addClass("fui-cross danger");
	}
	else if(len < 6) {
		$("#check_pw").html("密码长度不能少于6位，请重新输入！");
		$("#check_pw").removeClass("fui-check success");
		$("#check_pw").addClass("fui-cross danger");
	}
	else if(len > 16) {
		$("#check_pw").html("密码长度不要超过16位，请重新输入！");
		$("#check_pw").removeClass("fui-check success");
		$("#check_pw").addClass("fui-cross danger");
	}
	else {
		$("#check_pw").html("密码长度合法！");
		$("#check_pw").removeClass("fui-cross danger");
		$("#check_pw").addClass("fui-check success");
		return true;
	}
	return false; 
}
function check_pwa(){
	var pw = $("#password").val();
	var pwa = $("#passworda").val();   
	if(pw != pwa) {
		$("#check_pwa").html("两次输入的密码不匹配，请重新输入！");
		$("#check_pwa").removeClass("fui-check success");
		$("#check_pwa").addClass("fui-cross danger");
	}
	else {
		$("#check_pwa").html("密码匹配！");
		$("#check_pwa").removeClass("fui-cross danger");
		$("#check_pwa").addClass("fui-check success");
		return true;
	}
  	return false; 
}
function add_love(lover, lovee){
	$.post(
		baseurl + "user/add_love",
		{
			lovee: lovee
		},
		function(res) {
			if (res.status == 1) {
				$("#info_modal").find('.modal-title').text("关注成功");
				$("#info_modal").find('.modal-cont').text("恭喜，关注成功！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					window.location.href = window.location.href;
				});
				$("#info_modal").modal();
			} else {
				$("#info_modal").find('.modal-title').text("关注失败");
				$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#btn_love").html('<span class="fui-plus"></span>关注');
					$("#btn_love").attr('disabled', false);
				});
				$("#info_modal").modal();
			}
		},
		'json'
	);
	$("#btn_love").html('<i class="icon-spinner icon-spin"></i> 处理中');
	$("#btn_love").attr('disabled', true);
}
function delete_love(lover,lovee,love){
	$("#info_modal").find('.modal-title').text("取消关注");
	$("#info_modal").find('.modal-cont').text("您确定要取消关注此用户吗？");
	$("#info_modal").find('.btn-primary').bind('click',function() {
		$("#info_modal").modal('hide');
		setTimeout(function() {
			$.post(
				baseurl + "user/delete_love",
				{
					lovee: lovee
				},
				function(res) {
					if (res.status == 1) {
						$("#info_modal").find('.modal-title').text("取消关注成功");
						$("#info_modal").find('.modal-cont').text("恭喜，取消关注成功！");
						$("#info_modal").find('.btn-default').css('display','none');
						$("#info_modal").find('.btn-primary').bind('click',function() {
							$("#info_modal").modal('hide');
							window.location.href = window.location.href;
						});
						$("#info_modal").modal();
					} else {
						$("#info_modal").find('.modal-title').text("关注失败");
						$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
						$("#info_modal").find('.btn-default').css('display','none');
						$("#info_modal").find('.btn-primary').bind('click',function() {
							$("#btn_love").html(' 已关注');
							$("#btn_love").attr('disabled', false);
						});
						$("#info_modal").modal();
					}
				},
				'json'
			);
		}, 1000);
		$("#btn_love").html('<i class="icon-spinner icon-spin"></i> 处理中');
		$("#btn_love").attr('disabled', true);
	});
	$("#info_modal").modal();	
}
function change2dl(){
	$("#btn_love").html('&nbsp;- 取消');
}
function change2al(){
	$("#btn_love").html(' 已关注');
}
function show_user_page(tabid, page){
	$("html,body").animate(
		{
			scrollTop: $("#scroll_bench").offset().top 
		},
		700
	);
	if($(tabid).html() == '') {	
		$.post(
			baseurl + "user/show_user_page",
			{
				tab_id: tabid,
				user_id: $("#user_id").val(),
				page: page
			},
			function(gethtml) {
        		$(tabid).html(gethtml);
        		$("div#user_panels img.lazy").lazyload({effect: "fadeIn"});
			}
		);
		$(tabid).html('<div class="user_tab_header panel panel-default"><center><i class="icon-spinner icon-spin"></i> 正在加载</center></div>');
	}
}
function show_user_page2(tabid, page){
	$("html,body").animate(
		{
			scrollTop: $("#scroll_bench").offset().top 
		},
		700
	);
	$.post(
		baseurl + "user/show_user_page",
		{
			tab_id: tabid,
			user_id: $("#user_id").val(),
			page: page
		},
		function(gethtml) {
			$(tabid).html(gethtml);
			$("div#user_panels img.lazy").lazyload({effect: "fadeIn"});
		}
	);
	$(tabid).children("div.user_tab_header").html('<center><i class="icon-spinner icon-spin"></i> 正在加载</center>');
}
function save_info(){
	$.post(
		baseurl + "user/save_info",
		{
			nick: $("#nick").val(),
			sex: $("input[name='sex']:checked").val(),
			signature: $("#signature").val(),
			type: $("#type").val(),
			year: $("#year").val(),
			email: $("#email").val(),
			qq: $("#qq").val(),
			weixin: $("#weixin").val(),
			phone: $("#phone").val()
		},
		function(res) {
			if (res.status == 1) {
				$("#info_modal").find('.modal-title').text("设置成功");
				$("#info_modal").find('.modal-cont').text("恭喜，设置成功！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					window.location.href = baseurl + "user/setup";
				});
				$("#info_modal").modal();
			} else {
				$("#info_modal").find('.modal-title').text("设置失败");
				$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#btn_saveinfo").html('保 存');
					$("#btn_saveinfo").attr('disabled', false);
					$("#info_modal").modal('hide');
				});
				$("#info_modal").modal();
			}
    	},
    	'json'
  	);
	$("#btn_saveinfo").html('<i class="icon-spinner icon-spin"></i> 保存中');
	$("#btn_saveinfo").attr('disabled', true);
}
function save_account(){
	$("input[type='password']").blur();
	if ($("#check_pwo").hasClass("fui-cross") || $("#check_pw").hasClass("fui-cross") || $("#check_pwa").hasClass("fui-cross")) {
		if ($("#passwordo").val().length > 0 || $("#password").val().length > 0 || $("#passworda").val().length > 0)
			return;
	}
	$.post(
		baseurl + "user/save_info",
		{
			is_email_public: $("#email_check").is(':checked') ? 1 : 0,
			is_qq_public: $("#qq_check").is(':checked') ? 1 : 0,
			is_weixin_public: $("#weixin_check").is(':checked') ? 1 : 0,
			is_phone_public: $("#phone_check").is(':checked') ? 1 : 0,
			is_sign_public: $("#sign_check").is(':checked') ? 1 : 0,
			is_mars: $("#mars_check").is(':checked') ? 1 : 0,
			pwo: $("#passwordo").val(),
			pwn: $("#password").val(),
			pwa: $("#passworda").val()
		},
		function(res) {
			if (res.status == 1) {
				$("#info_modal").find('.modal-title').text("设置成功");
				$("#info_modal").find('.modal-cont').text("恭喜，设置成功！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					window.location.href = baseurl + "user/setup/3";
				});
				$("#info_modal").modal();
			} else {
				$("#info_modal").find('.modal-title').text("设置失败");
				$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#btn_saveaccount").html('保 存');
					$("#btn_saveaccount").attr('disabled', false);
					$("#info_modal").modal('hide');
				});
				$("#info_modal").modal();
			}
    	},
    	'json'
  	);
	$("#btn_saveaccount").html('<i class="icon-spinner icon-spin"></i> 保存中');
	$("#btn_saveaccount").attr('disabled', true);
}
function save_star(){
	$.post(
		baseurl + "user/save_info",
		{
			nick_color: $("#nick_color").val()
		},
		function(res) {
			if (res.status == 1) {
				$("#info_modal").find('.modal-title').text("设置成功");
				$("#info_modal").find('.modal-cont').text("恭喜，设置成功！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					window.location.href = baseurl + "user/setup/4";
				});
				$("#info_modal").modal();
			} else {
				$("#info_modal").find('.modal-title').text("设置失败");
				$("#info_modal").find('.modal-cont').text("对不起，您还没有达到所需等级！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#btn_savestar").html('保 存');
					$("#btn_savestar").attr('disabled', false);
					$("#info_modal").modal('hide');
				});
				$("#info_modal").modal();
			}
    	},
    	'json'
  	);
	$("#btn_savestar").html('<i class="icon-spinner icon-spin"></i> 保存中');
	$("#btn_savestar").attr('disabled', true);
}
function type2category(type) {
	$("#post_type").val(type);
	$("#newpost_type").fadeOut(300, function() {
		$("#newpost_category").fadeIn(300);
	});
}
function category2type() {
	$("#newpost_category").fadeOut(300, function() {
		$("#newpost_type").fadeIn(300);
	});
}
function category2info() {
	if ($("#category1").val() == 5) {
		$("#brand").attr("placeholder", "请输入图书书名");
		$("#model").attr("placeholder", "请输入图书出版社和作者，空格隔开");
	}
	else {
		$("#brand").attr("placeholder", "请输入物品品牌/名称");
		$("#model").attr("placeholder", "请输入物品型号");
	}
	$("#newpost_category").fadeOut(300, function() {
		$("#newpost_info").fadeIn(300);
	});
}
function info2category() {
	$("#newpost_info").fadeOut(300, function() {
		$("#newpost_category").fadeIn(300);
	});
}
function info2price() {
	if ($("#post_type").val() == 0) {
		$("#deal").html("<option value=1 selected>一口价</option><option value=2>接受砍价</option><option value=3>一元赠送</option><option value=4>面议</option>");
	} else {
		$("#deal").html("<option value=1 selected>心理价格</option><option value=2>面议</option>");
	}
	$("#deal").change();
	$("#newpost_info").fadeOut(300, function() {
		$("#newpost_price").fadeIn(300);
	});
}
function price2info() {
	$("#newpost_price").fadeOut(300, function() {
		$("#newpost_info").fadeIn(300);
	});
}
function price2detail() {
	if ($("#post_type").val() == 0) {
		$("#description").attr("placeholder", "请填写您对商品的详细描述：");
		$("#btn_detail_next").unbind('click');
		$("#btn_detail_next").bind('click', detail2picture);
	} else {
		$("#description").attr("placeholder", "请填写您对商品的详细需求：");
		$("#btn_detail_next").unbind('click');
		$("#btn_detail_next").bind('click', detail2contact);
	}
	$("#newpost_price").fadeOut(300, function() {
		$("#newpost_detail").fadeIn(300);
	});
}
function detail2price() {
	$("#newpost_detail").fadeOut(300, function() {
		$("#newpost_price").fadeIn(300);
	});
}
function detail2picture() {
	$("#newpost_detail").fadeOut(300, function() {
		$("#newpost_picture").fadeIn(300);
	});
}
function picture2detail() {
	$("#newpost_picture").fadeOut(300, function() {
		$("#newpost_detail").fadeIn(300);
	});
}
function detail2contact() {
	$("#newpost_detail").fadeOut(300, function() {
		$("#btn_contact_pre").unbind('click');
		$("#btn_contact_pre").bind('click', contact2detail);
		$("#newpost_contact").fadeIn(300);
	});
}
function contact2detail() {
	$("#newpost_contact").fadeOut(300, function() {
		$("#newpost_detail").fadeIn(300);
	});
}
function picture2contact() {
	$("#newpost_picture").fadeOut(300, function() {
		$("#btn_contact_pre").unbind('click');
		$("#btn_contact_pre").bind('click', contact2picture);
		$("#newpost_contact").fadeIn(300);
	});
}
function contact2picture() {
	$("#newpost_contact").fadeOut(300, function() {
		$("#newpost_picture").fadeIn(300);
	});
}
function confirm_post() {
	var picture = new Array();
	$("div#preview_boxes div.preview_box").each(function() {
		var tp = new Object();
		tp.picture_url = $(this).find("img").attr("alt");
		tp.picture_des = $(this).find("textarea").val();
		picture.push(tp);
	});
	var timespec = "0";
	if ($("#form_picture_upload").attr("name") != undefined)
		timespec = $("#form_picture_upload").attr("name");
	var contactby = "";
	if ($("#jinxi_check").is(':checked'))
		contactby += "0";
	if ($("#email_check").is(':checked'))
		contactby += ",1";
	if ($("#qq_check").is(':checked'))
		contactby += ",2";
	if ($("#weixin_check").is(':checked'))
		contactby += ",3";
	if ($("#phone_check").is(':checked'))
		contactby += ",4";
	$.post(
		baseurl + "post/make_post",
		{
			post_type: $("#post_type").val(),
			category1: $("#category1").val(),
			category2: $("#category2").val(),
			brand: $("#brand").val(),
			model: $("#model").val(),
			class: $("#class").val(),
			deal: $("#deal").val(),
			price: $("#price").val(),
			description: $("#description").val(),
			picture: picture,
			first_picture: $("input[name='first_picture']:checked").val(),
			timespec: timespec,
			contactby: contactby
		},
		function(res) {
			if(res.status == 0) {
				$("#info_modal").find('.modal-title').text("发布失败");
				$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').unbind();
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#btn_saveaccount").html('保 存');
				});
				$("#info_modal").modal();
				$("#btn_confirm_post").attr("disabled", false);
				$("#btn_confirm_post").html('完成发布');
			} else {
				$("#btn_confirm_post").html('发布成功！');
				var post_type = "buy/";
				if ($("#post_type").val() == 0) {
					post_type = "sell/";
				}
				$("#form_picture_upload").attr("name", 0);
				$("#preview_boxes").html("");
				$("a#a_gotopost").attr('href', $("a#a_gotopost").attr('href') + post_type + res.data.post_id);
				$("#newpost_contact").fadeOut(300, function() {
					$("#newpost_success").fadeIn(300);
				});
			}
		},
		'json'
	);
	$("#btn_confirm_post").attr("disabled", true);
	$("#btn_confirm_post").html('<i class="icon-spinner icon-spin"></i><span>发布中</span>');
}
function close_post(pid, ptype){
	$("#info_modal").find('.modal-title').text("操作提醒");
	$("#info_modal").find('.modal-cont').text("关闭此帖后，此贴将不会出现在商品大厅中，确定要关闭它么？");
	$("#info_modal").find('.btn-primary').unbind();
	$("#info_modal").find('.btn-primary').bind('click',function() {
		$("#info_modal").modal("hide");
		setTimeout(function() {
			$.post(
				baseurl + "post/set_active",
				{
					post_id: pid,
					post_type: ptype,
					operation: 0
				},
				function(res) {
					if (res.status == 1) {
						$("#info_modal").find('.modal-title').text("操作成功");
						$("#info_modal").find('.modal-cont').text("关闭帖子成功！");
						$("#info_modal").find('.btn-default').css('display','none');
						$("#info_modal").find('.btn-primary').unbind();
						$("#info_modal").find('.btn-primary').bind('click',function() {
							$("#info_modal").modal("hide");
							window.location.href = window.location.href;
						});
						$("#info_modal").modal();
					} else {
						$("#info_modal").find('.modal-title').text("操作失败");
						$("#info_modal").find('.modal-cont').text(res.status.info);
						$("#info_modal").find('.btn-default').css('display','none');
						$("#info_modal").find('.btn-primary').unbind();
						$("#info_modal").find('.btn-primary').bind('click',function() {
							$("#info_modal").modal("hide");
							window.location.href = window.location.href;
						});
						$("#info_modal").modal();
					}
				},
				'json'
			);
		}, 1000);
		$("#btn_close_post").html('<i class="icon-spinner icon-spin"></i> 处理中');
		$("#btn_close_post").attr('disabled', true);
	});
	$("#info_modal").modal();
}
function open_post(pid, ptype){
	$.post(
		baseurl + "post/set_active",
		{
			post_id: pid,
			post_type: ptype,
			operation: 1
		},
		function(res) {
			if (res.status == 1) {
				$("#info_modal").find('.modal-title').text("操作成功");
				$("#info_modal").find('.modal-cont').text("恭喜，打开帖子成功！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').unbind();
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#info_modal").modal("hide");
					window.location.href = window.location.href;
				});
				$("#info_modal").modal();
			} else {
				$("#info_modal").find('.modal-title').text("操作失败");
				$("#info_modal").find('.modal-cont').text(res.status.info);
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').unbind();
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#info_modal").modal("hide");
					window.location.href = window.location.href;
				});
				$("#info_modal").modal();
			}
		},
		'json'
	);
	$("#btn_open_post").html('<i class="icon-spinner icon-spin"></i> 处理中');
	$("#btn_open_post").attr('disabled', true);
}
function add_collect(pid, ptype){
	$.post(
		baseurl + "post/add_favorite",
		{
			post_id: pid,
			post_type: ptype
		},
		function(res) {
			if (res.status == 1) {
				$("#info_modal").find('.modal-title').text("收藏成功");
				$("#info_modal").find('.modal-cont').text("恭喜，收藏成功！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').unbind();
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#info_modal").modal("hide");
					window.location.href = window.location.href;
				});
				$("#info_modal").modal();
			} else {
				$("#info_modal").find('.modal-title').text("收藏失败");
				$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').unbind();
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#info_modal").modal('hide');
				});
				$("#info_modal").modal();
				$("#btn_collcet").html('<span class="fui-plus"></span>收藏');
				$("#btn_collcet").attr('disabled', false);
			}
		},
		'json'
	);
	$("#btn_collcet").html('<i class="icon-spinner icon-spin"></i> 处理中');
	$("#btn_collcet").attr('disabled', true);
}
function delete_collect(pid, ptype){
	$("#info_modal").find('.modal-title').text("取消收藏");
	$("#info_modal").find('.modal-cont').text("您确定要取消收藏此帖吗？");
	$("#info_modal").find('.btn-primary').unbind();
	$("#info_modal").find('.btn-primary').bind('click',function() {
		$("#info_modal").modal('hide');
		setTimeout(function() {
			$.post(
				baseurl + "post/delete_favorite",
				{
					post_id: pid,
					post_type: ptype
				},
				function(res) {
					if (res.status == 1) {
						$("#info_modal").find('.modal-title').text("取消收藏成功");
						$("#info_modal").find('.modal-cont').text("恭喜，取消收藏成功！");
						$("#info_modal").find('.btn-default').css('display','none');
						$("#info_modal").find('.btn-primary').unbind();
						$("#info_modal").find('.btn-primary').bind('click',function() {
							$("#info_modal").modal("hide");
							window.location.href = window.location.href;
						});
						$("#info_modal").modal();
					} else {
						$("#info_modal").find('.modal-title').text("收藏失败");
						$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
						$("#info_modal").find('.btn-default').css('display','none');
						$("#info_modal").find('.btn-primary').unbind();
						$("#info_modal").find('.btn-primary').bind('click',function() {
							$("#info_modal").modal('hide');
						});
						$("#btn_collcet").html('已收藏');
						$("#btn_collcet").attr('disabled', false);
						$("#info_modal").modal();
					}
				},
				'json'
			);
		}, 1000);
		$("#btn_collcet").html('<i class="icon-spinner icon-spin"></i> 处理中');
		$("#btn_collcet").attr('disabled', true);
	});
	$("#info_modal").modal();	
}
function change2dc() {
	$("#btn_collcet").html('&nbsp;- 取消');
}
function change2ac() {
	$("#btn_collcet").html('已收藏');
}
function edit_description() {
	$("#post_description").slideUp(800, function() {
		$('#post_editor').slideDown(800);
	});
}
function confirm_edit_des(pid, ptype) {
	$.post(
		baseurl + "post/edit_description",
		{
			post_id: pid,
			post_type: ptype,
			description: $("#edit_description").val()
		},
		function(res) {
			if (res.status == 1) {
				$("div#post_description>pre").text($("#edit_description").val());
				$("#post_editor").slideUp(800, function() {
					$('#post_description').slideDown(800);
				});
				$("#btn_confirm_edit_des").html('确认修改');
				$("#btn_confirm_edit_des").attr('disabled', false);
			} else {
				$("#info_modal").find('.modal-title').text("修改失败");
				$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').unbind();
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#info_modal").modal("hide");
				});
				$("#info_modal").modal();
				$("#btn_confirm_edit_des").html('确认修改');
				$("#btn_confirm_edit_des").attr('disabled', false);
			}
		},
		'json'
	);
	$("#btn_confirm_edit_des").html('<i class="icon-spinner icon-spin"></i> 处理中');
	$("#btn_confirm_edit_des").attr('disabled', true);
}
function cancel_edit_des() {
	$("#post_editor").slideUp(800, function() {
		$('#post_description').slideDown(800);
	});
}
function go_to_reply(floor, user_id, user_nick) {
	var sflr = "楼主";
	if (floor > 0)
		sflr = "#" + floor + "楼";
	$("#reply_to_floor").val(floor);
	$("#reply_to_id").val(user_id);
	$("#post_doreply strong").text("回复 " + sflr + "： " + user_nick);
	$("html,body").animate(
		{
			scrollTop: $("#post_doreply").offset().top 
		},
		700,
		function() {
			$("textarea#reply_content").focus();
		}
	);
}
function confirm_reply() {
	if ($("#reply_content").val().length == 0) {
		$("#info_modal").find('.modal-title').text("回复失败");
		$("#info_modal").find('.modal-cont').text("对不起，您没有填写任何内容，请先填写~");
		$("#info_modal").find('.btn-default').css('display','none');
		$("#info_modal").find('.btn-primary').unbind();
		$("#info_modal").find('.btn-primary').bind('click',function() {
			$("#info_modal").modal("hide");
		});
		$("#info_modal").modal();
		return;
	}
	$.post(
		baseurl + "reply/add_reply",
		{
			post_id: $("#post_id").val(),
			type: $("#post_type").val(),
			reply_to: $("#reply_to_id").val(),
			reply_to_floor: $("#reply_to_floor").val(),
			content: $("#reply_content").val()
		},
		function(res) {
			if (res.status == 1) {
				window.location.href = res.data;
			} else {
				$("#info_modal").find('.modal-title').text("回复失败");
				$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').unbind();
				$("#info_modal").find('.btn-primary').bind('click', function() {
					$("#info_modal").modal("hide");
				});
				$("#info_modal").modal();
				$("#btn_confirm_reply").html('发布');
				$("#btn_confirm_reply").attr('disabled', false);
			}
		},
		'json'
	);
	$("#btn_confirm_reply").html('<i class="icon-spinner icon-spin"></i> 处理中');
	$("#btn_confirm_reply").attr('disabled', true);
}
function delete_reply(reply_id) {
	$("#info_modal").find('.modal-title').text("删除回复");
	$("#info_modal").find('.modal-cont').text("您确定要删除这条回复吗？");
	$("#info_modal").find('.btn-primary').unbind();
	$("#info_modal").find('.btn-primary').bind('click', function() {
		$("#info_modal").modal('hide');
		setTimeout(function() {
			$.post(
				baseurl + "reply/delete_reply",
				{
					reply_id: reply_id
				},
				function(res) {
					if (res.status == 1) {
						$("div.reply_box[data-rid=" + reply_id + "]").slideUp(300);
					} else {
						$("#info_modal").find('.modal-title').text("删除失败");
						$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
						$("#info_modal").find('.btn-default').css('display','none');
						$("#info_modal").find('.btn-primary').unbind();
						$("#info_modal").find('.btn-primary').bind('click', function() {
							$("#info_modal").modal('hide');
						});
						$("#btn_delete_reply").html('<span class="fui-cross"></span>删除');
						$("#btn_delete_reply").attr('disabled', false);
						$("#info_modal").modal();
					}
				},
				'json'
			);
		}, 1000);
		$("#btn_delete_reply").html('<i class="icon-spinner icon-spin"></i> 处理中');
		$("#btn_delete_reply").attr('disabled', true);
	});
	$("#info_modal").modal();
}
function go_to_report(reply_id, floor) {
	$("#report_reply_id").val(reply_id);
	$("#report_floor").val(floor);
	$("#report_modal").modal();
}
function confirm_report() {
	$("#report_modal").modal('hide');
	setTimeout(function() {
		$.post(
			baseurl + "reply/make_report",
			{
				report_reply_id: $("#report_reply_id").val(),
				report_floor: $("#report_floor").val(),
				report_reason: $('input[name="report_reason"]:checked').val(),
				report_other_reason: $("#report_other_reason").val()
			},
			function(res) {
				if (res.status == 1) {
					$("#info_modal").find('.modal-title').text("举报成功");
					$("#info_modal").find('.modal-cont').text("恭喜，举报成功，请等待审核~");
					$("#info_modal").find('.btn-default').css('display','none');
					$("#info_modal").find('.btn-primary').unbind();
					$("#info_modal").find('.btn-primary').bind('click', function() {
						$("#info_modal").modal("hide");
					});
					$("#info_modal").modal();
				} else {
					$("#info_modal").find('.modal-title').text("举报失败");
					$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
					$("#info_modal").find('.btn-default').css('display','none');
					$("#info_modal").find('.btn-primary').unbind();
					$("#info_modal").find('.btn-primary').bind('click', function() {
						$("#info_modal").modal("hide");
					});
					$("#info_modal").modal();
				}
			},
			'json'
		);
	}, 1000);
}
function mess_user(uid, unick, refresh) {
	$("#mess_modal").find('.modal-cont').html("发给 <strong>" + unick + "</strong> 的私信：");
	setTimeout(function() {
		$("textarea#mess_content").focus();
	}, 500);
	$("#mess_modal").find('.btn-primary').unbind();
	$("#mess_modal").find('.btn-primary').bind('click', function() {
		$("button.btn_mess_user").attr('disabled', true);
		$("#mess_modal").modal("hide");
		$.post(
			baseurl + "message/add_message",
			{
				to_id: uid,
				content: $("textarea#mess_content").val()
			},
			function(res) {
				$("button.btn_mess_user").attr('disabled', false);
				if (res.status == 1) {
					$("#info_modal").find('.modal-title').text("发送成功");
					$("#info_modal").find('.modal-cont').html("恭喜，您发送给 <strong>" + unick + "</strong> 的私信已送达~");
					$("#info_modal").find('.btn-default').css('display','none');
					$("#info_modal").find('.btn-primary').unbind();
					$("#info_modal").find('.btn-primary').bind('click', function() {
						$("#info_modal").modal("hide");
						if (refresh == 1) {
							window.location.href = baseurl + "user/profile/" + $("#user_id").val() + "/5";
						}
					});
					$("#info_modal").modal();
				} else {
					$("#info_modal").find('.modal-title').text("发送失败");
					$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
					$("#info_modal").find('.btn-default').css('display','none');
					$("#info_modal").find('.btn-primary').unbind();
					$("#info_modal").find('.btn-primary').bind('click', function() {
						$("#info_modal").modal("hide");
					});
					$("#info_modal").modal();
				}
			},
			'json'
		);
	});
	$("#mess_modal").modal();
};
function delete_mess(mid) {
	$("#info_modal").find('.modal-title').text("删除私信");
	$("#info_modal").find('.modal-cont').text("您确定要删除这条私信吗？");
	$("#info_modal").find('.btn-primary').unbind();
	$("#info_modal").find('.btn-primary').bind('click', function() {
		$("#info_modal").modal('hide');
		setTimeout(function() {
			$.post(
				baseurl + "message/delete_message",
				{
					message_id: mid
				},
				function(res) {
					if (res.status == 1) {
						window.location.href = baseurl + "user/profile/" + $("#user_id").val() + "/5";
					} else {
						$("#info_modal").find('.modal-title').text("删除失败");
						$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
						$("#info_modal").find('.btn-default').css('display','none');
						$("#info_modal").find('.btn-primary').unbind();
						$("#info_modal").find('.btn-primary').bind('click', function() {
							$("#info_modal").modal('hide');
						});	
						$("button.close").attr('disabled', false);
						$("#info_modal").modal();
					}
				},
				'json'
			);
		}, 1000);
		$("button.close").attr('disabled', true);
	});
	$("#info_modal").modal();
};

function open_reminder() {
	$("#reminder_modal div.modal-content").html('<div class="modal-header"><h4 class="modal-title">消息提醒</h4></div><div class="modal-body"><div id="reminders_box"><div id="reminder_loading"><i class="icon-spinner icon-spin"></i> 加载中</div></div></div>');
	$("#reminder_modal").modal();
	$.post(
		baseurl + "info/reminder",
		{},
		function(gethtml) {
    		$("#reminder_modal div.modal-content").html(gethtml);
		}
	);
}
function go_to_reminder(url) {
	var clicked_a = $("div#reminders_box>a[href='" + url +"']");
	clicked_a.remove();
	var cnt = $("#reminder_modal div.modal-content h4").text().split("(")[1].split(")")[0] - 1;
	$("#reminder_modal div.modal-content h4").html('消息提醒(' + cnt + ')');
}
function play_reminder(){
    $('embed').remove();  
    $('body').append('<embed src="' + baseurl + 'resource/reminder.wav" autostart="true" loop="false">');
}