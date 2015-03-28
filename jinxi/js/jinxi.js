var baseurl = "../";
$(document).ready( function() {
	$(".carousel").carousel();
	$(".ellipsis").ellipsis();
	$(':radio').radio();
	$("#password").keydown(function(){
		if(event.keyCode==13){
			var url = window.location.href;
			if(url.indexOf("account/login")<0)
				login(baseurl + "/");
			else{
				$.post(baseurl + "/ajax/get_mem_url",function(str){
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
$('#choose_school').on('hidden.bs.modal', function () {
	$('#school').attr('disabled', false);
})
function back_to_top1() {
	$("#back_to_top").attr('src','../img/top2.png');
}
function back_to_top2() {
	$("#back_to_top").attr('src','../img/top.png');
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
			baseurl + "/account/doregister",
			{
				school_id: $("#school_id").val(),
				email: $("#email").val() + $("#email_surfix").text(),
				password: $("#password").val(),
				passworda: $("#passworda").val(),
			},
			function(res) {
   				if (res.status == 1) {
   					var email = $("#email").val() + $("#email_surfix").text();
    				window.location.href=baseurl + "/account/reginfo/" + email.split("@")[1];
   				}
   				else {   
					window.location.href=baseurl + "/account/reginfo"; 
   				}
  			},
  			'json'
  		);
		$("#btn_register").attr("disable",true);
	}
}
function pre_login(st) {
	if (st == 0) {
		go_to_top();
		$("#login_box").slideDown(700);
	}
	else if (st == 1){
		go_to_top();
		$("#login_box").slideUp(700);
	}
}
function mem_login() {
	var loca = "http://www.xn--wmqr18c.cn";
	if (window.location.href.indexOf("account/loginfo") < 0)
		loca = window.location.href;
	$.post(baseurl + "/ajax/mem_url",{memurl:loca},function(){
		window.location.href = baseurl + "/account/login";
	});
}
function prememlogin() {
	$.post(baseurl + "/ajax/mem_url",{memurl:window.location.href});
}
function login(loca) {
	$("input").blur();
	if($("#check_mail").hasClass("fui-cross")||$("#checkpw").hasClass("fui-cross")){
		return;
	}
	else{
		var mail = $("#mail").val();
		var password = $("#password").val();
		var url = baseurl + "/ajax/login/"+mail.split("@")[0]+"/"+mail.split("@")[1]+"/"+password;
		$.post(url,function(str){   
			if(str == '1'){ 
				window.location.href=loca;
			}else if(str == '-1'){  
				$("#checkpw").html("密码输入错误，请重新输入！")
				$("#checkpw").addClass(" fui-cross");
				$("#checkpw").css('color','#E74C3C'); 
			}
			else{
				$("#check_mail").html("您的邮箱尚未激活，请先激活！");
				$("#check_mail").addClass(" fui-cross");
				$("#check_mail").css('color','#E74C3C');
			}
		});
	}
}

function logout() {
	var url = baseurl + "/ajax/logout";
	$.post(url,function(){   
		window.location.href=window.location.href;
	});
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
		alert(email);
		$.post(
			baseurl + "/account/docheck",
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

function check_captcha(){
	var url = baseurl + "/ajax/check_captcha"; 
	$.post(url,{captcha:$("#captchaw").val()},function(str){ 
		if(str=='0'){
			$("#check5").html("验证码不正确，请重新输入");
			$("#check5").addClass(" fui-cross");
			$("#check5").css('color','#E74C3C');
		}
		else{
			$("#check5").html("验证码匹配！");
			$("#check5").removeClass(" fui-cross");
			$("#check5").addClass(" fui-check");
			$("#check5").css('color','#2ECC71');
		}
	});
}


function createcaptcha(){
	$.post(baseurl + "/ajax/captcha",function(str){
		$("#captcha").html(str);
	});
}
function createcaptcha2(){
	if($("#captcha").html()==''){
		$.post(baseurl + "/ajax/captcha",function(str){
			$("#captcha").html(str);
		});
	}
}
function savebi(){
	$("#savebi").parent().html('<i class="icon-spinner icon-spin"></i> 正在保存');
	var username = $("#username").val();
	var sex = $('input[name="sex"]:checked').val()
	var school = $("#university").val();
	var degree = $("#degree").val();
	var year = $("#year").val();
	var sign = $("#sign").val();
	var qq = $("#qq").val();
	var phone = $("#phone").val();
	var url = baseurl + "/ajax/savebi";
	$.post(url,{username:username,sex:sex,school:school,degree:degree,year:year,sign:sign,qq:qq,phone:phone},function(){ 
    	window.location.href=baseurl + "/setup";
  	});
}
function saveac(){
	$("#saveac").parent().html('<i class="icon-spinner icon-spin"></i> 正在保存');
	var mailcheck = $("#mailcheck").is(':checked')?1:0;
	var qqcheck = $("#qqcheck").is(':checked')?1:0;
	var phonecheck = $("#phonecheck").is(':checked')?1:0;
	var sign1 = $("#sign1").is(':checked')?1:0;
	var sign2 = $("#sign2").is(':checked')?1:0;
	var righton = $("#righton").is(':checked')?1:0;
	var url = baseurl + "/ajax/saveac";
	$.post(url,{mailcheck:mailcheck,qqcheck:qqcheck,phonecheck:phonecheck,sign1:sign1,sign2:sign2,righton:righton},function(){ 
    	window.location.href=baseurl + "/setup/account";
  	});
}
function savest(){
	$("#savest").parent().html('<i class="icon-spinner icon-spin"></i> 正在保存');
	var namecolor = $("#namecolor").val();
	var autoon = $("#autoon").is(':checked')?1:0;
	var url = baseurl + "/ajax/savest";
	$.post(url,{namecolor:namecolor,autoon:autoon},function(){ 
    	window.location.href=baseurl + "/setup/star";
  	});
}
function addfavorite(title, url) {
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
function addlove(lover,lovee,love){
	$.post(baseurl + "/ajax/addlove",{lover:lover,lovee:lovee,love:love},function(){
		window.location.href=window.location.href;
	})
	$("#lovebox").html('<i class="icon-spinner icon-spin"></i> 正在处理');
}
function deletelove(lover,lovee,love){
	$.post(baseurl + "/ajax/deletelove",{lover:lover,lovee:lovee,love:love},function(){
		window.location.href=window.location.href;
	})
	$("#lovebox").html('<i class="icon-spinner icon-spin"></i> 正在处理');
}
function change2dl(){
	$("#lovebt").html('&nbsp;- 取消');
}
function change2al(){
	$("#lovebt").html(' 已关注');
}

function addfocus(focuser,focusee,focuss){
	$.post(baseurl + "/ajax/addfocus",{focuser:focuser,focusee:focusee,focuss:focuss},function(str){
		alert(str);
		window.location.href=window.location.href;
	})
	$("#focusbox").html('<i class="icon-spinner icon-spin"></i> 正在处理');
}
function deletefocus(focuser,focusee,focuss){
	$.post(baseurl + "/ajax/deletefocus",{focuser:focuser,focusee:focusee,focuss:focuss},function(){
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

function showuserpage(tab,uid,page,type){
	var objstr = "#x";
	switch(tab){
		case 0:{
			objstr = "#thisrec";
			break;
		}
		case 1:{
			objstr = "#bbsrec";
			break;
		}
		case 2:{
			objstr = "#mypost";
			break;
		}
		case 3:{
			objstr = "#myfocus";
			break;
		}
		case 4:{
			objstr = "#mylove";
			break;
		}
		case 5:{
			objstr = "#mycomm";
			break;
		}
		case 6:{
			objstr = "#mycomm";
			break;
		}
		case 7:{
			objstr = "#mycomm";
			break;
		}
		case 8:{
			objstr = "#mymess";
			break;
		}
		default:
			break;
	}
	$("html,body").animate({scrollTop:$("#scrollhead1").offset().top}, 700);
	if($(objstr).html()==''||type==1){
		$.post(baseurl + "/ajax/show_user_page",{tab:tab,uid:uid,page:page},function(gethtml){
        	$(objstr).html(gethtml);
		})
		$(objstr).html('<center><i class="icon-spinner icon-spin"></i> 正在加载</center>');
	}
}
function gotocomm(uid){
	$('#mycommlink').tab('show');
	if($("#mycomm").html()==''){
		$.post(baseurl + "/ajax/show_user_page",{tab:5,uid:uid,page:1},function(gethtml){
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
	$.post(baseurl + "/ajax/addcomment",{user_id:user_id,subject_id:subject_id,ctype:ctype,cscore:cscore,ccontent:ccontent},function(){
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
	$.post(baseurl + "/ajax/addreport",{object_id:object_id,rtype:rtype,rcontent:rcontent});
}