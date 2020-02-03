<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//***********************************
//setting section
//***********************************
?>
<form class="lk-form subscribe" action="<?=$arResult["FORM_ACTION"]?>" method="post">
    <?=bitrix_sessid_post();?>
    <div class="lk-form-pair">
        <label class="lk-form__label" for="subscribe-email"><?echo GetMessage("subscr_email")?></label>
        <input class="lk-form__input" type="email" id="subscribe-email" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" placeholder="<?echo GetMessage("subscr_email")?>">
    </div>
    <svg class="lk-form_line" width="51" height="1" viewBox="0 0 51 1" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line y1="0.5" x2="51" y2="0.5" stroke="#747474"></line>
    </svg>
    <?foreach($arResult["RUBRICS"] as $itemID => $itemValue){?>
        <?if($itemValue['ID'] == 4 ){?>
            <div style="display: none" class="lk-form-subscribe-item">
                <label for="sub<?=$itemID?>">
                    <input type="checkbox" id="sub<?=$itemID?>" hidden="" name="RUB_ID[]" value="<?=$itemValue["ID"]?>" checked="">
                    <span><?=$itemValue['NAME']?></span>
                    <span class="lk-form-subscribe-item-check"></span>
                </label>
                <div class="lk-form-subscribe-item__text">
                    <?=$itemValue['DESCRIPTION']?>
                </div>
            </div>
        <?}else{?>
        <div class="lk-form-subscribe-item">
            <label for="sub<?=$itemID?>">
                <input type="checkbox" id="sub<?=$itemID?>" hidden="" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?>>
                <span><?=$itemValue['NAME']?></span>
                <span class="lk-form-subscribe-item-check"></span>
            </label>
            <div class="lk-form-subscribe-item__text">
                <?=$itemValue['DESCRIPTION']?>
            </div>
        </div>
        <?}?>
    <?}?>
    <div class="lk-form-subscribe__all" style="margin-bottom: 30px;">Выбрать все</div>
    <svg class="lk-form_line" width="100" height="1" viewBox="0 0 100 1" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line y1="0.5" x2="100" y2="0.5" stroke="#747474"/>
    </svg>
    <input class="lk-form__enter" type="submit" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />
    <input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
    <input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
    <?if($_REQUEST["register"] == "YES"):?>
        <input type="hidden" name="register" value="YES" />
    <?endif;?>
    <?if($_REQUEST["authorize"]=="YES"):?>
        <input type="hidden" name="authorize" value="YES" />
    <?endif;?>
</form>
<?/*
<form >
<?=bitrix_sessid_post();?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="data-table">
<thead><tr><td colspan="2"><?echo GetMessage("subscr_title_settings")?></td></tr></thead>
<tr valign="top">
	<td width="40%">
		<p><?echo GetMessage("subscr_email")?><span class="starrequired">*</span><br />
		<input type="text" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255" /></p>
		<p><?echo GetMessage("subscr_rub")?><span class="starrequired">*</span><br />
		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			<label><input type="checkbox" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /><?=$itemValue["NAME"]?></label><br />
		<?endforeach;?></p>
		<p><?echo GetMessage("subscr_fmt")?><br />
		<label><input type="radio" name="FORMAT" value="text"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "text") echo " checked"?> /><?echo GetMessage("subscr_text")?></label>&nbsp;/&nbsp;<label><input type="radio" name="FORMAT" value="html"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "html") echo " checked"?> />HTML</label></p>
	</td>
	<td width="60%">
		<p><?echo GetMessage("subscr_settings_note1")?></p>
		<p><?echo GetMessage("subscr_settings_note2")?></p>
	</td>
</tr>
<tfoot><tr><td colspan="2">
	<input type="submit" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />
	<input type="reset" value="<?echo GetMessage("subscr_reset")?>" name="reset" />
</td></tr></tfoot>
</table>

<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
<?if($_REQUEST["register"] == "YES"):?>
	<input type="hidden" name="register" value="YES" />
<?endif;?>
<?if($_REQUEST["authorize"]=="YES"):?>
	<input type="hidden" name="authorize" value="YES" />
<?endif;?>
</form>
*/?>