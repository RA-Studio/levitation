var iOS = navigator.userAgent.match(/iPhone|iPad|iPod/i);
var event = "click";

/*if (iOS != null)
	event = "touchend";
*/
$(document).ready(function () {
	$('.good-content-sizes').each(function (index, element) {

	});

	/*Def скрипты
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
	$(document).on(event, '#search-btn > a', function (e) {
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

	/*Слайдер Карточка товара*/
	if (screen.width < 768) {
		$(document).find('.good-gallery__close').remove();
		$(document).find('.good-gallery').slick({
			arrows: false,
			slidesToShow: 1,
			dots: true
		});
	}
	/*Слайдер Карточка товара Конец*/


	/*Табы*/
	$(document).on('click', '.lk-nav__item', function (e) {
		e.preventDefault();
		let tabContainers = $(this).closest('.tabs').find('.lk-tab');
		tabContainers.removeClass('active');
		tabContainers.filter(this.hash).addClass('active');
		$(this).closest('.tabs').find('.lk-nav__item').removeClass('active');
		$(this).addClass('active');
	});
	/*Табы Конец*/

	scrollwindow();
	resizewindow();
	$(window).resize(function(e){
		resizewindow();
	});
	$(window).scroll(function () {
		scrollwindow();
	});
});

function resizewindow() {
	let vh = window.innerHeight * 0.01;
  	document.documentElement.style.setProperty('--vh', `${vh}px`);
}

/*Фильтр*/
if (screen.width > 767) {
	$(document).on(event, '.main-filters__title', function (e) {
		$(document).find('.main-filters__clear').fadeToggle();
		$(document).find('.main-filters-categories').slideToggle();
		$(this).toggleClass('active');
	});
} else {
	$(document).on(event, '.main-filters__title', function (e) {
		$(document).find('.main-filters-categories-wrap').slideToggle();
		$(this).toggleClass('active');
	});
	$(document).on(event, '.main-filters-categories__title', function (e) {
		$(this).next().slideToggle();
	});
}

/*Фильтр Конец*/

/*Карточка товара Размеры*/
$(document).on(event, '.good-content-sizes__item', function (e) {
	$('.good-content-sizes__item').removeClass('active');
	$(this).addClass('active');
});
/*Карточка товара Размеры Конец*/

/*Карточка товара Зум*/
if (screen.width > 767) {
	$(document).on(event, '.good-gallery-item img', function (e) {
		$('.good-gallery').addClass('active')
	});
	$(document).on(event, '.good-gallery__close, .good-gallery.active', function (e) {
		$('.good-gallery').removeClass('active')
	});
}
/*Карточка товара Зум Конец*/

/*Бургер меню*/
$(document).on(event, '.header__burger', function (e) {
	$('.header-menu').addClass('active');
	$('.overlay').fadeIn();
	$('html, body').css({
		'overflow': 'hidden',
		'height': '100%'
	});
});
$(document).on(event, '.header-menu__close, .overlay', function (e) {
	$('.header-menu').removeClass('active');
	$('.overlay').fadeOut();
	$('html, body').css({
		'overflow': 'auto',
		'height': 'auto'
	});
});
/*Бургер меню Конец*/

/*Карточка товара Скролл*/
function scrollwindow() {
	if (screen.width > 767) {
		let goodBlock = $(document).find('.good')[0],
			goodInfo = $(document).find('.good-content')[0];
		if (goodBlock && goodInfo) {
			if (goodBlock.getBoundingClientRect().bottom <= goodInfo.getBoundingClientRect().bottom) {
				goodInfo.classList.add('absolute');
			}
			if ((window.innerHeight - goodInfo.offsetHeight) / 2 < goodInfo.getBoundingClientRect().top) {
				goodInfo.classList.remove('absolute');
			}
		}
	}
}
/*Карточка товара Скролл Конец*/


$(document).ready(function () {

  $('.good-content-color-view').each(function () {
    $('.good-content-colorWrap').each(function () {
      $(this).find('.good-content-color-view').find('span').attr('style', $(this).find('.good-content-color').find('.good-content-color__item.selected').find('span').attr('style'));
      $(this).find('.good-content-color-view').find('.good-content-color-view__color').text($(this).find('.good-content-color').find('.good-content-color__item.selected').text().trim());
    })
  })



  $(document).on('click', '.good-content-color-view__btn', function () {
    $(this).closest('.good-content-color-view').siblings('.good-content-color').slideToggle('fast');
  })

  $(document).on('click', '.good-content-color__item', function () {
    $(this).closest('.good-content-color').siblings('.good-content-color-view').find('span').attr('style', $(this).find('span').attr('style'));
    $(this).closest('.good-content-color').siblings('.good-content-color-view').find('.good-content-color-view__color').text($(this).text().trim());
    $(this).closest('.good-content-color').slideUp('fast');
  })
})
$(document).on('change', '.lk-tab #email', function (e) {
		$(this).siblings('#login').val($(this).val());
});




function basketHeight() {
  if($('.basket-content-aside').length && $('.basket-content-main').length){
    $('.basket-content-main').css('min-height', $('.basket-content-aside').outerHeight() - 100);
  }
}

$(document).ready(function () {
  basketHeight();
})

$(window).resize(function () {
  basketHeight();
})