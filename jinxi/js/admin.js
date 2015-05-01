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
	$("#logout").click(function(){
		log_out();
	});
	$("#appoint_btn").click(function(){
		appoint();
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