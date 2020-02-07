<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<form class="lk-tab active" id="lk-acc1" name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>"
>
    <?if (strlen($arResult["BACKURL"]) > 0){?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?}?>
    <input type="hidden" name="AUTH_FORM" value="Y">
    <input type="hidden" name="TYPE" value="SEND_PWD">
    <label class="lk-tab__label" for="email"><?=GetMessage("AUTH_EMAIL")?></label>
    <input class="lk-tab__input" type="email" id="email" name="USER_EMAIL" value="" placeholder="" required="">
    <?if($arResult["USE_CAPTCHA"]):?>
        <input class="lk-tab__input" type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
        <img class="lk-tab__label" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
        <label class="lk-tab__label" for="pass"><?echo GetMessage("system_auth_captcha")?></label>
        <input class="lk-tab__input" type="text" name="captcha_word" maxlength="50" value="" />
    <?endif?>
    <input class="lk-tab__submit" type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
</form>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
