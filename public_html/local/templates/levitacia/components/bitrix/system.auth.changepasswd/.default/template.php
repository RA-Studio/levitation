<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arResult["PHONE_REGISTRATION"])
{
    CJSCore::Init('phone_auth');
}
if ($GLOBALS['CHANGE_PASSWORD']){
    header('Refresh: 5; URL='.$arParams['SUCCESS_PAGE']);
}

?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>

<form class="lk-tab change_forgot_from" id="lk-acc2" method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform"
      data-hash="<?=$_SESSION['USER_USER_CHECKWORD']?>" data-success="<?=$GLOBALS['CHEK']?>" data-phoneforgot="<?=$_SESSION['USER_USER_CHECKWORD']?true:''?>">
    <?if (strlen($arResult["BACKURL"]) > 0): ?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <? endif ?>
    <input type="hidden" name="AUTH_FORM" value="Y">
    <input type="hidden" name="TYPE" value="CHANGE_PWD">
    <label class="lk-tab__label" for="email"><?=GetMessage("AUTH_LOGIN")?> (E-mail)</label>
    <input class="lk-tab__input" type="text" id="email" name="USER_EMAIL" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>" required="">
    <input class="lk-tab__input" type="text" id="login" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>" required="" hidden="">
    <label class="lk-tab__label" for="checkword"><?=GetMessage("AUTH_CHECKWORD")?></label>
    <input class="lk-tab__input" type="pass" id="checkword" name="USER_CHECKWORD" value="<?=$arResult["USER_CHECKWORD"]?>" placeholder="Проверочный код" required="">
    <div class="error" style="color: darkred; display: none;"></div>
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
    <?if ($GLOBALS['CHANGE_PASSWORD']){
        ?><div class="lk-block__text"><?ShowMessage('Пароль успешно изменен!')?></div><?
    }
    ?>
    <div class="lk-block__text success" style="display: none; color: red"><?ShowMessage('Пароль успешно изменен!')?></div>
    <input class="lk-tab__submit" type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />
</form>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
