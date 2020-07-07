/************************************** on blur ******************************************/

/*
 *
 *
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
*/

/******************** Навешиваем маски на data-type="tel" и data-type="email" ****************/
$(document).ready(function () {
	$(document).find('[data-type="tel"]').inputmask({
		mask: "+7 (999) 999-99-99",
		showMaskOnHover: false,
		showMaskOnFocus: true
  });
  

  
  $('[data-type="email"]').each(function(){
    if($(this).attr('data-regexp') === undefined){
      $(this).inputmask({ 
        alias: "email",
        showMaskOnHover: false,
        showMaskOnFocus: true
      })
    } 
  })
  

  /*
	$(document).find('[data-type="email"]').inputmask({ 
		alias: "email",
		showMaskOnHover: false,
		showMaskOnFocus: true
  });*/
});

var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;

/********************** Убирая фокус с текстовых инпутов без data-required подсвечиваем бордер, если заполнено. Убираем подсветку, если пусто *************/
$(document).on('blur', 'input:not(input[data-type="tel"]):not(input[data-type="email"]), textarea', function(){
  
    if( $(this).val() != '' ){
        $(this).addClass('input-border');
        
    } else {
        $(this).removeClass('input-border');
    }

   
});

$(document).on('blur', 'input, textarea', function(){
  if($(this).val() != ''){
    $(this).parent().find('label:not(.general-itemInput__check)').addClass('general-itemInput__label_top');
  } else {
    $(this).parent().find('label:not(.general-itemInput__check)').removeClass('general-itemInput__label_top');
  }
})


/************************ Подсветка ошибки в текстовых полях с data-required **********************/


/*********************** Убирая фокус с data-type="tel" и data-type="email" подсветка **********************/
$(document).on('blur', 'input[data-type="tel"], input[data-type="email"]', function(){
  if ($(this).attr('data-required') !== undefined){

    if($(this).attr('data-regexp') !== undefined){
      if ($(this).val() != '') {
        if ($(this).val().search(pattern) == 0) {
          $(this).removeClass('input-err');   
          $(this).addClass("input-border");
        } else {
          $(this).addClass('input-err');
          $(this).removeClass("input-border");
        }
      } else {
        $(this).removeClass('input-err');
        $(this).removeClass("input-border");
      }
    } else {
      if (!$(this).inputmask("isComplete")) {
        $(this).addClass("input-err");
        $(this).removeClass("input-border");
      } else {
        $(this).removeClass("input-err");
        $(this).addClass("input-border");
      }
      if ($(this).val() == '') {
        $(this).removeClass("input-err");
        $(this).removeClass("input-border");
      }
    }

  } else {
    if($(this).attr('data-regexp') !== undefined){
      if ($(this).val().search(pattern) == 0) {
        $(this).addClass("input-border");
      } else {
        $(this).removeClass("input-border");
      }
    } else {
      if (!$(this).inputmask("isComplete")) {
        $(this).removeClass("input-border");
      } else {
        $(this).addClass("input-border");
      }
    }
  }
});

/******************* Функция валидации ******************/
$(document).on('click', 'button[type="submit"]', function(e){
  e.preventDefault();
  if(!raValidation($(this).closest('form'))){
    return false;
  } else {
    $(this).closest('form').submit();

  }
});
/* Эта функция вставляется в обработчик события клика по submit в таком виде:  
  внутри функции клика на отправку
      if(!raValidation($(this).closest('form'))){
          return false;
      }
 *
 * 
 * 
 * 
*/

function raValidation (form){
  let inputs = form.find('[data-required=""]'),
    temp = true;
  for (var i = 0; i < inputs.length; i++) {
    if ( !inputs.eq(i).hasClass('input-border') ) {
      inputs.eq(i).addClass('input-err');
      temp = false;
    } else {
      inputs.eq(i).removeClass('input-err');
    }
  }
  if( temp == false ){
    return false;
  } else {
    return true;
  }
  
}

/******************* Функция для sucsess *********************/
function ifSuccess(form) {
  form.find('input, textarea, button').attr('disabled', 'disabled');
  setTimeout(function(){
    form.find('input, textarea').val('').removeClass('input-border');
    form.find('.general-itemInput__label_top').removeClass('general-itemInput__label_top');
    form.find('input, textarea, button').removeAttr('disabled');
  }, 2000);
}

/******************* Функция для error *****************/
function ifError(form) {
  form.find('input, textarea, button').attr('disabled', 'disabled');
  setTimeout(function(){
    form.find('input, textarea, button').removeAttr('disabled');
  }, 2000);
}

/******************** Очистим форму ******************/
$('button[data-type="cleanForm"]').click(function(e){
  e.preventDefault();
  $(this).closest('form').find('input, textarea').prop('checked', false).removeClass('input-err').removeClass('input-border').val('');
});

/******************** Добавить файл ******************/
$(document).on('change', 'input[type=file]', function(){
  let i = 0,
      inp = this,
      files1 = inp.files,
      len = files1.length,
      forma = $(this).closest('form');
  forma.find('.general-itemInput_file__label').fadeOut('fast');
  setTimeout (() => {
    for (; i < len; i++) {
      forma.find('.general-itemInput-box').append('<p class="general-itemInput-box__item">' + $(this)[0].files[i].name + '</p>');
    }
    forma.find('.general-itemInput__exit').fadeIn('fast');
  }, 200)
});


/******************** Удалить файл ******************/
$(document).on('click', '.general-itemInput__exit', function(){
  $(this).closest('form').find('.general-itemInput_file__label').fadeIn();
  $(this).fadeOut();
  $(this).closest('form').find('.general-itemInput-box p').remove();

  $(this).closest('form').find('input[type=file]').files = [];
})