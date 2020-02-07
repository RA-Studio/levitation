<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Мой профиль / _Levitacia^");
$APPLICATION->SetPageProperty("keywords", "Мой профиль / _Levitacia^");
$APPLICATION->SetPageProperty("description", "Мой профиль / _Levitacia^");
$APPLICATION->SetTitle("Мой профиль / _Levitacia^");
global $USER;
if (!$USER->IsAuthorized()) {
    LocalRedirect('/personal/login/');
}
?><div class="container">
	<div class="lk">
		<div class="lk-info tabs">
			<div class="lk-nav">
                <a href="#lk-info1" class="lk-nav__item active">Мои заказы</a>
                <a href="#lk-info2" class="lk-nav__item">Мои данные </a>
                <a href="#lk-info3" class="lk-nav__item">Профили доставки</a>
			</div><?
            $_REQUEST['show_all']='Y';
            $APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.list",
	"orderList",
	array(
		"ACTIVE_DATE_FORMAT" => $arParams["ACTIVE_DATE_FORMAT"],
		"ALLOW_INNER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_TYPE" => "A",
		"DEFAULT_SORT" => "STATUS",
		"HISTORIC_STATUSES" => array(
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
		),
		"SAVE_IN_SESSION" => "N",
		"SET_TITLE" => "N",
		"COMPONENT_TEMPLATE" => "orderList",
		"DISALLOW_CANCEL" => "N",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_OP" => "gray",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"STATUS_COLOR_S" => "gray",
		"STATUS_COLOR_T" => "gray"
	),
	$component
);?><?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"personal",
	Array(
		"AJAX_MODE" => $arParams["AJAX_MODE_PRIVATE"],
		"CHECK_RIGHTS" => "N",
		"COMPONENT_TEMPLATE" => "personal",
		"EDITABLE_EXTERNAL_AUTH_ID" => $arParams["EDITABLE_EXTERNAL_AUTH_ID"],
		"SEND_INFO" => "N",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => ""
	),
$component
);?><?$APPLICATION->IncludeComponent(
                "bitrix:sale.personal.profile.list",
                "profile",
                array(
                    "PATH_TO_DETAIL" => "",
                    "PER_PAGE" => "1",
                    "SET_TITLE" =>"N",
                ),
                $component
            );
        ?></div>
	</div>
</div>
<br><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>