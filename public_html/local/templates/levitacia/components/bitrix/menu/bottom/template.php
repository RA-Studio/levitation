<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!empty($arResult)){
?><div class="footer-top-col footer-menu"><?
foreach($arResult as $arItem){
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
            continue;
    if($arItem["SELECTED"]){
        ?><a class="footer-top-col-item" href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a><?
    }else{
        ?><a class="footer-top-col-item" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a><?
    }
}
$APPLICATION->IncludeFile(
            SITE_TEMPLATE_PATH."/include/social.php",
            array(),
            array(
                "NAME"=>"Соц. сети",
                "MODE" => "html"
            )
        );
?></div><?
}?>