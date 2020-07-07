var iOS = navigator.userAgent.match(/iPhone|iPad|iPod/i);
var event = "click";


function checkCDEK(){
	if (!$('#ID_DELIVERY_ID_42').closest('.bx-soa-pp-company').hasClass('bx-selected')) {
		setTimeout(function () {
			$('.bx-soa-customer [data-property-id-row="6"]').hide();
			$('.bx-soa-customer [data-property-id-row="7"]').hide();
			$('.bx-soa-customer [data-property-id-row="8"]').hide();
		},1000);
	}
}
function getCookie(name) {
	var matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

function createCookie(name, value, days) {
	var expires;

	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		expires = "; expires=" + date.toGMTString();
	} else {
		expires = "";
	}
	document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

$(document).ready(function () {
	var lazyLoadInstance = new LazyLoad({
	    elements_selector: ".lazy"
	});
	checkCDEK();


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

	/*Подписки*/

	if ($('.email-subs').length > 0){
		if(!getCookie('email-subs')){
			setTimeout(() => {
				if (screen.width >= 1024) {
					$('.email-subs_desktop').show();
					$('.email-subs_mobile').hide();
				} else {
					$('.email-subs').css('display', 'flex');
					if ($('.email-subs_mobile').length > 0) {
						console.log(screen.width)
						$('.email-subs_mobile').css('display', 'flex');
						$('.email-subs_desktop').hide();
					} else {
						$('.email-subs_desktop').css('display', 'flex');
					}
				}
				createCookie('email-subs', '1', 15);
			}, 5000);
		}
	}

	if ($('.new-subscribe').length > 0){
		if(!getCookie('new-subscribe')){
			setTimeout(() => {
				$('.new-subscribe').show();
				createCookie('new-subscribe', '1', 15);
			}, 5000);
		}
	}

	/*Подписки*/


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
		/*$("div.good-gallery-item[style='display: none']").remove();*/
		$(document).find('.good-gallery__close').remove();
		$(document).find('[data-entity="images-container"]:not(.slick-initialized)').slick({
			infinite: false,
			arrows: true,
			slidesToShow: 1,
			dots: false,
			prevArrow: '.good-content-nav__prev',
			nextArrow: '.good-content-nav__next'
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
	/*Отмена заказа*/
	$(document).on('click','.lk-orderListNew-item-info-down__cancel',function (e) {
		e.preventDefault();
		$.ajax({
			url: $(this).attr("href"),
			dataType:'html',
			type: 'get',
			success: function(data){
				//$(document).find('#popup-order-cancel').html($(data).html());
				$.fancybox.open('<div class="sizeGuide-popup" id="popup-order-cancel" style="display: none">\n' +$(data).html()+ '</div>');
			}
		});
	});
	/*Отмена заказа конец*/

	if (document.documentElement.clientWidth < 768) {
		var slickClone = 'a.good-gallery-item.slick-slide:not(.slick-cloned)';
		// Init fancybox, skip cloned elements
		$().fancybox({
			selector : slickClone,
			backFocus : false,
			animationEffect : "fade",
			loop : true
		});
	}


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
/*$(document).on(event, '.good-content-sizes__item', function (e) {
	$(this).closest('.good-content-sizes').find('.good-content-sizes__item').removeClass('active');
	$(this).addClass('active');
	if (screen.width < 768) {
		reInitSlick();
	}
});
$(document).on(event, '.good-content-color__item', function (e) {
	if (screen.width < 768) {
		reInitSlick();
	}
});*/
function initSlick(){
	$("div.good-gallery-item").remove();
	$(document).find('[data-entity="images-container"]:not(.slick-initialized)').slick({
		infinite: false,
		arrows: true,
		slidesToShow: 1,
		dots: false,
		prevArrow: '.good-content-nav__prev',
		nextArrow: '.good-content-nav__next'
	});
}
function removeSlick() {
	$(document).find('.good-gallery__close').remove();
	$(document).find('.slick-initialized[data-entity="images-container"]').slick('unslick');
}
function reInitSlick (){
	removeSlick();
	initSlick();
}

/*Карточка товара Размеры Конец*/

/*Карточка товара Зум*/
/*if (screen.width > 767) {
	$(document).on(event, '.good-gallery-item img', function (e) {
		$('.good-gallery').addClass('active')
	});
	$(document).on(event, '.good-gallery__close, .good-gallery.active', function (e) {
		$('.good-gallery').removeClass('active')
	});
}*/
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
	//#lk-acc2
	if($('#lk-acc2').length){
		console.log(window.location.hash);
		let urlHash = window.location.hash;
		if(urlHash == '#lk-acc2'){
			$('.lk-tab').hide();
			$('.lk-nav__item').removeClass('active');
			$('.lk-nav__item[href="#lk-acc2"]').addClass('active');
			$('#lk-acc2').show().css('display', 'flex');
		}
	}

    $('.good-content-color-view').each(function () {
    	$('.good-content-colorWrap').each(function () {
    		$(this).find('.good-content-color-view').find('span').attr('style', $(this).find('.good-content-color').find('.good-content-color__item.selected').find('span').attr('style'));
    		$(this).find('.good-content-color-view').find('.good-content-color-view__color').text($(this).find('.good-content-color').find('.good-content-color__item.selected').text().trim());
    	});
	});

	$(document).on('click', '.good-content-color-view', function () {
    	$(this).siblings('.good-content-color').slideToggle('fast');
	});

	$(document).on('click', '.good-content-color__item', function () {
    	$(this).closest('.good-content-color').siblings('.good-content-color-view').find('span').attr('style', $(this).find('span').attr('style'));
    	$(this).closest('.good-content-color').siblings('.good-content-color-view').find('.good-content-color-view__color').text($(this).text().trim());
    	$(this).closest('.good-content-color').slideUp('fast');
	});
	
	if($( '[data-entity="container-1"]').length){
		var updateCatalog = function(allmutations){
	    // allmutations — массив, и мы можем использовать соответствующие методы JavaScript.
		    allmutations.map( function(mr){
		        var lazyLoadInstance = new LazyLoad({
					elements_selector: ".lazy"
				});
		    });
		},
		updateCatalogElement = document.querySelectorAll('[data-entity="container-1"]')[0],
		updateCatalogObserver = new MutationObserver(updateCatalog),
		updateCatalogOptions = {
		    // обязательный параметр: наблюдаем за добавлением и удалением дочерних элементов.
		    'childList': true,
		    // наблюдаем за добавлением и удалением дочерних элементов любого уровня вложенности.
		    'subtree': true
		}
		updateCatalogObserver.observe(updateCatalogElement, updateCatalogOptions);
	}
	/*Пагинация*/
	$(document).on('click','a.main-pagination__page',function (e) {
		e.preventDefault();
		$.get($(this).attr('href'), { "AJAX_MODE" : "Y"}).done((data) => {
            $(`[data-entity="container-1"]`).html($(data).find(`[data-entity="container-1"]`).html());
			window.scrollTo(0, 0);
        });
	});
	/*пагинация конец*/
  $(document).on('click', '.goodpage-footer-toTop', function (e) {
    e.preventDefault();
    window.history.back();
  })


/* фильтр sticky */

  /*var translateYYY = 0;

  var transformFilter = window.scrollY;
  var heightScreen = $(window).height();

  var topMargin = parseInt($('.content').css('padding-top')) + parseInt($('.main-filters').css('margin-top'));
  $(window).resize(function () {
    transformFilter = window.scrollY;
    heightScreen = $(window).height();
    topMargin = parseInt($('.content').css('padding-top')) + parseInt($('.main-filters').css('margin-top'));

    if(document.documentElement.clientWidth < 1024){
      $('.main-filters').css('transform', 'translateY(0px)');
    }
  })

  $(document).scroll(function(){
    if ($('.main-filters').length && (typeof transformFilter != undefined) && document.documentElement.clientWidth >= 1024){
      var botCoord = document.querySelector('.main-filters').getBoundingClientRect().bottom;
      var topCoord = document.querySelector('.main-filters').getBoundingClientRect().top;
      var heightFilter = $('.main-filters').height();
      var scrollY = window.scrollY;
      var howMuchScroll = transformFilter - scrollY;
      if(((transformFilter < scrollY) && (botCoord > heightScreen - 170)) || ((transformFilter > scrollY) && (topCoord < topMargin))){
        translateYYY += howMuchScroll;
      }
      if(heightFilter > heightScreen - topMargin - 90) {
        $('.main-filters').css('transform', `translateY(${translateYYY}px)`);
      }
      transformFilter = scrollY;
    } else if ($('.main-filters').length) {
      transformFilter = window.scrollY;
    }

  })*/

/* фильтр sticky end */

});
$(document).on('change', '.lk-tab #email', function (e) {
	$(this).siblings('#login').val($(this).val());
});




function basketHeight() {
  if($('.basket-content-aside').length && $('.basket-content-main').length && screen.width > 1200){
    $('.basket-content-main').css('min-height', $('.basket-content-aside').outerHeight() - 100);
  }
}

$(document).ready(function () {
  basketHeight();
})

$(window).resize(function () {
  basketHeight();
})

$(document).on('click', '.bx-soa-cart-total .bx-soa-cart-total-line-total', function () {
	if (screen.width > 767) {
		$(this).toggleClass('active');
		$(this).siblings('.bx-soa-cart-total-line').toggle();
	}
});

$(document).on('click', '.header-menu__parent', function () {
	$(this).next('.header-menu__content').slideToggle().css('display', 'flex');
});

/* подписка на рассылку */

$(document).ready(function(){
	$(document).on('click', '.email-subs__close', function(){
		$(this).closest('form').fadeOut();
	})
	/*$(document).on('click', '.email-subs__btn', function (e) {
		e.preventDefault();
		$('.email-subs__success').fadeIn().css('display', 'flex');
		setTimeout(function () {
			$('.email-subs__success').fadeOut();
		}, 1000)
	})*/
})

/* подписка на рассылку end */



/* страница возврата */

$(document).ready(function () {
  addBasketValue($('#return'));
  $(document).on('change', '.return-label_file input', function(){
    if(this.files.length){
      $(this).closest('.return-label').find('.return-label_success > span').html(this.files[0].name);
      $(this).closest('.return-label_file').fadeOut('fast');
      setTimeout(() => {
        $(this).closest('.return-label').find('.return-label_success').fadeIn('fast').css('display', 'flex');
      }, 200)
    }
  })

  $(document).on('click', '.return-label_success__delete', function(){

    $(this).closest('.return-label').find('input')[0].value = '';

    $(this).closest('.return-label_success').fadeOut('fast');
    setTimeout(() => {
      $(this).closest('.return-label').find('.return-label_file').fadeIn('fast');
    }, 200)


    $(this).closest('.return-label_success').find('span').html('');

  })


  $(document).on('change', '[name="FIELDS[cardIsActive]"]', function () {
    if($(this).val() == 'Моя карта утеряна/заблокирована. Прошу перечислить денежные средства по реквизитам:'){
      $('.return-requisites').slideDown();
      $('.return-requisites input').each(function (e) {
        $(this).attr('required', true);
      })
    } else {
      $('.return-requisites').slideUp();
      $('.return-requisites input').each(function (e) {
        $(this).attr('required', false);
      })
    }
  })
	$(document).on('click','#bx-soa-delivery',function () {
		checkCDEK();
	});
	$(document).on('change', '.return-goods input', function () {
		var form = $(this).closest('form');
		addBasketValue(form);
	})

function addBasketValue(form) {
	var text = '';
	form.find('.return-goods-row').each(function( index ){
		text+=index+')';
		$(this).find('.return-label').each(function (index) {
			text+=$(this).find('p').html()+': '+$(this).find('input').val()+';';
		})
	});
	form.find('[name="FIELDS[BASKET]"]').val(text);
}
  function reInitReturnField() {
    $('.return-goods .return-goods-row').each(function (index) {
      $(this).find('input[name*="goodsArticul"]').attr('name', 'goodsArticul' + index);
      $(this).find('input[name*="goodsName"]').attr('name', 'goodsName' + index);
      $(this).find('input[name*="goodsColor"]').attr('name', 'goodsColor' + index);
      $(this).find('input[name*="goodsReason"]').attr('name', 'goodsReason' + index);
    })

  };

  function addReturnRow() {
    $('.return-goods-addGoods').before(`
        <div class="return-goods-row">
          <label class="return-label">
            <p>Артикул</p>
            <input type="text" required name="goodsArticul">
          </label>
          <label class="return-label">
            <p>Наименование</p>
            <input type="text" required name="googsName">
          </label>
          <label class="return-label">
            <p>Цвет / размер</p>
            <input type="text" required name="goodsColor">
          </label>
          <label class="return-label">
            <p>Причина возврата</p>
            <input type="text" required name="goodsReason">
          </label>
          <div class="return-goods__delete"></div>
        </div>
    `)
    reInitReturnField();
  }

  $(document).on('click', '.return-goods-addGoods', function () {
    addReturnRow();
  })

  $(document).on('click', '.return-goods__delete', function (){
    if ($('.return-goods-row:not(.return-goods-row_title)').length == 1) {
      return
    }
    $(this).closest('.return-goods-row').remove();
    reInitReturnField();
  })
  
  
  $(document).on('click', '.lk-orderListNew-item-info', function(){
    if($(this).closest('.lk-orderListNew-item').hasClass('open')){
      $(this).next().slideToggle();
      $(this).closest('.lk-orderListNew-item').removeClass('open');
      return false;
    }
    $('.lk-orderListNew-item.open').find('.lk-orderListNew-item-goods').slideToggle();
    $('.lk-orderListNew-item.open').removeClass('open');

    $(this).next().slideToggle();
    $(this).closest('.lk-orderListNew-item').addClass('open');
  })
})


/* страница возврата end */

