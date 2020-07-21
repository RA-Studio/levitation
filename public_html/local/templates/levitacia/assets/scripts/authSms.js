$(document).ready(function () {
    hashCode = function(s){
        return s.split("").reduce(function(a,b){a=((a<<5)-a)+b.charCodeAt(0);return a&a},0);
    }

   $(document).on('click', '.lk-tab__submit[name="Login"]', function (e) {

       let success = $(this).data('success');
       var form = $(this).closest('form');
       let pass = form.find('[name="USER_PASSWORD"]');
       const email = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
       const phone = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
       let userField = form.find('[name="USER_LOGIN"]').val();
       let emailValid = email.test(userField);
       let phoneValid = phone.test(userField);
       var passLabel = form.find('[for="password"]');

       if(!success){
           e.preventDefault();
           if(emailValid) {
               console.log('email', emailValid);
               form.data('success', true);
               pass.attr('required', true);
               $(this).data('success', true);
               passLabel.html('Пароль:');
               $(this).click();
           } else if (phoneValid) {
               $('#auth_submit').val('Войти');
               $('#password').show();
               $('[for="password"]').show();
               if (pass.attr('required')) {
                   pass.removeAttr('required');
               }
               //passLabel.html('Код:');
               form.submit();
           }
       } else {
           /*if(emailValid) {
               pass.attr('required', true);
           } else if (phoneValid) {
               form.data('success', '');
               pass.removeAttr('required');
           }*/
           //$(this).data('success', '');
           console.log('button', success);
       }
   });
//+79992373291
   $(document).on('submit', '[name="form_auth"]', function (e) {
       var form = $(this);
       let success = form.data('success');

       if(success) {
           console.log('form', success);
       } else {
           e.preventDefault();
           let url = '/local/templates/levitacia/assets/php/authSMS.php';
           let hash = form.data('hash');
           let code = form.find('[name="USER_PASSWORD"]').val();
           var error = form.find('.error');
           var success_auth = form.find('.success_auth');
           var btn = form.find('.lk-tab__submit[name="Login"]');
           btn.attr("disabled", true);
           if(hash.length == 0) {
               let phone = form.find('[name="USER_LOGIN"]').val().replace(/[^\d;]/g, '');
               console.log(phone);
               $.ajax({
                   type: 'POST',
                   url: url,
                   dataType: 'json',
                   data: {
                       phone: phone
                   },
                   success: function(data){
                       if (data.success) {
                           error.fadeOut();
                           form.data('hash', data.hash);
                           success_auth.html(data.response);
                           success_auth.fadeIn();
                       } else {
                           success_auth.fadeOut();
                           error.html(data.response);
                           error.fadeIn();
                       }
                   },
                   error: function(jqXHR, exception){
                       success_auth.fadeOut();
                       console.log(exception);
                       error.html('Ошибка авторизации. Свяжитесь с администратором сайта или попробуйте авторизоваться с помощью E-mail.');
                       error.fadeIn();
                   }
               });
           } else if (code.length > 0){
               $.ajax({
                   type: 'POST',
                   url: url,
                   dataType: 'json',
                   data: {
                       hash: hash,
                       code: code
                   },
                   success: function(data){
                       if (data.success) {
                           form.data('hash', '');
                           error.fadeOut();
                           form.data('success', true);
                           success_auth.html(data.response);
                           success_auth.fadeIn();
                           setTimeout(function () {
                               document.location = '/personal/';
                           }, 1000);
                       } else {
                           error.html(data.response);
                           error.fadeIn();
                       }
                   },
                   error: function(jqXHR, exception){
                       console.log(exception);
                       error.html('Ошибка авторизации. Свяжитесь с администратором сайта или попробуйте авторизоваться с помощью E-mail.');
                       error.fadeIn();
                   }
               });
           }
       }
       setTimeout(function () {
           btn.attr("disabled", false);
       }, 2000);
   })

    $(document).on('submit', '.send_forgot_from', function (e) {
        var form = $(this);
        let formSuccessValid = form.data('success');

        if(formSuccessValid) {
            console.log(formSuccessValid);
        } else {
            e.preventDefault();
            const email = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
            const phone = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
            let userField = form.find('[name="USER_EMAIL"]').val();
            let emailValid = email.test(userField);
            let phoneValid = phone.test(userField);
            var error = form.find('.error');
            var success = form.find('#success_forgot');
            var btn = form.find('[name="send_account_info"]');

            if(emailValid) {
                console.log('email', emailValid);
                form.find('#success_forgot').fadeIn();
                form.data('success', true);
                setTimeout(function () {
                    form.submit();
                }, 2000);
            } else if (phoneValid) {
                console.log('phone', phoneValid);
                let userPhone = userField.replace(/[^\d;]/g, '');
                $.ajax({
                    type: 'POST',
                    url: '/local/templates/levitacia/assets/php/forgotSMS.php',
                    dataType: 'json',
                    data: {
                        phone: userPhone
                    },
                    success: function(data){
                        if (data.success) {
                            setTimeout(function () {
                                document.location = '/personal/forgot/?forgot_password=yes#lk-acc2'
                            }, 1000);
                            btn.attr("disabled", true);
                            error.fadeOut();
                            //form.data('hash', data.response);
                            success.html(data.response);
                            success.fadeIn();
                        } else {
                            success.fadeOut();
                            error.html(data.response);
                            error.fadeIn();
                        }
                    },
                    error: function(jqXHR, exception){
                        console.log(exception);
                        error.html('Ошибка авторизации. Свяжитесь с администратором сайта.');
                        error.fadeIn();
                    }
                });

            }  else {
                console.log(emailValid, phoneValid);
                error.html('Введите валидный номер или email!');
                error.fadeIn();
            }
        }
    })
//NBSkhjA*EnRf
     $(document).on('submit', '.change_forgot_from', function (e) {
        var form = $(this);
        let formSuccessValid = form.data('success');
        let forgotWithPhone = form.data('phoneforgot');

        if(formSuccessValid) {
            console.log(formSuccessValid);
        } else {
            if (forgotWithPhone) {
                e.preventDefault();
                var error = form.find('.error');
                var success = form.find('.success');
                const hash = form.data('hash');
                const code = form.find('[name="USER_CHECKWORD"]').val();
                const userLogin = form.find('[name="USER_EMAIL"]').val();
                const userPassw = form.find('[name="USER_PASSWORD"]').val();
                const userPasswConfirm = form.find('[name="USER_CONFIRM_PASSWORD"]').val();
                const btn = form.find('[name="change_pwd"]');
                if(hash && code.length > 0) {
                    $.ajax({
                        type: 'POST',
                        url: '/local/templates/levitacia/assets/php/forgotSMS.php',
                        dataType: 'json',
                        data: {
                            hash: hash,
                            code: code,
                            userLogin: userLogin,
                            userPassw: userPassw,
                            userPasswConfirm: userPasswConfirm
                        },
                        success: function(data){
                            if (data.success) {
                                btn.attr("disabled", true);
                                form.data('success', true);
                                error.fadeOut();
                                form.data('hash', '');
                                form.data('phoneforgot', '');
                                success.html(data.response);
                                success.fadeIn();
                                setTimeout(() => {
                                    document.location = '/personal/';
                                }, 2000);

                            } else {
                                error.html(data.response);
                                error.fadeIn();
                            }
                        },
                        error: function(jqXHR, exception){
                            console.log(exception);
                            error.html('Ошибка авторизации. Свяжитесь с администратором сайта.');
                            error.fadeIn();
                        }
                    });
                } else {
                    error.html('Что-то пошло не так! Перейдите на форму "Выслать данные" и отправьте заново!');
                    error.fadeIn();
                }
            } else {
                form.data('success', true);
                form.submit();
            }
        }
    })
});