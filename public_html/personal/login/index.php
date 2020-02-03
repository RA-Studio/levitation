<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
global $USER;
if ($USER->IsAuthorized()) {
    LocalRedirect('/personal/');
}
?><div class="lk-acc tabs">
	<div class="lk-nav">
        <a href="#lk-acc1" class="lk-nav__item active">Вход</a> <a href="#lk-acc2" class="lk-nav__item">Создать аккаунт</a>
	</div>
    <?$APPLICATION->IncludeComponent(
        "bitrix:system.auth.authorize",
        ".default",
        Array(
            "COMPONENT_TEMPLATE" => ".default",
            "FORGOT_PASSWORD_URL" => "",
            "PROFILE_URL" => SITE_DIR."personal/",
            "REGISTER_URL" => "",
            "SHOW_ERRORS" => "N"
        )
    );
    $APPLICATION->IncludeComponent(
        "bitrix:system.auth.registration",
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