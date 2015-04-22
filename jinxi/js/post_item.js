$(".btn-group>button").on('click', function() {
    $(this).siblings().removeClass("active").end().addClass("active");
});

function change2list() {
	$("div#post_items_block").slideUp(500, function() {
		$("div#post_items_box").slideDown(500);
	});
}
function change2block() {
	$("div#post_items_box").slideUp(500, function() {
		$("div#post_items_block").slideDown(500);
	});
}

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