$(document).ready( function() {
	$(".carousel").carousel();
	$(".ellipsis").ellipsis();
	$(':radio').radio();
	$("#password").keydown(function(){
		if(event.keyCode==13){
			var url = window.location.href;
			if(url.indexOf("account/login")<0)
				login("http://www.xn--wmqr18c.cn/");
			else{
				$.post("http://www.xn--wmqr18c.cn/ajax/get_mem_url",function(str){
					login(str);
				});
			}
		}
	});
});
$(window).bind('scroll',function(){
	$(this).scrollTop()>600?$("#backtotop").fadeIn(500):$("#backtotop").fadeOut(500)
});
function totop1(){
	$("#backtotop").attr('src','http://www.xn--wmqr18c.cn/img/top2.png');
}
function totop2(){
	$("#backtotop").attr('src','http://www.xn--wmqr18c.cn/img/top.png');
}
function gototop(loca){
	$("html,body").animate({scrollTop:loca}, 700);
}
function prelogin(st){
	if(st==0){
		$("#loginbox").slideDown(700);
		return false;
	}
	else if(st==1){
		$("#loginbox").slideUp(700);
	}
}
function memlogin(){
	var loca = "http://www.xn--wmqr18c.cn";
	if(window.location.href.indexOf("account/loginfo") < 0)
		loca = window.location.href;
	$.post("http://www.xn--wmqr18c.cn/ajax/mem_url",{memurl:loca},function(){
		window.location.href = "http://www.xn--wmqr18c.cn/account/login";
	});
}
function prememlogin(){
	$.post("http://www.xn--wmqr18c.cn/ajax/mem_url",{memurl:window.location.href});
}
function login(loca){
	$("input").blur();
	if($("#checkmail").hasClass("fui-cross")||$("#checkpw").hasClass("fui-cross")){
		return;
	}
	else{
		var mail = $("#mail").val();
		var password = $("#password").val();
		var url = "http://www.xn--wmqr18c.cn/ajax/login/"+mail.split("@")[0]+"/"+mail.split("@")[1]+"/"+password;
		$.post(url,function(str){   
			if(str == '1'){ 
				window.location.href=loca;
			}else if(str == '-1'){  
				$("#checkpw").html("密码输入错误，请重新输入！")
				$("#checkpw").addClass(" fui-cross");
				$("#checkpw").css('color','#E74C3C'); 
			}
			else{
				$("#checkmail").html("您的邮箱尚未激活，请立即前往邮箱激活！");
				$("#checkmail").addClass(" fui-cross");
				$("#checkmail").css('color','#E74C3C');
			}
		});
	}
}

function logout(){
	var url = "http://www.xn--wmqr18c.cn/ajax/logout";
	$.post(url,function(){   
		window.location.href=window.location.href;
	});
	return false;
}

function checkmail(type){
	if($("#checkmail").html()=="您的邮箱尚未激活，请立即前往邮箱激活！")
		return;
	var mail = $("#mail").val();
	if(mail.length==0){
		$("#checkmail").html("请输入邮箱！");
		$("#checkmail").addClass(" fui-cross");
		$("#checkmail").css('color','#E74C3C');
	}
	else if(mail.indexOf("@")<0||mail.split("@")[0].length==0||mail.split("@")[1].length==0){
		$("#checkmail").html("请输入合法的邮箱格式！");
		$("#checkmail").addClass(" fui-cross");
		$("#checkmail").css('color','#E74C3C');
	}
	else{
		var url = "http://www.xn--wmqr18c.cn/ajax/check_mail/"+mail.split("@")[0]+"/"+mail.split("@")[1]; 
		if(mail.length==0){
			$("#checkmail").html("请输入邮箱！");
			$("#checkmail").addClass(" fui-cross");
			$("#checkmail").css('color','#E74C3C');
		}
		else if(mail.length>30){
			$("#checkmail").html("邮箱长度不要超过30个字符，请重新输入！");
			$("#checkmail").addClass(" fui-cross");
			$("#checkmail").css('color','#E74C3C');
		}
		else{
			$.post(url,function(str){ 
				if(type==0){  
					if(str == '0'){   
						$("#checkmail").html("您输入的邮箱不存在！请重新输入！");  
						$("#checkmail").addClass(" fui-cross"); 
						$("#checkmail").css('color','#E74C3C');
					}else{   
						$("#checkmail").html("邮箱存在！")
						$("#checkmail").removeClass(" fui-cross");
						$("#checkmail").addClass(" fui-check"); 
						$("#checkmail").css('color','#2ECC71');
					}  
				}
				else {
					if(str == '1'){   
						$("#checkmail").html("您输入的邮箱已被注册！请重新输入！");  
						$("#checkmail").addClass(" fui-cross"); 
						$("#checkmail").css('color','#E74C3C');
					}else{   
						$("#checkmail").html("邮箱可用！");
						$("#checkmail").removeClass(" fui-cross");
						$("#checkmail").addClass(" fui-check"); 
						$("#checkmail").css('color','#2ECC71');
					}
				}
			});
		}
	}
	return false; 
}
function checkpw(){
	var password = $("#password").val();   
	var len = password.length; 
	if(len==0){
		$("#checkpw").html("请输入密码！");
		$("#checkpw").addClass(" fui-cross");
		$("#checkpw").css('color','#E74C3C');
	}
	else if(len<6){
		$("#checkpw").html("密码长度不能少于6位，请重新输入！");
		$("#checkpw").addClass(" fui-cross");
		$("#checkpw").css('color','#E74C3C');
	}
	else if(len>16){
		$("#checkpw").html("密码长度不要超过16位，请重新输入！");
		$("#checkpw").addClass(" fui-cross");
		$("#checkpw").css('color','#E74C3C');
	}
	else{
		$("#checkpw").html("密码长度合法！");
		$("#checkpw").removeClass(" fui-cross");
		$("#checkpw").addClass(" fui-check");
		$("#checkpw").css('color','#2ECC71');
	}
	return false; 
}

function checkname(){
	var username = $("#user_name").val();   
  	var len = username.length; 
	if(len==0){
		$("#check2").html("请输入姓名！");
		$("#check2").addClass(" fui-cross");
		$("#check2").css('color','#E74C3C');
	}
	else if(len>10){
		$("#check2").html("姓名不要超过10个字符，请重新输入！");
		$("#check2").addClass(" fui-cross");
		$("#check2").css('color','#E74C3C');
	}
	else{
		$("#check2").html("姓名可用！");
		$("#check2").removeClass(" fui-cross");
		$("#check2").addClass(" fui-check");
		$("#check2").css('color','#2ECC71');
	}
  	return false; 
}

function checkpw1(){
	var password1 = $("#password1").val();   
	var len = password1.length; 
	if(len==0){
		$("#checkpw1").html("请输入密码！");
		$("#checkpw1").addClass(" fui-cross");
		$("#checkpw1").css('color','#E74C3C');
	}
	else if(len<6){
		$("#checkpw1").html("密码长度不能少于6位，请重新输入！");
		$("#checkpw1").addClass(" fui-cross");
		$("#checkpw1").css('color','#E74C3C');
	}
	else if(len>16){
		$("#checkpw1").html("密码长度不要超过16位，请重新输入！");
		$("#checkpw1").addClass(" fui-cross");
		$("#checkpw1").css('color','#E74C3C');
	}
	else{
		$("#checkpw1").html("密码长度合法！");
		$("#checkpw1").removeClass(" fui-cross");
		$("#checkpw1").addClass(" fui-check");
		$("#checkpw1").css('color','#2ECC71');
	}
	return false; 
}

function checkpw2(){
	var pw1 = $("#password1").val();
	var pw2 = $("#password2").val();   
	if(pw1!=pw2){
		$("#check4").html("两次输入的密码不匹配，请重新输入！");
		$("#check4").addClass(" fui-cross");
		$("#check4").css('color','#E74C3C');
	}
	else{
		$("#check4").html("密码匹配！");
		$("#check4").removeClass(" fui-cross");
		$("#check4").addClass(" fui-check");
		$("#check4").css('color','#2ECC71');
	}
  	return false; 
}

function checkcaptcha(){
	var url = "http://www.xn--wmqr18c.cn/ajax/check_captcha"; 
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

function regidit(){
	$("input").blur();
	if($("#checkmail").hasClass("fui-cross")||$("#check2").hasClass("fui-cross")||$("#checkpw1").hasClass("fui-cross")||$("#check4").hasClass("fui-cross")){
		return;
	}
	else{
		var mail=$("#mail").val();
		var pw1=$("#password1").val();
		var pw2=$("#password2").val();
		var url = "http://www.xn--wmqr18c.cn/ajax/regidit/"+mail.split("@")[0]+"/"+mail.split("@")[1]+"/"+pw1;
		$.post(url,{user_name:$("#user_name").val()},function(str){ 
   			if(str == '1'){ 
    			window.location.href="http://www.xn--wmqr18c.cn/account/reginfo/mail/"+mail.split("@")[1].split(".")[0];
   			}else{   
				window.location.href="http://www.xn--wmqr18c.cn/account/reginfo/fail"; 
   			}
  		});
		$("#bt4reg").hide(0);
	}
}
function createcaptcha(){
	$.post("http://www.xn--wmqr18c.cn/ajax/captcha",function(str){
		$("#captcha").html(str);
	});
}
function createcaptcha2(){
	if($("#captcha").html()==''){
		$.post("http://www.xn--wmqr18c.cn/ajax/captcha",function(str){
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
	var url = "http://www.xn--wmqr18c.cn/ajax/savebi";
	$.post(url,{username:username,sex:sex,school:school,degree:degree,year:year,sign:sign,qq:qq,phone:phone},function(){ 
    	window.location.href="http://www.xn--wmqr18c.cn/setup";
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
	var url = "http://www.xn--wmqr18c.cn/ajax/saveac";
	$.post(url,{mailcheck:mailcheck,qqcheck:qqcheck,phonecheck:phonecheck,sign1:sign1,sign2:sign2,righton:righton},function(){ 
    	window.location.href="http://www.xn--wmqr18c.cn/setup/account";
  	});
}
function savest(){
	$("#savest").parent().html('<i class="icon-spinner icon-spin"></i> 正在保存');
	var namecolor = $("#namecolor").val();
	var autoon = $("#autoon").is(':checked')?1:0;
	var url = "http://www.xn--wmqr18c.cn/ajax/savest";
	$.post(url,{namecolor:namecolor,autoon:autoon},function(){ 
    	window.location.href="http://www.xn--wmqr18c.cn/setup/star";
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
	$.post("http://www.xn--wmqr18c.cn/ajax/addlove",{lover:lover,lovee:lovee,love:love},function(){
		window.location.href=window.location.href;
	})
	$("#lovebox").html('<i class="icon-spinner icon-spin"></i> 正在处理');
}
function deletelove(lover,lovee,love){
	$.post("http://www.xn--wmqr18c.cn/ajax/deletelove",{lover:lover,lovee:lovee,love:love},function(){
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
	$.post("http://www.xn--wmqr18c.cn/ajax/addfocus",{focuser:focuser,focusee:focusee,focuss:focuss},function(str){
		alert(str);
		window.location.href=window.location.href;
	})
	$("#focusbox").html('<i class="icon-spinner icon-spin"></i> 正在处理');
}
function deletefocus(focuser,focusee,focuss){
	$.post("http://www.xn--wmqr18c.cn/ajax/deletefocus",{focuser:focuser,focusee:focusee,focuss:focuss},function(){
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
		$.post("http://www.xn--wmqr18c.cn/ajax/show_user_page",{tab:tab,uid:uid,page:page},function(gethtml){
        	$(objstr).html(gethtml);
		})
		$(objstr).html('<center><i class="icon-spinner icon-spin"></i> 正在加载</center>');
	}
}
function gotocomm(uid){
	$('#mycommlink').tab('show');
	if($("#mycomm").html()==''){
		$.post("http://www.xn--wmqr18c.cn/ajax/show_user_page",{tab:5,uid:uid,page:1},function(gethtml){
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
	$.post("http://www.xn--wmqr18c.cn/ajax/addcomment",{user_id:user_id,subject_id:subject_id,ctype:ctype,cscore:cscore,ccontent:ccontent},function(){
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
	$.post("http://www.xn--wmqr18c.cn/ajax/addreport",{object_id:object_id,rtype:rtype,rcontent:rcontent});
}