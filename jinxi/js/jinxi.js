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
});
$(window).bind('scroll', function() {
	$(this).scrollTop() > 600 ? $("#back_to_top").fadeIn(500) : $("#back_to_top").fadeOut(500);
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
function show_user_page(tabid, uid, page, first){
	$("html,body").animate(
		{
			scrollTop: $("#scroll_bench").offset().top 
		},
		700
	);
	if(first == 0 || $(tabid).html() == '') {	
		$.post(
			baseurl + "user/show_user_page",
			{
				tab_id: tabid,
				user_id: uid,
				page: page
			},
			function(gethtml) {
        		$(tabid).html(gethtml);
			}
		);
		$(tabid).html('<center><i class="icon-spinner icon-spin"></i> 正在加载</center>');
	}
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
		$("#p_confirm_post").text("确认请按下一步。");
		$("#btn_confirm_post_buy").text("下一步");
	} else {
		$("#description").attr("placeholder", "请填写您对商品的详细需求：");
		$("#p_confirm_post").text("确认请按完成发布。");
		$("#btn_confirm_post_buy").text("完成发布");
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
	if ($("#post_type").val() == 0) {
		$("#newpost_detail").fadeOut(300, function() {
			$("#newpost_picture").fadeIn(300);
		});
	} else {
		confirm_post(1);
	}
}
function picture2detail() {
	$("#newpost_picture").fadeOut(300, function() {
		$("#newpost_detail").fadeIn(300);
	});
}
function confirm_post(type) {
	var last = $("#newpost_detail");
	var cbtn = $("#btn_confirm_post_buy");
	if (type == 0) {
		last = $("#newpost_picture");
		cbtn = $("#btn_confirm_post_sell");
	}
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
			fisrt_picture: $("input[name='fisrt_picture']:checked").val(),
			timespec: timespec
		},
		function(res) {
			if(res.status == 0) {
				$("#info_modal").find('.modal-title').text("发布失败");
				$("#info_modal").find('.modal-cont').text("对不起，操作失败，请重试！");
				$("#info_modal").find('.btn-default').css('display','none');
				$("#info_modal").find('.btn-primary').bind('click',function() {
					$("#btn_saveaccount").html('保 存');
				});
				$("#info_modal").modal();
				cbtn.attr("disabled", false);
				cbtn.html('完成发布');
			} else {
				cbtn.html('发布成功！');
				$("a#a_gotopost").attr('href', $("a#a_gotopost").attr('href') + res.data);
				last.fadeOut(300, function() {
					$("#newpost_success").fadeIn(300);
				});
			}
		},
		'json'
	);
	cbtn.attr("disabled", true);
	cbtn.html('<i class="icon-spinner icon-spin"></i><span>发布中</span>');
}










function addfocus(focuser,focusee,focuss){
	$.post(baseurl + "ajax/addfocus",{focuser:focuser,focusee:focusee,focuss:focuss},function(str){
		alert(str);
		window.location.href=window.location.href;
	})
	$("#focusbox").html('<i class="icon-spinner icon-spin"></i> 正在处理');
}
function deletefocus(focuser,focusee,focuss){
	$.post(baseurl + "ajax/deletefocus",{focuser:focuser,focusee:focusee,focuss:focuss},function(){
		window.location.href=window.location.href;
	})
	$("#focusbox").html('<i class="icon-spinner icon-spin"></i> 正在处理');
}
function change2df(){
	$("#focusbt").html('&nbsp;- 取消');
}
function change2af(){
	$("#focusbt").html(' 已收藏');
}


function gotocomm(uid){
	$('#mycommlink').tab('show');
	if($("#mycomm").html()==''){
		$.post(baseurl + "ajax/show_user_page",{tab:5,uid:uid,page:1},function(gethtml){
			$("#mycomm").html(gethtml);
			$("html,body").animate({scrollTop:$("#scrollfoot").offset().top}, 700);
		})
		$("#mycomm").html('<center><i class="icon-spinner icon-spin"></i> 正在加载</center>');
	}
	else
		$("html,body").animate({scrollTop:$("#scrollfoot").offset().top}, 700);
}
function docomment(subject_id,user_id){
	var ctype = $("#ctype").val();
	var cscore = $("#cscore").val();
	var ccontent = $("#commcont").val();
	$.post(baseurl + "ajax/addcomment",{user_id:user_id,subject_id:subject_id,ctype:ctype,cscore:cscore,ccontent:ccontent},function(){
        showuserpage(5,user_id,1,1);
	})
}
function commreport(oid){
	$("#report_oid").val(oid);
	$("#report_rtype").val(1);
	$("#reportmodal").modal();
}
function reportconfirm(){
	var object_id = $("#report_oid").val();
	var rtype = $("#report_rtype").val();
	var rcontent = $('input[name="reportreason"]:checked').val();
	if(rcontent == '其他')
		rcontent = $("#report_or").val();
	$.post(baseurl + "ajax/addreport",{object_id:object_id,rtype:rtype,rcontent:rcontent});
}