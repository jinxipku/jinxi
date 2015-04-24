$("button.btn_cancel_love").unbind();
$("button.btn_cancel_love").bind('click', function() {
	var thisbtn = $(this);
	$("#info_modal").find('.modal-title').text("取消关注");
	$("#info_modal").find('.modal-cont').text("您确定要取消关注该用户吗？");
	$("#info_modal").find('.btn-primary').unbind();
	$("#info_modal").find('.btn-primary').bind('click',function() {
		$("#info_modal").modal('hide');
		setTimeout(function() {
			$.post(
				baseurl + "user/delete_love",
				{
					lovee: thisbtn.attr('data-uid')
				},
				function(res) {
					if (res.status == 1) {
						$("#info_modal").find('.modal-title').text("取消关注成功");
						$("#info_modal").find('.modal-cont').text("恭喜，取消关注成功！");
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
						thisbtn.html('已关注');
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
$("button.btn_cancel_love").bind('mouseover', function() {
	$(this).html('&nbsp;- 取消');
});
$("button.btn_cancel_love").bind('mouseout', function() {
	$(this).html('已关注');
});