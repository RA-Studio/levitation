<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Контакты");
$APPLICATION->SetPageProperty("keywords", "Контакты");
$APPLICATION->SetPageProperty("description", "Контакты");
$APPLICATION->SetTitle("Контакты");
?><div class="container inner">
    <h1 class="title"><?=$APPLICATION->ShowTitle(false)?></h1>
    <div class="contacts">
        <div class="contacts__title">ТЕЛЕФОН</div>
        <a class="contacts__link" href="tel:88127010520">8 (800) 350-20-28</a>
        <div class="contacts__title">E-MAIL</div>
        <a class="contacts__link" href="mailto:info@levitacia.co">info@levitacia.co</a>
        <div class="contacts__title">ЮРИДИЧЕСКАЯ ИНФОРМАЦИЯ</div>
        <div class="contacts__link">ООО "РИВОЛТА"</br>ОГРН 1177847330100</br>ИНН 7804607944 / КПП 780201001</div>
        <div class="contacts__title">ЮРИДИЧЕСКИЙ АДРЕС / ФАКТИЧЕСКИЙ АДРЕС</div>
        <div class="contacts__link">194044, г. Санкт-Петербург, улица Гельсингфорсская, дом 3 ЛИТЕР Л, ПОМЕЩЕНИЕ Л-207</div>
        <div class="contacts__title">АДРЕС ШОУ-РУМА</div>
        <div class="contacts__link">191124, г. Санкт-Петербург, Смольный проспект, дом 17</div>
        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2115.14819029818!2d30.33357760637152!3d59.97471057705667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x469633e107f425b5%3A0x700517118dc2e9e7!2z0JrRgNCw0YHQvdCw0Y8g0J3QuNGC0YwsINCf0J3Qmg!5e0!3m2!1sru!2sru!4v1569242764399!5m2!1sru!2sru" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->
		<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ac935fb68854b4c73a7fe011f73be9abe2440f9094f998e9c8bb658a0ef2b3d6e&amp;source=constructor" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
</div><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>