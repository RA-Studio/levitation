<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Авторизация");
?><div class="container">
    <div class="lk">
        <div class="lk-acc tabs">
            <div class="lk-nav">
                <a href="#lk-acc1" class="lk-nav__item">Создать аккаунт</a>
                <a href="#lk-acc2" class="lk-nav__item active">Вход</a>
            </div>
            <form class="lk-tab" id="lk-acc1">
                <label for="create-email" class="lk-tab__label">Email</label>
                <input type="text" class="lk-tab__input" name="create-email" id="create-email" placeholder="">
                <label for="create-pass" class="lk-tab__label">Пароль</label>
                <input type="text" class="lk-tab__input" name="create-pass" id="create-pass" placeholder="">
                <label for="create-privacy" class="lk-tab__rowlabel">
                    <input id="create-privacy" name="create-privacy" type="checkbox">
                    <span></span>
                    <span>Я прочитал политику конфиденциальности</span>
                </label>
                <label for="create-subscribe" class="lk-tab__rowlabel">
                    <input type="checkbox" id="create-subscribe" name="create-subscribe" checked>
                    <span></span>
                    <span>Подписаться на новости</span>
                </label>
                <label for="create-remember" class="lk-tab__rowlabel">
                    <input type="checkbox" id="create-remember" name="create-remember">
                    <span></span>
                    <span>Запомнить меня</span>
                </label>
                <button class="lk-tab__submit">Создать</button>
            </form>
            <form class="lk-tab active" id="lk-acc2">
                <label for="email" class="lk-tab__label">Email</label>
                <input type="text" class="lk-tab__input" name="email" id="email" placeholder="">
                <label for="pass" class="lk-tab__label">Пароль</label>
                <input type="text" class="lk-tab__input" name="pass" id="pass" placeholder="">
                <label for="remember" class="lk-tab__rowlabel">
                    <input type="checkbox" id="remember" name="remember">
                    <span></span>
                    <span>Запомнить меня</span>
                </label>
                <button class="lk-tab__submit">Создать</button>
            </form>
        </div>
    </div>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>