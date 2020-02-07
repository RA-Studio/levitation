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
?><div class="container"><?
  /*  if($arParams["DISPLAY_TOP_PAGER"]){
        echo $arResult["NAV_STRING"];
}*/
foreach($arResult["ITEMS"] as $key=>$arItem){
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	if($key%3 == 0){
        ?><div class="media"><?
        }
        ?><div class="media-item-wrap" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <a href="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="media-item" style="background-image: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>');" data-fancybox="gallery-<?=$arItem['ID']?>">
                <div class="media-item__title"><?=$arItem['NAME']?></div>
            </a>
            <div class="media-item-gallery" style="display: none;"><?
                foreach ($arItem['PROPERTIES']['UF_PHOTO']['VALUE'] as $value){
                    ?><a href="<?=CFile::GetPath($value)?>" alt="<?=$arItem['NAME']?>" data-fancybox="gallery-<?=$arItem['ID']?>"></a><?
                }
            ?></div>
        </div><?
    if($key%3 == 2){
        ?></div><?
    }?><?
}
/*if($arParams["DISPLAY_BOTTOM_PAGER"]){
    echo $arResult["NAV_STRING"];
}*/
?></div>
