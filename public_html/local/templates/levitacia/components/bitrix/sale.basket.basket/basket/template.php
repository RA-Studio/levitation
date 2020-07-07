<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

$documentRoot = Main\Application::getDocumentRoot();

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
	$templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
	$templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
	$arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
	if (!is_file($documentRoot.'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	{
		$arParams['TEMPLATE_THEME'] = 'blue';
	}
}

if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact')))
{
	$arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY']))
{
	$arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

if ($arParams['USE_GIFTS'] === 'Y')
{
	$arParams['GIFTS_BLOCK_TITLE'] = isset($arParams['GIFTS_BLOCK_TITLE']) ? trim((string)$arParams['GIFTS_BLOCK_TITLE']) : Loc::getMessage('SBB_GIFTS_BLOCK_TITLE');

	CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');

	$giftParameters = array(
		'SHOW_PRICE_COUNT' => 1,
		'PRODUCT_SUBSCRIPTION' => 'N',
		'PRODUCT_ID_VARIABLE' => 'id',
		'USE_PRODUCT_QUANTITY' => 'N',
		'ACTION_VARIABLE' => 'actionGift',
		'ADD_PROPERTIES_TO_BASKET' => 'Y',
		'PARTIAL_PRODUCT_PROPERTIES' => 'Y',

		'BASKET_URL' => $APPLICATION->GetCurPage(),
		'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
		'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

		'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

		'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
		'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
		'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],

		'DETAIL_URL' => isset($arParams['GIFTS_DETAIL_URL']) ? $arParams['GIFTS_DETAIL_URL'] : null,
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
		'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
		'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
		'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
		'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
		'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
		'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
		'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

		'PRODUCT_ROW_VARIANTS' => '',
		'PAGE_ELEMENT_COUNT' => 0,
		'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
			SaleProductsGiftBasketComponent::predictRowVariants(
				$arParams['GIFTS_PAGE_ELEMENT_COUNT'],
				$arParams['GIFTS_PAGE_ELEMENT_COUNT']
			)
		),
		'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],

		'ADD_TO_BASKET_ACTION' => 'BUY',
		'PRODUCT_DISPLAY_MODE' => 'Y',
		'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',
		'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',
		'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
		'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

		'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
		'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
		'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
	);
}

\CJSCore::Init(array('fx', 'popup', 'ajax'));

//$this->addExternalCss('/bitrix/css/main/bootstrap.css');
$this->addExternalCss($templateFolder.'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');

$this->addExternalJs($templateFolder.'/js/mustache.js');
$this->addExternalJs($templateFolder.'/js/action-pool.js');
$this->addExternalJs($templateFolder.'/js/filter.js');
$this->addExternalJs($templateFolder.'/js/component.js');

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
	? $arParams['COLUMNS_LIST_MOBILE']
	: $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
	include($jsTemplate->getPath());
}

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';
?>
<div class="basket">
    <div class="container">
        <h1 class="title"><?=$APPLICATION->ShowTitle(false)?></h1>
<?
if (empty($arResult['ERROR_MESSAGE']))
{
	if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'TOP')
	{
		?>
		<div data-entity="parent-container">
			<div class="catalog-block-header"
					data-entity="header"
					data-showed="false"
					style="display: none; opacity: 0;">
				<?=$arParams['GIFTS_BLOCK_TITLE']?>
			</div>
			<?
			$APPLICATION->IncludeComponent(
				'bitrix:sale.products.gift.basket',
				'.default',
				$giftParameters,
				$component
			);
			?>
		</div>
		<?
	}

	if ($arResult['BASKET_ITEM_MAX_COUNT_EXCEEDED'])
	{
		?>
		<div id="basket-item-message">
			<?=Loc::getMessage('SBB_BASKET_ITEM_MAX_COUNT_EXCEEDED', array('#PATH#' => $arParams['PATH_TO_BASKET']))?>
		</div>
		<?
	}
	?>




    <div id="basket-root" class="basket-content">
        
	<!--<div id="basket-root" class="bx-basket bx-<?/*=$arParams['TEMPLATE_THEME']*/?> bx-step-opacity" style="opacity: 0;">-->
		<?
		if (
			$arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'
			&& in_array('top', $arParams['TOTAL_BLOCK_DISPLAY'])
		)
		{
			?>
				<div class="col-xs-12" data-entity="basket-total-block"></div>
			<?
		}
		?>


        <?/*
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-warning alert-dismissable" id="basket-warning" style="display: none;">
					<span class="close" data-entity="basket-items-warning-notification-close">&times;</span>
					<div data-entity="basket-general-warnings"></div>
					<div data-entity="basket-item-warnings">
						<?=Loc::getMessage('SBB_BASKET_ITEM_WARNING')?>
					</div>
				</div>
			</div>
		</div>
*/?>
        <div class="basket-content-main" id="basket-items-list-wrapper">
            <?/*
			<div class="basket-items-list-header" data-entity="basket-items-list-header">
				<div class="basket-items-search-field" data-entity="basket-filter">
					<div class="form has-feedback">
						<input type="text" class="form-control"
							placeholder="<?=Loc::getMessage('SBB_BASKET_FILTER')?>"
							data-entity="basket-filter-input">
						<span class="form-control-feedback basket-clear" data-entity="basket-filter-clear-btn"></span>
					</div>
				</div>
				<div class="basket-items-list-header-filter">
					<a href="javascript:void(0)" class="basket-items-list-header-filter-item active"
						data-entity="basket-items-count" data-filter="all" style="display: none;"></a>
					<a href="javascript:void(0)" class="basket-items-list-header-filter-item"
						data-entity="basket-items-count" data-filter="similar" style="display: none;"></a>
					<a href="javascript:void(0)" class="basket-items-list-header-filter-item"
						data-entity="basket-items-count" data-filter="warning" style="display: none;"></a>
					<a href="javascript:void(0)" class="basket-items-list-header-filter-item"
						data-entity="basket-items-count" data-filter="delayed" style="display: none;"></a>
					<a href="javascript:void(0)" class="basket-items-list-header-filter-item"
						data-entity="basket-items-count" data-filter="not-available" style="display: none;"></a>
				</div>
			</div>
            */?>

            <div class="basket-content-row header-row">
                <div class="basket-content-row-col">
                    Описание
                </div>
                <div class="basket-content-row-col">
                    Цена
                </div>
                <div class="basket-content-row-col">
                    Кол-во
                </div>
                <div class="basket-content-row-col">
                    Всего
                </div>
                <div class="basket-content-row-col">
                    Удалить
                </div>
            </div>
            <table id="basket-item-table"></table>

            <?
            if (
                $arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'
                && in_array('bottom', $arParams['TOTAL_BLOCK_DISPLAY'])
            )
            {
                ?>
                <div class="basket-content-total" data-entity="basket-total-block"></div>
                <div class="basket-content-bot">
                    <a class="basket-content-bot__back" href="<?=$arParams['EMPTY_BASKET_HINT_PATH']?>">Продолжить покупки</a>
                    <a href="<?=$arParams['PATH_TO_ORDER']?>" onclick="gaSendOrder(this);" class="basket-content-bot__checkout" data-entity="basket-checkout-button">
                        <?=Loc::getMessage('SBB_ORDER')?>
                    </a>
                </div>
                <?
            }
            ?>
        </div>
		<div class="basket-content-aside">
            <div class="basket-content-aside-box">
                <p>
                    <strong>Доставка и оплата</strong><br>
                    <br>
                </p>
				<span class="txt-uppercase"><strong>Доставка по России (СДЭК)</strong><br><br></span>
                <ul>
                    <li>Бесплатная доставка при первом заказе от 10 000 рублей и 100% предоплате в городе Санкт-Петербург и Москва.</li>
					<li>Бесплатная доставка при повторном заказе от 10 000 рублей и 100% предоплате в городе Санкт-Петербург и Москва.</li>
					<br>
                </ul>
                <span class="txt-uppercase">Бесплатная доставка в остальные города России (где присутствует СДЭК) при покупке от 10 000 рублей, за исключением тех, которые перечислены ниже (СДЭК).<br><br></span>
                    <p>Абакан, Амурск, Анадырь Чукотский авт. Округ, Ангарск, Анжеро-Судженск, Арсеньев, Артем, Архангельск, Ачинск, Барнаул, Бахчисарай, Белово, Бийск, Бикин Хабаровский край, Биробиджан, Благовещенск, Борзя, Братск, Владивосток, Горно-Алтайск, Грозный, Губкинский, Джанкой, Евпатория, Елизово, Железногорск Красноярский край, Забайкальск, Заринск, Зеленогорск Красноярский край, Иркутск, Калининград, Канск, Кемерово, Керчь, Киселёвск, Когалым, Комсомольск-на-Амуре, Коротчаево Ямало-Ненецкий авт. Округ, Красноперекопск, Красноярск, Кызыл Тыва респ., Ленинск-Кузнецкий, Магадан, Махачкала, Мегион, Междуреченск, Мирный Саха респ. (Якутия), Надым, Нарьян-Мар, Находка, Нерюнгри, Нефтеюганск, Нижневартовск, Новоалтайск, Новокузнецк, Новосибирск, Новый Уренгой, Норильск, Ноябрьск, Нягань, Омск, Петропавловск-Камчатский, Пограничный, Покровка, Салехард, Севастополь, Северодвинск, Симферополь, Советский, Стрежевой, Сургут, Томск, Улан-Удэ, Урай, Усолье-Сибирское, Уссурийск, Ухта, Феодосия, Хабаровск, Ханты-Мансийск, Черноморское, Чита, Шарыпово, Южно-Сахалинск, Якутск.</p>
				<span class="txt-uppercase">В города перечисленные выше доставка бесплатная при заказе от 20000 тысяч рублей (СДЭК).</span>
			</div>
            <div class="basket-content-aside-box">
                <p>
                    <strong>Оплата</strong>
                </p>    
            	<p>
                    Оплата доступна только банковской картой или наличной оплатой при получении доставки.
                </p>
					<span class="txt-uppercase">Платежные системы</span><br><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/basket-logo2.svg" alt=""><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/basket-logo3.svg" alt=""><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/mir.png" alt=""><img style="height: 21px;" alt="alfabank" src="<?=SITE_TEMPLATE_PATH?>/assets/images/AlfaBank.png">


              <p>
              • выбрали понравившийся товар<br>
              • определились с цветом и размером<br>
              • добавили в корзину<br>
              • выбрали способ доставки и оплаты<br>
              • совершили оплату или выбрали оплату наличными/картой, курьеру/ПВЗ*, после чего Вы получите на почту письмо с номером Вашего заказа и чеком в электронном виде (при оплате на сайте). Когда товар будет передан курьеру, Вам так же придёт уведомление на почту, что Ваш товар уже в пути и скоро будет у Вас<br>
              </p>
              <p>
              Мы заботимся о Вашей безопасности и наш сайт поддерживает безопасную передачу данных по протоколу SSL. Наличие и актуальность протокола безопасности (передача данных и ввод каких-либо цифровых и буквенных значений зашифрован) определяется автоматически вашим браузером с устройства которого вы заходите, Вы поймёте это увидев значок замка или выделенную зелёным цветом адресную строку.
              </p>
            </div>
	</div>
	<?
	if (!empty($arResult['CURRENCIES']) && Main\Loader::includeModule('currency'))
	{
		CJSCore::Init('currency');

		?>
		<script>
			BX.Currency.setCurrencies(<?=CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true)?>);
		</script>
		<?
	}

	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedTemplate = $signer->sign($templateName, 'sale.basket.basket');
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.basket.basket');
	$messages = Loc::loadLanguageFile(__FILE__);
	?>
	<script>
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);
		BX.Sale.BasketComponent.init({
			result: <?=CUtil::PhpToJSObject($arResult, false, false, true)?>,
			params: <?=CUtil::PhpToJSObject($arParams)?>,
			template: '<?=CUtil::JSEscape($signedTemplate)?>',
			signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
			siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
			siteTemplateId: '<?=CUtil::JSEscape($component->getSiteTemplateId())?>',
			templateFolder: '<?=CUtil::JSEscape($templateFolder)?>'
		});
	</script>
	<?
	if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'BOTTOM')
	{
		?>
		<div data-entity="parent-container">
			<div class="catalog-block-header"
					data-entity="header"
					data-showed="false"
					style="display: none; opacity: 0;">
				<?=$arParams['GIFTS_BLOCK_TITLE']?>
			</div>
			<?
			$APPLICATION->IncludeComponent(
				'bitrix:sale.products.gift.basket',
				'.default',
				$giftParameters,
				$component
			);
			?>
		</div>
		<?
	}
}
elseif ($arResult['EMPTY_BASKET'])
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
	ShowError($arResult['ERROR_MESSAGE']);
}?>
        </div>
    </div>
