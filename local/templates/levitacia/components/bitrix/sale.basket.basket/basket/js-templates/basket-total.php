<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
        <div class="basket-content-total-row" data-entity="basket-checkout-aligner">
            <?=Loc::getMessage('SBB_TOTAL')?>:
            <div class="basket-content-total-row__price" data-entity="basket-total-price">
                {{{PRICE_FORMATED}}}
            </div>
            {{#WEIGHT_FORMATED}}
            <?=Loc::getMessage('SBB_WEIGHT')?>: {{{WEIGHT_FORMATED}}}
            {{#SHOW_VAT}}<br>{{/SHOW_VAT}}
            {{/WEIGHT_FORMATED}}
            {{#SHOW_VAT}}
            <?=Loc::getMessage('SBB_VAT')?>: {{{VAT_SUM_FORMATED}}}
            {{/SHOW_VAT}}
        </div><?
        if ($arParams['HIDE_COUPON'] !== 'Y')
        {
            ?><div class="basket-content-total-row">
                <input type="text" placeholder="Код купона" data-entity="basket-coupon-input">
                <div class="basket-content-total-row__btn">
                    Применить
                </div>
            </div><?
        }
		if ($arParams['HIDE_COUPON'] !== 'Y')
		{
		?>
			{{#COUPON_LIST}}
            <div class="basket-content-total-row">
				<span class="basket-coupon-text">
					<strong>{{COUPON}}</strong> - <?=Loc::getMessage('SBB_COUPON')?> {{JS_CHECK_CODE}}
					{{#DISCOUNT_NAME}}({{DISCOUNT_NAME}}){{/DISCOUNT_NAME}}
				</span>
				<span class="basket-content-row-col__del" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 13.9 13.9" style="enable-background:new 0 0 13.9 13.9;" xml:space="preserve">
                        <title>x mark-unfilled</title>
                        <desc>Created with Sketch.</desc>
                        <g>
                            <g transform="translate(-13.000000, -13.000000)">
                                <path d="M21.3,19.9l5.3-5.3c0.4-0.4,0.4-1,0-1.3c-0.4-0.4-1-0.4-1.3,0l-5.3,5.3l-5.3-5.3c-0.4-0.4-1-0.4-1.3,0    c-0.4,0.4-0.4,1,0,1.3l5.3,5.3l-5.3,5.3c-0.4,0.4-0.4,1,0,1.3c0.4,0.4,1,0.4,1.3,0l5.3-5.3l5.3,5.3c0.4,0.4,1,0.4,1.3,0    c0.4-0.4,0.4-1,0-1.3L21.3,19.9z"></path>
                            </g>
                        </g>
                    </svg>
                    <?//=Loc::getMessage('SBB_DELETE')?>
				</span>
			</div>
			{{/COUPON_LIST}}
			<?
		}
		?>
</script>