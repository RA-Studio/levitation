<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\SystemException;
use \Bitrix\Sale\Order;
use \Bitrix\Sale\PaySystem;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Заказ оплачен");
$APPLICATION->SetPageProperty("keywords", "Заказ оплачен");
$APPLICATION->SetPageProperty("description", "Заказ оплачен");
$APPLICATION->SetTitle("Заказ оплачен");

define("STOP_STATISTICS", true);
define('NO_AGENT_CHECK', true);
define('NOT_CHECK_PERMISSIONS', true);
define("DisableEventsCheck", true);


global $APPLICATION;

if (CModule::IncludeModule("sale"))
{
	$context = Application::getInstance()->getContext();
	$request = $context->getRequest();

	$item = PaySystem\Manager::searchByRequest($request);

	if ($item !== false)
	{
		
		$service = new PaySystem\Service($item);

		if ($service instanceof PaySystem\Service)
		{
		    ?><div class="container">
            <div class="basket-empty alfa-success" style="margin-top:0">
                <h1 class="title"><?=$APPLICATION->ShowTitle(false)?></h1>
                <div class="basket-empty__title"><?=$result = $service->processRequest($request);?></div>
                <div class="text__content">Подробная информация по Вашему заказу на почте и в <a href="/personal/" class="" style="display: inline-block;text-decoration: underline;">личном кабинета</a> интернет-магазина.</div>
            </div>
        </div>
            <!--<script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    setTimeout(function () {
                        window.location.href = "/personal/";
                    },3000);
                });
            </script>-->
		<?}
	}
	else
	{
		$debugInfo = implode("\n", $request->toArray());
		PaySystem\Logger::addDebugInfo('Pay system not found. Request: '.$debugInfo);
	}
}

// $APPLICATION->FinalActions();
header("Location: https://levitacia.co/personal/");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");


?>