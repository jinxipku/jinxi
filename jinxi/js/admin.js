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
	})
	
});
function get_report(page){
	$("#report_table tr:first-child() ~ tr").remove();
	$.ajax({
		type:"post",
		url:baseurl+"admin/get_report_info",
		dataType:"json",
		data:{
			page:page
		},
		success:function(data){
			var report = data.data; 
			for(var i=0;i<report.length;i++){
				$("#report_table").append('<tr><td>'+'<a href="'+report[i].url+'" target="_blank">'+report[i].url_thumb+'</a>'+'</td><td>'+report[i].floor+'</td><td>'+report[i].content+'</td><td>'+report[i].reason+'</td><td>'+report[i].other_reason+'</td><td>'+'<button class="btn btn-danger" type="button">删除回复</button><button class="btn btn-danger" type="button">删除举报</button>'+'</td></tr>');
			}
		},
		error:function(data){

		}
	});
}