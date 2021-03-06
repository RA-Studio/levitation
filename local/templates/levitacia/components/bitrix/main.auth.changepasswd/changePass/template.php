<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

\Bitrix\Main\Page\Asset::getInstance()->addCss(
	'/bitrix/css/main/system.auth/flat/style.css'
);

if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_CHD_SUCCESS');
	return;
}

$fields = $arResult['FIELDS'];
?>
<form name="bform" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>" class="lk-form checkin">
    <div class="lk-form__title"><?= Loc::getMessage('MAIN_AUTH_CHD_HEADER');?></div>
    <svg class="lk-form_line" width="51" height="1" viewBox="0 0 51 1" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line y1="0.5" x2="51" y2="0.5" stroke="#747474"></line>
    </svg>
    <?if ($arResult['ERRORS']):?>
        <div class="lk-form-pair alert alert-danger">
            <? foreach ($arResult['ERRORS'] as $error){
                echo $error;
            }?>
        </div>
    <?elseif ($arResult['SUCCESS']):?>
        <div class="lk-form-pair alert alert-success">
            <?= $arResult['SUCCESS'];?>
        </div>
    <?endif;?>
    <div class="lk-form-pair">
        <label class="lk-form__label" for="email"><?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_LOGIN');?></label>
        <input class="lk-form__input" type="text" id="email" type="text" name="<?= $fields['login'];?>" maxlength="255" value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>" placeholder="E-mail" required="">
        <input class="lk-form__input" type="text" id="login" type="text" name="<?= $fields['login'];?>" maxlength="255" value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>" placeholder="Логин" required="" hidden="">
    </div>
    <div class="lk-form-pair">
        <label class="lk-form__label" for="pass"><?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_CHECKWORD');?></label>
        <input class="lk-form__input" type="pass" id="pass"  name="<?= $fields['checkword'];?>" maxlength="255" value="<?= \htmlspecialcharsbx($arResult[$fields['checkword']]);?>" placeholder="<?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_CHECKWORD');?>" required="">
    </div>
    <div class="lk-form-pair">
        <label class="lk-form__label" for="pass"><?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_PASS');?></label>
        <input class="lk-form__input" id="pass" type="password" name="<?= $fields['password'];?>" value="<?= \htmlspecialcharsbx($arResult[$fields['password']]);?>" maxlength="255" autocomplete="off" placeholder="<?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_PASS');?>" required="">
    </div>
    <div class="lk-form-pair">
        <label class="lk-form__label" for="pass"><?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_PASS2');?></label>
        <input class="lk-form__input" id="pass"type="password" name="<?= $fields['confirm_password'];?>" value="<?= \htmlspecialcharsbx($arResult[$fields['confirm_password']]);?>" maxlength="255" autocomplete="off" placeholder="<?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_PASS2');?>" required="">
    </div>
    <div class="lk-form-pair">
        <div class="bx-authform-description-container">
            <?= $arResult['GROUP_POLICY']['PASSWORD_REQUIREMENTS'];?>
        </div>
    </div>
    <?if ($arResult['CAPTCHA_CODE']){?>
        <div class="lk-form-pair">
            <input type="hidden" name="captcha_sid" value="<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" />
            <div class="bx-authform-formgroup-container dbg_captha">
                <div class="bx-authform-label-container">
                    <?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_CAPTCHA');?>
                </div>
                <div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" width="180" height="40" alt="CAPTCHA" /></div>
                <div class="bx-authform-input-container">
                    <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
                </div>
            </div>
        </div>
    <?}?>

    <input type="submit" class="lk-form__enter" name="<?= $fields['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_CHD_FIELD_SUBMIT');?>" />

</form>
<?if ($arResult['AUTH_AUTH_URL']){?>
    <div class="lk-block enter">
        <div class="lk-block__title">Уже есть аккаунт?</div>
        <svg class="lk-form_line" width="51" height="1" viewBox="0 0 51 1" fill="none" xmlns="http://www.w3.org/2000/svg">
            <line y1="0.5" x2="51" y2="0.5" stroke="#747474"></line>
        </svg>
        <div class="lk-block__text">Войдите прямо сейчас и пользуйтесь всеми преимуществами нашего клуба</div>
        <a href="<?= $arResult['AUTH_AUTH_URL'];?>" class="lk-block__checkin" rel="nofollow"><?= Loc::getMessage('MAIN_AUTH_CHD_URL_AUTH_URL');?></a>
    </div>
<?}?>
<?if ($arResult['AUTH_REGISTER_URL']){?>
    <div class="lk-block create">
        <div class="lk-block__title">Создать аккаунт</div>
        <svg class="lk-form_line" width="51" height="1" viewBox="0 0 51 1" fill="none" xmlns="http://www.w3.org/2000/svg">
            <line y1="0.5" x2="51" y2="0.5" stroke="#747474"></line>
        </svg>
        <div class="lk-block__text">Зарегистируйтесь и пользутесь всеми возможностями нашего клуба</div>
        <a rel="nofollow" href="<?= $arResult['AUTH_REGISTER_URL'];?>" class="lk-block__checkin"><?= Loc::getMessage('MAIN_AUTH_CHD_URL_REGISTER_URL');?></a>
    </div>
<?}?>
<script type="text/javascript">
	document.bform.<?= $fields['login'];?>.focus();
</script>
