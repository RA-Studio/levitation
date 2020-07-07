<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Восстановление пароля / _Levitacia^");
$APPLICATION->SetPageProperty("description", "Восстановление пароля / _Levitacia^");
$APPLICATION->SetTitle("Восстановление пароля / _Levitacia^");
?><div class="lk-acc tabs">
        <div class="lk-nav">
            <a href="#lk-acc1" class="lk-nav__item active">Выслать данные</a> <a href="#lk-acc2" class="lk-nav__item">Восстановить</a>
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.forgotpasswd",
            "",
            Array()
        );?>

    <?
    $APPLICATION->IncludeComponent(
        "bitrix:system.auth.changepasswd",
        ".default",
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>