<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>
<noindex>
        <form name="form_auth" id="lk-acc1" class="lk-tab active" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" data-hash="" data-success="">
            <input type="hidden" name="AUTH_FORM" value="Y"/>
            <input type="hidden" name="TYPE" value="AUTH"/>
            <?if (strlen($arResult["BACKURL"]) > 0):?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <?foreach ($arResult["POST"] as $key => $value):?>
                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach?>
            <label class="lk-tab__label" for="email">E-mail:</label>
            <input class="lk-tab__input" type="text" id="email" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="" required="">
            <label class="lk-tab__label" for="password"><?=GetMessage("AUTH_PASSWORD")?></label>
            <div class="error" style="color: darkred; display: none;"></div>
            <input class="lk-tab__input" type="password" id="password" name="USER_PASSWORD" value="" placeholder="" required="">
            <div class="lk-tab__label success_auth" style="display: none"></div>
            <?if($arResult["SECURE_AUTH"]):?>
                <span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                    <div class="bx-auth-secure-icon"></div>
                </span>
                <noscript>
                    <span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
                        <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                    </span>
                </noscript>
                <script type="text/javascript">
                    document.getElementById('bx_auth_secure').style.display = 'inline-block';
                </script>
            <?endif?>
            <?if($arResult["CAPTCHA_CODE"]):?>
                <input class="lk-tab__input" type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA"/>
                <label class="lk-tab__label" for="pass"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></label>
                <input class="lk-tab__input" type="text" name="captcha_word" maxlength="50" value="" size="15" />
            <?endif;?>
            <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
                <label for="USER_REMEMBER" class="lk-tab__rowlabel">&nbsp;
                    <input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" />
                    <span></span>
                    <span><?=GetMessage("AUTH_REMEMBER_ME")?></span>
                </label>
            <?endif?>
            <a href="/personal/forgot/<?//=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" class="lk-form__forgot" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
            <?if ($_GET['login']=='yes'){?>
                <div class="lk-form__forgot" style="color: darkred">Логин или пароль введены неверно! Попробуйте еще раз. </div>
            <?}?>
            <input type="submit" class="lk-tab__submit" id="auth_submit"  name="Login" data-success="" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
                <div class="auth-text"> или</div>
                <a href="/personal/login/" class="lk-tab__submit mail-auth">
                    Войти по телефону
                </a>
            <?if($arResult["AUTH_SERVICES"]):?>
                <div class="lk-block__title">Можно войти через соц. сети</div>
                <svg class="lk-form_line" width="51" height="1" viewBox="0 0 51 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line y1="0.5" x2="51" y2="0.5" stroke="#747474"></line>
                </svg>
                <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "socAuth",
                    array(
                        "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                        "CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
                        "AUTH_URL" => $arResult["AUTH_URL"],
                        "POST" => $arResult["POST"],
                        "SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
                        "FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
                        "AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
                        "SHOW_ERRORS" => "Y",
                    ),
                    $component,
                    array("HIDE_ICONS"=>"N")
                );?>
            <?endif?>
        </form>
</noindex>
<script type="text/javascript">

    /* $('#auth_submit').on('click',function (e) {
         e.preventDefault();
         var _this = $(this);
         $.ajax({
             type: 'post',
             data: 'TRY_LOGIN=Y',
             success: function(data){
                 console.log($(data).find('pre').html());

                 _this.closest('form').submit();
             }
         });
    });*/
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

