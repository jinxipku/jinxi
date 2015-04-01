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
$(window).bind('scroll',function() {
	$(this).scrollTop() > 600 ? $("#back_to_top").fadeIn(500) : $("#back_to_top").fadeOut(500);
});
$("input").bind('blur',function() {
	if ($(this).attr("id") == "school" || $(this).val().length > 0) {
		$(this).removeClass("flat");
	}
	else {
		$(this).addClass("flat");
	}
});
$("textarea").bind('blur',function() {
	if ($(this).val().length > 0) {
		$(this).removeClass("flat");
	}
	else {
		$(this).addClass("flat");
	}
});
$('#choose_school').on('hidden.bs.modal', function () {
	$('#school').attr('disabled', false);
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
			window.location.href = window.location.href;
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
		$("#check_email").html("邮箱长度不要超过30个字符，请重新输入！");
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
						$("#check_email").html("您的邮箱尚未激活，请立即前往邮箱激活！");
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
		baseurl + "love/addlove",
		{
			lover: lover,
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
			baseurl + "account/deletelove",
			{
				lover: lover,
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
			sex: $("#sex").val(),
			signature: $("#signature").val(),
			type: $("#type").val(),
			year: $("#year").val(),
			email: $("#email").val(),
			qq: $("#qq").val(),
			weixin: $("#weixin").val(),
			phone: $("#phone").val()
		},
		function(res) { 
    		window.location.href = window.location.href;
    	},
    	'json'
  	);
	$("#btn_saveinfo").html('<i class="icon-spinner icon-spin"></i> 保存中');
	$("#btn_saveinfo").attr('disabled', true);
}
function saveac(){
	$("#saveac").parent().html('<i class="icon-spinner icon-spin"></i> 正在保存');
	var mailcheck = $("#mailcheck").is(':checked')?1:0;
	var qqcheck = $("#qqcheck").is(':checked')?1:0;
	var phonecheck = $("#phonecheck").is(':checked')?1:0;
	var sign1 = $("#sign1").is(':checked')?1:0;
	var sign2 = $("#sign2").is(':checked')?1:0;
	var righton = $("#righton").is(':checked')?1:0;
	var url = baseurl + "ajax/saveac";
	$.post(url,{mailcheck:mailcheck,qqcheck:qqcheck,phonecheck:phonecheck,sign1:sign1,sign2:sign2,righton:righton},function(){ 
    	window.location.href=baseurl + "setup/account";
  	});
}
function savest(){
	$("#savest").parent().html('<i class="icon-spinner icon-spin"></i> 正在保存');
	var namecolor = $("#namecolor").val();
	var autoon = $("#autoon").is(':checked')?1:0;
	var url = baseurl + "ajax/savest";
	$.post(url,{namecolor:namecolor,autoon:autoon},function(){ 
    	window.location.href=baseurl + "setup/star";
  	});
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