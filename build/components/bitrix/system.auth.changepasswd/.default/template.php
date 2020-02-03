<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<?/*
<form >
    <label for="email" class="lk-tab__label">Email</label>
    <input type="text" class="lk-tab__input" name="email" id="email" placeholder="">
    <label for="pass" class="lk-tab__label">Пароль</label>
    <input type="text" class="lk-tab__input" name="pass" id="pass" placeholder="">
    <label for="remember" class="lk-tab__rowlabel">
        <input type="checkbox" id="remember" name="remember">
        <span></span>
        <span>Запомнить меня</span>
    </label>
    <button class="lk-tab__submit">Создать</button>
</form>
*/?>
<form class="lk-tab" id="lk-acc2" method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
    <?if (strlen($arResult["BACKURL"]) > 0): ?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <? endif ?>
    <input type="hidden" name="AUTH_FORM" value="Y">
    <input type="hidden" name="TYPE" value="CHANGE_PWD">
    <label class="lk-tab__label" for="email"><?=GetMessage("AUTH_LOGIN")?> (E-mail)</label>
    <input class="lk-tab__input" type="text" id="email" name="USER_EMAIL" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>" required="">
    <input class="lk-tab__input" type="text" id="login" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>" required="" hidden="">
    <label class="lk-tab__label" for="checkword"><?=GetMessage("AUTH_CHECKWORD")?></label>
    <input class="lk-tab__input" type="pass" id="checkword" name="USER_CHECKWORD" value="<?=$arResult["USER_CHECKWORD"]?>" placeholder="Праверочный код" required="">
    <label class="lk-tab__label" for="password"><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?></label>
    <input class="lk-tab__input" type="password" id="password" name="USER_PASSWORD" value="<?=$arResult["USER_PASSWORD"]?>" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_REQ")?>" required="">
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
    <label class="lk-tab__label" for="pass"><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?></label>
    <input class="lk-tab__input" id="pass" type="password" name="USER_CONFIRM_PASSWORD" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?>" required="">
    <?if($arResult["USE_CAPTCHA"]):?>
        <input class="lk-tab__input" type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
        <img class="lk-tab__label" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
        <label class="lk-tab__label" for=""><?echo GetMessage("system_auth_captcha")?></label>
        <input class="lk-tab__input" type="text" name="captcha_word" maxlength="50" value="" />
    <?endif?>
    <div class="lk-block__text"><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></div>
    <input class="lk-tab__submit" type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />
</form>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>