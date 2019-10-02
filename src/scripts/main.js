$(document).ready(function () {

	/*Блок поиска*/
	$(document).on('click', '#search-btn a', function (e) {
		$(this).siblings('.header-menu__item-search-wrap').toggle();
	});
	$(document).on('click', function (e) {
		var div = $('.header-menu__item-search-wrap');
		if (!div.is(e.target) && div.has(e.target).length === 0 && !$('#search-btn a').is(e.target)) {
			div.hide();
		}
	});
	/*Блок поиска Конец*/

	/*Кнопка Наверх*/
	if ($(this).scrollTop() > 50) {
		$(document).find('.footer-toTop').fadeIn();
	};
	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$(document).find('.footer-toTop').fadeIn();
		} else {
			$(document).find('.footer-toTop').fadeOut();
		}
	});
	$(document).on('click', '.footer-toTop', function (e) {
		$('body,html').animate({ scrollTop: 0 }, 800);
	});
	/*Кнопка Наверх Конец*/

	$(document).find('.banners').slick({
		arrows: false,
		vertical: true,
		verticalSwiping: true,
		focusOnSelect: true,
		slidesToShow: 1,
		autoplay: true,
		autoplaySpeed: 3000,
		speed: 1000,
		variableHeight: true
	});
});