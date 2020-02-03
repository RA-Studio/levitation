<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

if(strlen($arResult["ERROR_MESSAGE"])>0)
{
    ShowError($arResult["ERROR_MESSAGE"]);
}
if (is_array($arResult["PROFILES"]) && !empty($arResult["PROFILES"]))
{
    ?><?foreach($arResult["PROFILES"] as $val)
        {
            ?>
            <?$APPLICATION->IncludeComponent(
            "bitrix:sale.personal.profile.detail",
            "profile",
            array(
                "PATH_TO_LIST" => $arResult["PATH_TO_LIST"],
                "PATH_TO_DETAIL" => $arResult["PATH_TO_DETAIL"],
                "SET_TITLE" =>$arParams["SET_TITLE"],
                "USE_AJAX_LOCATIONS" => $arParams['USE_AJAX_LOCATIONS'],
                "ID" => $val["ID"],
            ),
            $component
        );?>
            <?
        }?><?
}
elseif ($arResult['USER_IS_NOT_AUTHORIZED'] !== 'Y')
{?><div class="lk-tab" id="lk-info3">
    <h3><?=Loc::getMessage("STPPL_EMPTY_PROFILE_LIST") ?></h3>
</div><?
}
?>
