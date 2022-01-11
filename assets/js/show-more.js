jQuery(document).ready(function ($) {
	const postItem = $('.posts-grid .posts-item');
	const size_li = postItem.size();
	let x = 6;
	let toBeSeen = 4;

	$('.posts-grid .posts-item:lt(' + x + ')').show();
	$('#loadMore').click(function () {
		x = x + toBeSeen <= size_li ? x + toBeSeen : size_li;

		$('.posts-grid .posts-item:lt(' + x + ')').show();
	});
	$('#showLess').click(function () {
		x = x - toBeSeen < 0 ? 6 : x - toBeSeen;

		postItem.not(':lt(' + x + ')').hide();
	});
});
