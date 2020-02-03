<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

$positionClassMap = array(
	'left' => 'basket-item-label-left',
	'center' => 'basket-item-label-center',
	'right' => 'basket-item-label-right',
	'bottom' => 'basket-item-label-bottom',
	'middle' => 'basket-item-label-middle',
	'top' => 'basket-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>
<?/*
<div class="basket-content-row">
    <div class="basket-content-row-col">
        <div class="basket-content-row-col__img">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/card1.jpg" alt="">
        </div>
        <div class="basket-content-row-col__title">
            PALM ANGELS<br>
            SWEATSHIRT HOODED<br>
            Size L
        </div>
    </div>
    <div class="basket-content-row-col">
        ₽ 36.775
    </div>
    <div class="basket-content-row-col">
        <div class="basket-content-row-col__minus">
            -
        </div>
        <input class="basket-content-row-col__input" type="text" value="1">
        <div class="basket-content-row-col__plus">
            +
        </div>
    </div>
    <div class="basket-content-row-col">
        ₽ 36.775
    </div>
    <div class="basket-content-row-col">
        <div class="basket-content-row-col__del">
        </div>
    </div>
</div>
*/?>

<script id="basket-item-template" type="text/html">
    <tr class="basket-content-row" id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
        {{#SHOW_RESTORE}}
            <td class="basket-content-row" colspan="<?=$restoreColSpan?>">
                <div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed" id="basket-item-height-aligner-{{ID}}">
                    {{#SHOW_LOADING}}
                    <div class="basket-items-list-item-overlay"></div>
                    {{/SHOW_LOADING}}
                    <div class="basket-items-list-item-removed-container">
                        <div>
                            <?=Loc::getMessage('SBB_GOOD_CAP')?> <strong>{{NAME}}</strong> <?=Loc::getMessage('SBB_BASKET_ITEM_DELETED')?>.
                        </div>
                        <div class="basket-items-list-item-removed-block">
                            <a href="javascript:void(0)" data-entity="basket-item-restore-button">
                                <?=Loc::getMessage('SBB_BASKET_ITEM_RESTORE')?>
                            </a>
                            <div class="basket-content-row-col__del" data-entity="basket-item-close-restore-button">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 13.9 13.9" style="enable-background:new 0 0 13.9 13.9;" xml:space="preserve">
                                    <title>x mark-unfilled</title>
                                    <desc>Created with Sketch.</desc>
                                    <g>
                                        <g transform="translate(-13.000000, -13.000000)">
                                            <path d="M21.3,19.9l5.3-5.3c0.4-0.4,0.4-1,0-1.3c-0.4-0.4-1-0.4-1.3,0l-5.3,5.3l-5.3-5.3c-0.4-0.4-1-0.4-1.3,0    c-0.4,0.4-0.4,1,0,1.3l5.3,5.3l-5.3,5.3c-0.4,0.4-0.4,1,0,1.3c0.4,0.4,1,0.4,1.3,0l5.3-5.3l5.3,5.3c0.4,0.4,1,0.4,1.3,0    c0.4-0.4,0.4-1,0-1.3L21.3,19.9z"></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        {{/SHOW_RESTORE}}
        {{^SHOW_RESTORE}}
            <td class="basket-content-row-col" id="basket-item-height-aligner-{{ID}}">
            <?
            if (in_array('PREVIEW_PICTURE', $arParams['COLUMNS_LIST']))
            {
                ?>
                {{#DETAIL_PAGE_URL}}
                    <a href="{{DETAIL_PAGE_URL}}" class="basket-content-row-col__img">
                        <img src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}}" alt="{{NAME}}">
                    </a>
                {{/DETAIL_PAGE_URL}}
                {{^DETAIL_PAGE_URL}}
                    <div class="basket-content-row-col__img">
                        <img src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}}" alt="{{NAME}}">
                    </div>
                {{/DETAIL_PAGE_URL}}
                    <?
                    if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
                    {
                        ?>
                        {{#DISCOUNT_PRICE_PERCENT}}
                        <div class="basket-item-label-ring basket-item-label-small <?=$discountPositionClass?>">
                            -{{DISCOUNT_PRICE_PERCENT_FORMATED}}
                        </div>
                        {{/DISCOUNT_PRICE_PERCENT}}
                        <?
                    }
                    ?>

                <?
            }
            ?>
                <div class="basket-content-row-col__title">
                    {{#DETAIL_PAGE_URL}}
                        <a href="{{DETAIL_PAGE_URL}}">
                            <span data-entity="basket-item-name">{{NAME}}</span>
                        </a>
                    {{/DETAIL_PAGE_URL}}
                    {{^DETAIL_PAGE_URL}}
                            <span data-entity="basket-item-name">{{NAME}}</span>
                    {{/DETAIL_PAGE_URL}}

                        <?
                        if (!empty($arParams['PRODUCT_BLOCKS_ORDER']))
                        {
                            foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName)
                            {
                                switch (trim((string)$blockName))
                                {
                                    case 'props':
                                        if (in_array('PROPS', $arParams['COLUMNS_LIST']))
                                        {
                                            ?>
                                            {{#PROPS}}
                                            <div class="basket-item-property<?=(!isset($mobileColumns['PROPS']) ? ' hidden-xs' : '')?>">
                                                <div class="basket-item-property-name">
                                                    {{{NAME}}}
                                                </div>
                                                <div class="basket-item-property-value"
                                                     data-entity="basket-item-property-value" data-property-code="{{CODE}}">
                                                    {{{VALUE}}}
                                                </div>
                                            </div>
                                            {{/PROPS}}
                                            <?
                                        }

                                        break;
                                    case 'sku':
                                        ?>

                                        {{IS_IMAGE}}
                                        {{#SKU_BLOCK_LIST}}
                                        {{#IS_IMAGE}}
                                        <?/*
                                            <ul class="good-content-sizes product-item-scu-item-list" data-entity="basket-item-sku-block">
                                                {{#SKU_VALUES_LIST}}
                                                <li class="good-content-color__item{{#SELECTED}}  active{{/SELECTED}}
                                                                                        {{#NOT_AVAILABLE_OFFER}} not-available{{/NOT_AVAILABLE_OFFER}}"
                                                    title="{{NAME}}"
                                                    data-entity="basket-item-sku-field"
                                                    data-initial="{{#SELECTED}}true{{/SELECTED}}{{^SELECTED}}false{{/SELECTED}}"
                                                    data-value-id="{{VALUE_ID}}"
                                                    data-sku-name="{{NAME}}"
                                                    data-property="{{PROP_CODE}}">
                                                    <span style="background: {{COLOR}}" class="basket-item-scu-item-inner"></span>
                                                </li>
                                                {{/SKU_VALUES_LIST}}
                                            </ul>
*/?>
                                        {{/IS_IMAGE}}
                                        {{^IS_IMAGE}}

                                                <ul class="good-content-sizes product-item-scu-item-list" data-entity="basket-item-sku-block">
                                                    {{#SKU_VALUES_LIST}}
                                                    <li class="good-content-sizes__item{{#SELECTED}} active{{/SELECTED}}
                                                                                    {{#NOT_AVAILABLE_OFFER}} not-available{{/NOT_AVAILABLE_OFFER}}"
                                                        title="{{NAME}}"
                                                        data-entity="basket-item-sku-field"
                                                        data-initial="{{#SELECTED}}true{{/SELECTED}}{{^SELECTED}}false{{/SELECTED}}"
                                                        data-value-id="{{VALUE_ID}}"
                                                        data-sku-name="{{NAME}}"
                                                        data-property="{{PROP_CODE}}">
                                                        <span class="basket-item-scu-item-inner">{{NAME}}</span>
                                                    </li>
                                                    {{/SKU_VALUES_LIST}}
                                                </ul>
                                        {{/IS_IMAGE}}
                                        {{/SKU_BLOCK_LIST}}

                                        {{#HAS_SIMILAR_ITEMS}}
                                        <div class="basket-items-list-item-double" data-entity="basket-item-sku-notification">
                                            <div class="alert alert-info alert-dismissable text-center">
                                                {{#USE_FILTER}}
                                                <a href="javascript:void(0)"
                                                   class="basket-items-list-item-double-anchor"
                                                   data-entity="basket-item-show-similar-link">
                                                    {{/USE_FILTER}}
                                                    <?=Loc::getMessage('SBB_BASKET_ITEM_SIMILAR_P1')?>{{#USE_FILTER}}</a>{{/USE_FILTER}}
                                                <?=Loc::getMessage('SBB_BASKET_ITEM_SIMILAR_P2')?>
                                                {{SIMILAR_ITEMS_QUANTITY}} {{MEASURE_TEXT}}
                                                <br>
                                                <a href="javascript:void(0)" class="basket-items-list-item-double-anchor"
                                                   data-entity="basket-item-merge-sku-link">
                                                    <?=Loc::getMessage('SBB_BASKET_ITEM_SIMILAR_P3')?>
                                                    {{TOTAL_SIMILAR_ITEMS_QUANTITY}} {{MEASURE_TEXT}}?
                                                </a>
                                            </div>
                                        </div>
                                        {{/HAS_SIMILAR_ITEMS}}
                                        <?
                                        break;
                                    case 'columns':
                                        ?>
                                        {{#COLUMN_LIST}}
                                        {{#IS_IMAGE}}
                                        <div class="basket-item-property-custom basket-item-property-custom-photo
                                                                    {{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
                                             data-entity="basket-item-property">
                                            <div class="basket-item-property-custom-name">{{NAME}}</div>
                                            <div class="basket-item-property-custom-value">
                                                {{#VALUE}}
                                                <span>
                                                                                <img class="basket-item-custom-block-photo-item"
                                                                                     src="{{{IMAGE_SRC}}}" data-image-index="{{INDEX}}"
                                                                                     data-column-property-code="{{CODE}}">
                                                                            </span>
                                                {{/VALUE}}
                                            </div>
                                        </div>
                                        {{/IS_IMAGE}}

                                        {{#IS_TEXT}}
                                        <div class="basket-item-property-custom basket-item-property-custom-text
                                                                    {{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
                                             data-entity="basket-item-property">
                                            <div class="basket-item-property-custom-name">{{NAME}}</div>
                                            <div class="basket-item-property-custom-value"
                                                 data-column-property-code="{{CODE}}"
                                                 data-entity="basket-item-property-column-value">
                                                {{VALUE}}
                                            </div>
                                        </div>
                                        {{/IS_TEXT}}

                                        {{#IS_HTML}}
                                        <div class="basket-item-property-custom basket-item-property-custom-text
                                                                    {{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
                                             data-entity="basket-item-property">
                                            <div class="basket-item-property-custom-name">{{NAME}}</div>
                                            <div class="basket-item-property-custom-value"
                                                 data-column-property-code="{{CODE}}"
                                                 data-entity="basket-item-property-column-value">
                                                {{{VALUE}}}
                                            </div>
                                        </div>
                                        {{/IS_HTML}}

                                        {{#IS_LINK}}
                                        <div class="basket-item-property-custom basket-item-property-custom-text
                                                                    {{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
                                             data-entity="basket-item-property">
                                            <div class="basket-item-property-custom-name">{{NAME}}</div>
                                            <div class="basket-item-property-custom-value"
                                                 data-column-property-code="{{CODE}}"
                                                 data-entity="basket-item-property-column-value">
                                                {{#VALUE}}
                                                {{{LINK}}}{{^IS_LAST}}<br>{{/IS_LAST}}
                                                {{/VALUE}}
                                            </div>
                                        </div>
                                        {{/IS_LINK}}
                                        {{/COLUMN_LIST}}
                                        <?
                                        break;
                                }
                            }
                        }
                        ?>
                        </div>
                    {{#NOT_AVAILABLE}}
                        <?=Loc::getMessage('SBB_BASKET_ITEM_NOT_AVAILABLE')?>.
                    {{/NOT_AVAILABLE}}
                    {{#DELAYED}}
                        <?=Loc::getMessage('SBB_BASKET_ITEM_DELAYED')?>.
                        <a href="javascript:void(0)" data-entity="basket-item-remove-delayed">
                            <?=Loc::getMessage('SBB_BASKET_ITEM_REMOVE_DELAYED')?>
                        </a>
                    {{/DELAYED}}
                    {{#WARNINGS.length}}
                        <div class="alert alert-warning alert-dismissable" data-entity="basket-item-warning-node">
                            <span class="close" data-entity="basket-item-warning-close">&times;</span>
                            {{#WARNINGS}}
                            <div data-entity="basket-item-warning-text">{{{.}}}</div>
                            {{/WARNINGS}}
                        </div>
                    {{/WARNINGS.length}}
                {{#SHOW_LOADING}}
                    <div class="basket-items-list-item-overlay"></div>
                {{/SHOW_LOADING}}
        </td>

        <?
        if ($usePriceInAdditionalColumn)
        {
            ?>
            <td class="basket-content-row-col">
                    {{#SHOW_DISCOUNT_PRICE}}
						<span class="basket-item-price-old-text">
							{{{FULL_PRICE_FORMATED}}}
						</span>
                    {{/SHOW_DISCOUNT_PRICE}}
						<span class="basket-item-price-current-text" id="basket-item-price-{{ID}}">
							{{{PRICE_FORMATED}}}
						</span>
                    {{#SHOW_LOADING}}
                        <div class="basket-items-list-item-overlay"></div>
                    {{/SHOW_LOADING}}
            </td>
            <?
        }
        ?>
        <td class="basket-content-row-col" data-entity="basket-item-quantity-block">
                <div class="basket-content-row-col__minus" data-entity="basket-item-quantity-minus">-</div>
                <input type="text" class="basket-content-row-col__input" value="{{QUANTITY}}"
                       {{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
                data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
                id="basket-item-quantity-{{ID}}">
                <div class="basket-content-row-col__plus" data-entity="basket-item-quantity-plus">+</div>
                {{#SHOW_LOADING}}
                <div class="basket-items-list-item-overlay"></div>
                {{/SHOW_LOADING}}
        </td>
        <?
        if ($useSumColumn)
        {
            ?>
            <td class="basket-content-row-col">
                {{#SHOW_DISCOUNT_PRICE}}
					<span class="basket-item-price-old-text" id="basket-item-sum-price-old-{{ID}}">
						{{{SUM_FULL_PRICE_FORMATED}}}
					</span>
                {{/SHOW_DISCOUNT_PRICE}}
					<span class="basket-item-price-current-text" id="basket-item-sum-price-{{ID}}">
						{{{SUM_PRICE_FORMATED}}}
					</span>
                {{#SHOW_DISCOUNT_PRICE}}
                    <?=Loc::getMessage('SBB_BASKET_ITEM_ECONOMY')?>
                    <span id="basket-item-sum-price-difference-{{ID}}" style="white-space: nowrap;">
						{{{SUM_DISCOUNT_PRICE_FORMATED}}}
					</span>
                {{/SHOW_DISCOUNT_PRICE}}
                {{#SHOW_LOADING}}
                <div class="basket-items-list-item-overlay"></div>
                {{/SHOW_LOADING}}
            </td>
            <?
        }

        if ($useActionColumn)
        {
            ?>
            <td class="basket-content-row-col">
                <div class="basket-content-row-col__del" data-entity="basket-item-delete">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 13.9 13.9" style="enable-background:new 0 0 13.9 13.9;" xml:space="preserve">
                        <title>x mark-unfilled</title>
                        <desc>Created with Sketch.</desc>
                        <g>
                            <g transform="translate(-13.000000, -13.000000)">
                                <path d="M21.3,19.9l5.3-5.3c0.4-0.4,0.4-1,0-1.3c-0.4-0.4-1-0.4-1.3,0l-5.3,5.3l-5.3-5.3c-0.4-0.4-1-0.4-1.3,0    c-0.4,0.4-0.4,1,0,1.3l5.3,5.3l-5.3,5.3c-0.4,0.4-0.4,1,0,1.3c0.4,0.4,1,0.4,1.3,0l5.3-5.3l5.3,5.3c0.4,0.4,1,0.4,1.3,0    c0.4-0.4,0.4-1,0-1.3L21.3,19.9z"></path>
                            </g>
                        </g>
                    </svg>
                </div>
            </td>
            <?
        }
        ?>
        {{/SHOW_RESTORE}}
    </tr>
</script>