var baseurl = "http://www.xn--wmqr18c.cn/";
$(document).ready(function(){
	$(".admin_panel").hide();
	$("#info").show();
	$("#operation a").click(function(){
		var tab = $(this).attr("linkedtab");
		$(".admin_panel").hide();
		$("#"+tab).show();
		$("#operation a").removeClass("active");
		$(this).addClass("active");
	});
	$("#get_report_btn").click(function(){
		get_report(1);
	});
	$("#user_advice_btn").click(function(){
		get_user_advice(1);
	});
	$("#logout").click(function(){
		log_out();
	});
	$("#appoint_btn").click(function(){
		appoint();
	});
	$("#delete_post").click(function(){
		delete_post();
	});
	$("#delete_reply").click(function(){
		delete_reply();
	});
	
});
function log_out(){
	$.ajax({
		type:"post",
		url:baseurl+"admin/dologout",
		dataType:"json",
		success:function(data){
			window.location.href = baseurl+"admin/index";
		},
		error:function(data){

		}
	});
}
function appoint(){
	$.ajax({
		type:"post",
		url:baseurl+"admin/appoint",
		dataType:"json",
		data:{
			admin_name:$("#admin_name").val(),
			password:$("#password").val(),
			auth_level:$("#auth_level").val(),
			school_id:$("#school_id").val(),
		},
		success:function(data){
			if(data.status==1){
				alert("任命成功！");
			}else{
				alert("任命失败！");
			}
		},
		error:function(data){
			alert("任命失败！");
		}
	});
}
function get_report(page){
	$.ajax({
		type:"post",
		url:baseurl+"admin/get_report_info",
		dataType:"json",
		data:{
			page:page
		},
		success:function(data){
			$("#report_table tr:first-child() ~ tr").remove();

			var report = data.data; 
			for(var i=0;i<report.length;i++){
				var btn_text = "删除楼层";
				if(report[i].type==0)
					btn_text = "删除帖子";
				$("#report_table").append('<tr><td>'+'<a href="'+report[i].url+'" target="_blank">'+report[i].url_thumb+'</a>'+'</td><td>'+report[i].reason+'</td><td>'+report[i].other_reason+'</td><td>'+'<button class="btn btn-danger" type="button">'+btn_text+'</button><button class="btn btn-danger" type="button">删除举报</button>'+'</td></tr>');
			}
		},
		error:function(data){

		}
	});
}

function get_user_advice(page){
	$.ajax({
		type:"post",
		url:baseurl+"admin/get_advice",
		dataType:"json",
		data:{
			page:page
		},
		success:function(data){
			$("#advice_table tr:first-child() ~ tr").remove();

			var advice = data.data; 
			for(var i=0;i<advice.length;i++){
				$("#advice_table").append('<tr><td>'+advice[i].content+'</td><td>'+advice[i].addat+'</td></tr>');
			}
		},
		error:function(data){

		}
	});
}
function delete_post(){
	$.ajax({
		type:"post",
		url:baseurl+"admin/delete_post",
		dataType:"json",
		data:{
			post_url:$("#delete_post_url").val(),
			reason:$("#delete_reason").val(),
		},
		success:function(data){
			alert(data.info);
		},
		error:function(data){
			alert("删除失败！");
		}
	});
}

function delete_reply(){
	$.ajax({
		type:"post",
		url:baseurl+"admin/delete_reply",
		dataType:"json",
		data:{
			post_url:$("#delete_reply_url").val(),
			floor:$("#delete_floor").val(),
			reason:$("#delete_reply_reason").val(),
		},
		success:function(data){
			alert(data.info);
		},
		error:function(data){
			alert("删除失败！");
		}
	});
}