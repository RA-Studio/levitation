<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//file_put_contents(dirname(__FILE__).'/log.log', print_r($_POST, true), FILE_APPEND);

$APPLICATION->IncludeComponent(
    "sotbit:crmbitrix24",
    "",
    Array(
        "AUTH" => $_POST["auth"],
        "DATA" => $_POST["data"],
        "EVENT" => $_POST["event"]
    )
);
?>