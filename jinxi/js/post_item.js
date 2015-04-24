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