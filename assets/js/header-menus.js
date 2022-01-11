jQuery(document).ready(function ($) {
	$('.burger-menu').click(function () {
		$(this).toggleClass('change');
		$('.mobile-menu').toggleClass('is-open');
		$('body').toggleClass('lock-scroll');
	});

	function dropdown() {
		$(this).toggleClass('rotate--down');
		$(this).find('.sub-menu').stop().slideToggle();
	}

	$('.mobile-menu .menu-item-has-children').click(dropdown);

	$('.desktop-menu .menu-item-has-children').hover(dropdown);
});
