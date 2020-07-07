<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>
<div class="main-pagination">
    <?if (!empty($arResult["NavTitle"])){?>
        <div class=""><?=$arResult["NavTitle"]?></div>
    <?}?>
    <?if($arResult["bDescPageNumbering"] === true){?>
        <?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
            <?if($arResult["bSavePage"]){?>
                <a class="main-pagination__prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"></a>
            <?}
            else {?>
                <?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ){?>
                    <a class="main-pagination__prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"></a>
                <?}
                else{?>
                    <a class="main-pagination__prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"></a>
                <?}?>
            <?}?>
        <?else:?>
                <div class="main-pagination__prev"></div>
        <?endif?>
        <?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
            <?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>
            <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                <div class="main-pagination__page current"><?=$NavRecordGroupPrint?></div>
            <?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
                <a class="main-pagination__page" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
            <?else:?>
                <a class="main-pagination__page" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
            <?endif?>
            <?$arResult["nStartPage"]--?>
        <?endwhile?>
        <?if ($arResult["NavPageNomer"] > 1):?>
            <a class="main-pagination__next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"></a>
        <?else:?>
            <div class="main-pagination__next"></div>
        <?endif?>
    <?}else{?>
        <?if ($arResult["NavPageNomer"] > 1):?>
            <?if($arResult["bSavePage"]):?>
                <a class="main-pagination__prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"></a>
            <?else:?>
                <?if ($arResult["NavPageNomer"] > 2):?>
                    <a class="main-pagination__prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"></a>
                <?else:?>
                    <a class="main-pagination__prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"></a>
                <?endif?>
            <?endif?>
        <?else:?>
            <div class="main-pagination__prev"></div>
        <?endif?>
        <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
            <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                <div class="main-pagination__page current"><?=$arResult["nStartPage"]?></div>
            <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
                <a class="main-pagination__page" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
            <?else:?>
                <a class="main-pagination__page" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
            <?endif?>
            <?$arResult["nStartPage"]++?>
        <?endwhile?>
        <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
            <a class="main-pagination__next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"></a>
        <?else:?>
            <div class="main-pagination__next"></div>
        <?endif?>
    <?}?>
    <?if ($arResult["bShowAll"]):?>
        <noindex>
            <?if ($arResult["NavShowAll"]):?>
                <a class="main-pagination__page" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a>
            <?else:?>
                <a class="main-pagination__page" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a>
            <?endif?>
        </noindex>
    <?endif?>

    <?/*<div class="main-pagination__prev"></div>

        <div class="main-pagination__page current">1</div>
        <a href="" class="main-pagination__page">2</a>
        <div class="main-pagination__page">...</div>
        <a href="" class="main-pagination__page">10</a>

        <a href="" class="main-pagination__next"></a>*/?>
</div>
