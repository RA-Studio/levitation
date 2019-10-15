var iOS = navigator.userAgent.match(/iPhone|iPad|iPod/i);
var event = "click";

if (iOS != null)
	event = "touchend";

$(document).ready(function () {

	/*Def скрипты*/
	if (document.title == 'Корзина') {
		$(document).find('.banners').hide();
	}
	if (document.title == '404') {
		$(document).find('.banners, .footer, .header-menu').hide();
	}
	if (document.title == 'Концепт карточка') {
		$(document).find('.banners').hide();
	}
	/*Def скрипты Конец*/

	/*Блок поиска*/
	$(document).on(event, '#search-btn a', function (e) {
		e.preventDefault();
		$(this).siblings('.header-menu__item-search-wrap').toggle();
	});
	$(document).on(event, function (e) {
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
	$(document).on(event, '.footer-toTop', function (e) {
		$('body,html').animate({ scrollTop: 0 }, 800);
	});
	/*Кнопка Наверх Конец*/

	/*Слайдер баннеры*/
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
	/*Слайдер баннеры Конец*/

});

/*Фильтр*/
$(document).on(event, '.main-filters__title', function (e) {
	$(this).siblings('.main-filters__clear').fadeToggle();
	$(this).siblings('.main-filters-categories').slideToggle();
	$(this).toggleClass('active');
});
/*Фильтр Конец*/

/*Карточка товара Размеры*/
$(document).on(event, '.good-content-sizes__item', function (e) {
	$('.good-content-sizes__item').removeClass('active');
	$(this).addClass('active');
});
/*Карточка товара Размеры Конец*/

/*Карточка товара Зум*/
$(document).on(event, '.good-gallery-item img', function (e) {
	$('.good-gallery').addClass('active')
});
$(document).on(event, '.good-gallery__close, .good-gallery.active', function (e) {
	$('.good-gallery').removeClass('active')
});
/*Карточка товара Зум Конец*/