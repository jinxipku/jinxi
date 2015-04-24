$(".btn-group>button").on('click', function() {
    $(this).siblings().removeClass("active").end().addClass("active");
});

function change2list() {
	document.cookie="post_list_display_type=0";
	$("div#post_items_block").slideUp(500, function() {
		$("div#post_items_box").slideDown(500);
	});
}
function change2block() {
	document.cookie="post_list_display_type=1";
	$("div#post_items_box").slideUp(500, function() {
		$("div#post_items_block").slideDown(500);
	});
}

var post_list_display_type = document.cookie.split(";")[0].split("=")[1];
if (post_list_display_type == 0)
	$(".btn-group>button:nth-child(1)").click();
else
	$(".btn-group>button:nth-child(2)").click();