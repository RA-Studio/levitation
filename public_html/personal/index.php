<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Мой профиль");
$APPLICATION->SetPageProperty("keywords", "Мой профиль");
$APPLICATION->SetPageProperty("description", "Мой профиль");
$APPLICATION->SetTitle("Мой профиль");
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
		"CACHE_TYPE" => "N",
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
		"COMPONENT_TEMPLATE" => "orderList",
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
);?>
            <?if ($_GET['CANCEL']=='Y'){?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:sale.personal.order.cancel",
                    "orderCancel",
                    array(
                        "PATH_TO_LIST" => "/personal/",
                        "PATH_TO_DETAIL" => "order_detail.php?ID=#ID#",
                        "ID" => $ID,
                        "SET_TITLE" => "N",
                        "COMPONENT_TEMPLATE" => "orderCancel"
                    ),
                    false
                );?>
    <?}?>
            <?$APPLICATION->IncludeComponent(
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
<br>
<script>
    IMask(document.querySelector('[name="PERSONAL_PHONE"]'), {
        mask: [
          {
            mask: '+0 (000) 000-00-00',
            startsWith: '7',
            maxLength: 11,
            country: 'Russia'
          },
          {
            mask: '',
            startsWith: '8',
            country: 'unknown'
          },
          {
            mask: '00000000000',
            startsWith: '',
            country: 'unknown'
          },
        ],
        dispatch: function (appended, dynamicMasked) {
          var number = (dynamicMasked.value + appended).replace(/\D/g,'');
    
          return dynamicMasked.compiledMasks.find(function (m) {
            return number.indexOf(m.startsWith) === 0;
          });
        }
      }
    );
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>