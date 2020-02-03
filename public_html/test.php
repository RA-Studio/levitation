<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
    <div class="lk-acc tabs">

        <div class="lk-tab active" id="lk-acc1">
            <? $APPLICATION->IncludeComponent(
                "bitrix:system.auth.registration",
                "registration",
                Array(
                    "AUTH" => "Y",
                    "COMPONENT_TEMPLATE" => ".default",
                    "REQUIRED_FIELDS" => array(),
                    "SET_TITLE" => "N",
                    "SHOW_FIELDS" => array(),
                    "SUCCESS_PAGE" => SITE_DIR."personal/",
                    "USER_PROPERTY" => array(),
                    "USER_PROPERTY_NAME" => "",
                    "USE_BACKURL" => "Y"
                )
            );?>
        </div>

    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>