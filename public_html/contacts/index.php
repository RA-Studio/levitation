<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?><div class="container inner">
        <h1 class="title"><?=$APPLICATION->ShowTitle(false)?></h1>
        <div class="contacts">
			<!--<div class="contacts__title">Общие запросы брендов</div>-->
			<div class="contacts__title">Общие запросы брендов</div>
            <a class="contacts__link" href="mailto:info@levitacia.co">info@levitacia.co</a>
            <div class="contacts__title">PR, Связи с общественностью</div>
            <a class="contacts__link" href="mailto:content@levitacia.co">content@levitacia.co</a>
            <div class="contacts__title">Коллаборации</div>
            <a class="contacts__link" href="mailto:design@levitacia.co">design@levitacia.co</a>
            <div class="contacts__text">РАБОЧИЕ ЧАСЫ: Понедельник - Пятница 9.00 - 20.00</div>
        </div>
    </div><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>