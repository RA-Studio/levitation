<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//*************************************
//show confirmation form
//*************************************
?>
<form class="lk-form subscribe" action="<?=$arResult["FORM_ACTION"]?>" method="get">
    <div class="lk-block__title">
<?echo GetMessage("subscr_title_confirm")?>
    </div>
    <div class="lk-form-pair">
        <label class="lk-form__label" for="conf_code"><?=GetMessage("subscr_conf_code")?></label>
        <input class="lk-form__input" type="text" id="conf_code" name="CONFIRM_CODE" value="<?=$arResult["REQUEST"]["CONFIRM_CODE"];?>" placeholder="<?=GetMessage("subscr_conf_code")?>">
    </div>
    <div class="lk-block__text">
        <?=GetMessage("subscr_conf_date")?>
        <?=$arResult["SUBSCRIPTION"]["DATE_CONFIRM"];?>
		<?=GetMessage("subscr_conf_note1")?>

    <a title="<?echo GetMessage("adm_send_code")?>" href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>">
        <?echo GetMessage("subscr_conf_note2")?>
    </a>.
    </div>

<input  class="lk-form__enter" type="submit" name="confirm" value="<?echo GetMessage("subscr_conf_button")?>" />

<input type="hidden" name="ID" value="<?echo $arResult["ID"];?>" />
<?echo bitrix_sessid_post();?>
</form>
