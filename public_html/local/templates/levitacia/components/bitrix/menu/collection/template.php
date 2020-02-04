<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
	<?if ($arItem["IS_PARENT"]):?>
        <div class="header-menu__item header-menu__parent">
        <?=$arItem["TEXT"]?>
        </div>
            <div class="header-menu__content">

	<?else:?>
		<?if ($arItem["PERMISSION"] > "D"):?>
            <div class="header-menu__item">
                <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            </div>
		<?else:?>
            <div class="header-menu__item denied">
                <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            </div>
		<?endif?>
	<?endif?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</div>", ($previousLevel-1) );?>
<?endif?>
<?endif?>