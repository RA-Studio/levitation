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
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

ShowMessage($arParams["~AUTH_RESULT"]);
?>
<noindex>
    <form method="post" class="lk-tab" id="lk-acc2" action="<?=$arResult["AUTH_URL"]?>" name="bform" onsubmit="fbq('track', 'CompleteRegistration');" enctype="multipart/form-data">
        <?if (strlen($arResult["BACKURL"]) > 0){?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?}?>
        <?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"){?>
            <?echo GetMessage("AUTH_EMAIL_SENT")?></div>
        <?}else{?>
        <?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
            <?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></div>
        <?endif?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="REGISTRATION" />

        <label class="lk-tab__label" for="email"><?=GetMessage("AUTH_EMAIL")?></label>
        <input class="lk-tab__input bx-auth-input" type="email" id="email" name="USER_EMAIL" value="<?=GetMessage("USER_LOGIN")?>" placeholder="" required="">
        <input class="lk-tab__input bx-auth-input" type="hidden" id="login" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>" placeholder="Логин" required="">
        <label class="lk-tab__label" for="pass"><?=GetMessage("AUTH_PASSWORD_REQ")?></label>
        <input class="lk-tab__input bx-auth-input" type="password" id="pass" name="USER_PASSWORD" value="<?=$arResult["USER_PASSWORD"]?>" autocomplete="off" placeholder="" required="">
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
    <label for="create-privacy" class="lk-tab__rowlabel">
        *<?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>
    </label>
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
    </form>
</noindex>
<?}?>