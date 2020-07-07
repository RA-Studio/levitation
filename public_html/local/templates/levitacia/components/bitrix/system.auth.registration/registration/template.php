<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>
<?/*
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<?if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
	<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?endif;?>

<?if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
<noindex>

<?if($arResult["SHOW_SMS_FIELD"] == true):?>

<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="regform">
<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
<table class="data-table bx-registration-table">
	<tbody>
		
			<span class="starrequired">*</span><?echo GetMessage("main_register_sms_code")?>
			<input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" />
		
	</tbody>
	<tfoot>
		
			
			<input type="submit" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" />
		
	</tfoot>
</table>
</form>

<script>
new BX.PhoneAuth({
	containerId: 'bx_register_resend',
	errorContainerId: 'bx_register_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?=CUtil::PhpToJSObject([
			'signedData' => $arResult["SIGNED_DATA"],
		])?>,
	onError:
		function(response)
		{
			var errorDiv = BX('bx_register_error');
			var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
			}
			errorDiv.style.display = '';
		}
});
</script>

<div id="bx_register_error" style="display:none"><?ShowError("error")?></div>

<div id="bx_register_resend"></div>

<?elseif(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
*/?>
<form method="post" class="lk-tab" id="lk-acc2" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
    <?if (strlen($arResult["BACKURL"]) > 0){?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?}?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="REGISTRATION" />


			<span class="starrequired">*</span><?=GetMessage("AUTH_LOGIN_MIN")?>
			<input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" class="bx-auth-input" />

			<span class="starrequired">*</span><?=GetMessage("AUTH_PASSWORD_REQ")?>
			<input type="password" name="USER_PASSWORD" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
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


    <label class="lk-tab__label" for="pass"><?=GetMessage("AUTH_CONFIRM")?></label>
    <input class="lk-tab__input bx-auth-input" autocomplete="off" type="password" id="pass" name="USER_CONFIRM_PASSWORD" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" placeholder="" required="">
    <?if ($arResult["USE_CAPTCHA"] == "Y")
    {
        ?>
        <label class="lk-tab__label" for="pass"><?=GetMessage("CAPTCHA_REGF_TITLE")?>:</label>
        <input class="lk-tab__input" type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
        <img class="lk-tab__label" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
        <label class="lk-tab__label" for="pass"><?=GetMessage("CAPTCHA_REGF_PROMT")?>:</label>
        <input class="lk-tab__input" type="text" name="captcha_word" maxlength="50" value="" />
        <?
    }?>
    <label for="create-privacy" class="lk-tab__rowlabel">
        <input id="create-privacy" name="create-privacy" type="checkbox" checked>
        <span></span>
        <span>Я прочитал политику конфиденциальности</span>
    </label>
    <input class="lk-tab__submit" type="submit" name="Register" value="Создать" />
    <p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
</form>

<script type="text/javascript">
document.bform.USER_NAME.focus();
</script>

<?//endif?>

</noindex>
