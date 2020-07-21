<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?ShowError($arResult["strProfileError"]);?>
<?if ($arResult['DATA_SAVED'] == 'Y') ShowNote(GetMessage('PROFILE_DATA_SAVED')); ?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->
var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
    <div class="lk-tab tab-wide" id="lk-info2">
        <form
                class="lk-form profile"
                method="post"
                name="form1"
                action="<?=$arResult["FORM_TARGET"]?>"
                enctype="multipart/form-data"
        >
        <?=$arResult["BX_SESSION_CHECK"]?>
        <input type="hidden" name="lang" value="<?=LANG?>" />
        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
                <div class="tab-wide-col">
                    <label class="lk-tab__label" for="surname"><?=GetMessage('LAST_NAME')?></label>
                    <input class="lk-tab__input" type="text" id="surname" name="LAST_NAME" value="<?=$arResult["arUser"]["LAST_NAME"]?>" placeholder="">
                    <label class="lk-tab__label" for="name"><?=GetMessage('NAME')?></label>
                    <input class="lk-tab__input" type="text" id="name" name="NAME" value="<?=$arResult["arUser"]["NAME"]?>" placeholder="">
                    <label class="lk-tab__label" for="middlename"><?=GetMessage('SECOND_NAME')?></label>
                    <input class="lk-tab__input" type="text" id="middlename" name="SECOND_NAME" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" placeholder="">
                    <label class="lk-tab__label" for="tel"><?=GetMessage('USER_PHONE')?></label>
                    <input class="lk-tab__input" type="tel" id="tel" name="PERSONAL_PHONE" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" placeholder="+7 (___) ___-__-__">
                    <input class="lk-tab__submit" type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">&nbsp;&nbsp;
                </div>
                <div class="tab-wide-col">
                    <label class="lk-tab__label" for="email"><?=GetMessage('EMAIL')?></label>
                    <input class="lk-tab__input" type="text" id="email" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" placeholder="" required="">
                    <input class="lk-tab__input" type="text" id="login" name="LOGIN" value="<? echo $arResult["arUser"]["LOGIN"]?>" placeholder="" required="" hidden="">
                    <?if($arResult['CAN_EDIT_PASSWORD']):?>
                            <label class="lk-tab__label" for="pass"><?=GetMessage('NEW_PASSWORD_REQ')?></label>
                            <input class="lk-tab__input" id="pass" type="password" name="NEW_PASSWORD" autocomplete="off" value="" placeholder="">
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
                    <?endif;?>
                        <label class="lk-tab__label" for="password"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
                        <input class="lk-tab__input" type="password" id="password" name="NEW_PASSWORD_CONFIRM" autocomplete="off" value="" placeholder="">
                    <p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
                </div>
        </form>
        <div class="lk-tab-bonus">
            <span>Мои бонусные баллы:</span><?
            $dbAccountCurrency = CSaleUserAccount::GetList(
                array(),
                array("USER_ID" => $arResult["arUser"]['ID']),
                false,
                false,
                array("CURRENT_BUDGET", "CURRENCY")
            );
            //if($dbAccountCurrency){
                if ($arAccountCurrency = $dbAccountCurrency->Fetch())
                {
                    ?><span><?=SaleFormatCurrency($arAccountCurrency["CURRENT_BUDGET"],$arAccountCurrency["CURRENCY"])?></span><?
                }else{
                    ?><span><?=SaleFormatCurrency(0,'RUB')?></span><?
                }
        ?></div>
    </div>
<?if($arResult["SOCSERV_ENABLED"]) {
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", "socAdd", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}?>