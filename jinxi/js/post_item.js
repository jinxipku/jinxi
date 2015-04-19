$("div#post_items_box div.post_item_user_need").bind("mouseover", function() {
	$(this).find("button").show();
});
$("div#post_items_box div.post_item_user_need").bind("mouseout", function() {
	$(this).find("button").hide();
});
$("div#post_items_box div.post_item_description").bind("mouseover", function() {
	$(this).siblings().find("button").show();
});
$("div#post_items_box div.post_item_description").bind("mouseout", function(e) {
	$(this).siblings().find("button").hide();
});

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