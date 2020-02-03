<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <div class="main-filters-categories__title" data-title="">Коллекция</div>
    <div class="main-filters-categories-items" data-content="">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
	<?if ($arItem["IS_PARENT"]):?>
        <div class="main-filters-categories__title" data-title=""><?=$arItem["TEXT"]?></div>
            <div class="main-filters-categories-items" data-content="">
	<?else:?>
		<?if ($arItem["PERMISSION"] > "D"):?>
            <div class="main-filters-categories-items__link-wrap">
                <a class="main-filters-categories-items__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            </div>
		<?else:?>
            <div class="main-filters-categories-items__link-wrap denied">
                <a class="main-filters-categories-items__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
            </div>
		<?endif?>
	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</div>", ($previousLevel-1) );?>
<?endif?>
    </div>
<?endif?>