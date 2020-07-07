<?
//include $_SERVER["DOCUMENT_ROOT"]."/local/php_interface/sendSMSLib/sendSmsFunc.php";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
//  global   $USER ;
// $USER ->Authorize( 93 );
?>
<?

//send_sms('79992045625',"Привет");
?>
<div class="container inner">
	 <?/*
<?$APPLICATION->IncludeComponent("bitrix:sender.subscribe", "subscribeMobile", Array(
	"AJAX_MODE" => "Y",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "Y",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CONFIRMATION" => "N",	// Запрашивать подтверждение подписки по email
		"HIDE_MAILINGS" => "Y",	// Скрыть список рассылок, и подписывать на все
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_HIDDEN" => "Y",	// Показать скрытые рассылки для подписки
		"USER_CONSENT" => "N",	// Запрашивать согласие
		"USER_CONSENT_ID" => "0",	// Соглашение
		"USER_CONSENT_IS_CHECKED" => "Y",	// Галка по умолчанию проставлена
		"USER_CONSENT_IS_LOADED" => "N",	// Загружать текст сразу
		"USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
	),
	false
);?>
*/?> <?/*
<?//$_SESSION['']
global $USER;
$aSubscrRub = array();
if(CModule::IncludeModule('subscribe')){
  $rs = CSubscription::GetList(array("ID"=>"DESC"), array("USER"=>$USER->GetID()));
  if($ar = $rs->Fetch()) {
    $aSubscrRub = CSubscription::GetRubricArray($USER->GetID() );
  }
}
print_r($aSubscrRub);

?> <?
if ($USER->IsAuthorized()){?> <?}?><br>
 <br>
 <br>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.form",
	".default",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"PAGE" => "",
		"SHOW_HIDDEN" => "Y",
		"USE_PERSONALIZATION" => "Y"
	)
);?><br>
 <br>
 <br>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.edit",
	".default",
	Array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALLOW_ANONYMOUS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default",
		"SET_TITLE" => "N",
		"SHOW_AUTH_LINKS" => "N",
		"SHOW_HIDDEN" => "Y"
	)
);?><br>
 <br>
 <br>
<?
            $_REQUEST['show_all']='Y';
            $APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.list", 
	".default", 
	array(
		"ACTIVE_DATE_FORMAT" => $arParams["ACTIVE_DATE_FORMAT"],
		"ALLOW_INNER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_TYPE" => "A",
		"DEFAULT_SORT" => "STATUS",
		"HISTORIC_STATUSES" => array(
			0 => "C",
			1 => "F",
		),
		"ID" => $arResult["VARIABLES"]["ID"],
		"NAV_TEMPLATE" => "pagination",
		"ONLY_INNER_FULL" => "N",
		"ORDERS_PER_PAGE" => $arParams["ORDERS_PER_PAGE"],
		"PATH_TO_BASKET" => $arParams["PATH_TO_BASKET"],
		"PATH_TO_CANCEL" => $arResult["PATH_TO_ORDER_CANCEL"],
		"PATH_TO_CATALOG" => $arParams["PATH_TO_CATALOG"],
		"PATH_TO_COPY" => $arResult["PATH_TO_ORDER_COPY"],
		"PATH_TO_DETAIL" => $arResult["PATH_TO_ORDER_DETAIL"],
		"PATH_TO_PAYMENT" => $arParams["PATH_TO_PAYMENT"],
		"REFRESH_PRICES" => "N",
		"RESTRICT_CHANGE_PAYSYSTEM" => array(
			0 => "P",
		),
		"SAVE_IN_SESSION" => "N",
		"SET_TITLE" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"DISALLOW_CANCEL" => "N",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_OP" => "gray",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"STATUS_COLOR_S" => "gray",
		"STATUS_COLOR_T" => "gray",
		"STATUS_COLOR_C" => "gray",
		"STATUS_COLOR_P" => "yellow"
	),
	$component
);?>
 <br>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.cancel", 
	"orderCancel", 
	array(
		"PATH_TO_LIST" => "test.php",
		"PATH_TO_DETAIL" => "order_detail.php?ID=#ID#",
		"ID" => $ID,
		"SET_TITLE" => "Y",
		"COMPONENT_TEMPLATE" => "orderCancel"
	),
	false
);?>
 <br>
 <br>
 <br>
</div>
<br>

</div>
 &nbsp; &nbsp;<?$APPLICATION->IncludeComponent(
	"reaspekt:reaspekt.geoip",
	"",
Array()
);?><br>
    */?>
    <br>
    <br><br><br><br><br><br><br><br><br><br><br><br>


<?
$APPLICATION->IncludeComponent(
    'bitrix:catalog.product.subscribe',
    '.default',
    array(
        'CUSTOM_SITE_ID' => isset($arParams['CUSTOM_SITE_ID']) ? $arParams['CUSTOM_SITE_ID'] : null,
        'PRODUCT_ID' => $arResult['ID'],
        'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
        'BUTTON_CLASS' => 'btn btn-default product-item-detail-buy-button',
        'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
        'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
    ),
    $component,
    array('HIDE_ICONS' => 'N')
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>