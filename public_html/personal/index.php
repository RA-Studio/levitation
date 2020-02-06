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
		 <?/*
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
            */?>
		<div class="lk-info tabs">
			<div class="lk-nav">
                <a href="#lk-info1" class="lk-nav__item active">Мои заказы</a>
                <a href="#lk-info2" class="lk-nav__item">Мои данные </a>
                <a href="#lk-info3" class="lk-nav__item">Профили доставки</a>
			</div>
            <?$_REQUEST['show_all']='Y'?>
            <?$APPLICATION->IncludeComponent(
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
);?>
			 <?/*
<form class="lk-tab tab-wide active" id="lk-info1">
				<div class="lk-tab-orders">
					<div class="lk-tab-orders-row lk-tab-orders-header">
						<div class="lk-tab-orders-row-col">
						</div>
						<div class="lk-tab-orders-row-col">
							Этап 1
						</div>
						<div class="lk-tab-orders-row-col">
							Этап 2
						</div>
						<div class="lk-tab-orders-row-col">
							Этап 3
						</div>
						<div class="lk-tab-orders-row-col">
							Этап 4
						</div>
						<div class="lk-tab-orders-row-col">
						</div>
					</div>
					<div class="lk-tab-orders-row">
						<div class="lk-tab-orders-row-col">
							№20084
						</div>
						<div class="lk-tab-orders-row-col done">
							1
						</div>
						<div class="lk-tab-orders-row-col current">
							2
						</div>
						<div class="lk-tab-orders-row-col">
							3
						</div>
						<div class="lk-tab-orders-row-col">
							4
						</div>
						<div class="lk-tab-orders-row-col">
							01.03.20
						</div>
					</div>
					<div class="lk-tab-orders-row">
						<div class="lk-tab-orders-row-col">
							№18789
						</div>
						<div class="lk-tab-orders-row-col done">
							1
						</div>
						<div class="lk-tab-orders-row-col done">
							2
						</div>
						<div class="lk-tab-orders-row-col current">
							3
						</div>
						<div class="lk-tab-orders-row-col">
							4
						</div>
						<div class="lk-tab-orders-row-col">
							17.01.20
						</div>
					</div>
					<div class="lk-tab-orders-row done">
						<div class="lk-tab-orders-row-col">
							№18084
						</div>
						<div class="lk-tab-orders-row-col done">
							1
						</div>
						<div class="lk-tab-orders-row-col done">
							2
						</div>
						<div class="lk-tab-orders-row-col done">
							3
						</div>
						<div class="lk-tab-orders-row-col done">
							4
						</div>
						<div class="lk-tab-orders-row-col">
							22.12.19
						</div>
					</div>
				</div>
			</form>
<form>
                        <div class="tab-wide-col">
                            <label for="surname" class="lk-tab__label">Фамилия</label>
                            <input type="text" class="lk-tab__input" name="surname" id="surname" placeholder="">
                            <label for="name" class="lk-tab__label">Имя</label>
                            <input type="text" class="lk-tab__input" name="name" id="name" placeholder="">
                            <label for="patronymic" class="lk-tab__label">Отчество</label>
                            <input type="text" class="lk-tab__input" name="patronymic" id="patronymic" placeholder="">
                            <label for="phone" class="lk-tab__label">Номер телефона</label>
                            <input type="text" class="lk-tab__input" name="phone" id="phone" placeholder="">
                            <button class="lk-tab__submit">Сохранить изменения</button>
                        </div>
                        <div class="tab-wide-col">
                            <label for="country" class="lk-tab__label">Страна доставки</label>
                            <input type="text" class="lk-tab__input" name="country" id="country" placeholder="">
                            <label for="city" class="lk-tab__label">Город доставки</label>
                            <input type="text" class="lk-tab__input" name="city" id="city" placeholder="">
                        </div>
                    </form>
                    <!--<form>
                        <div class="tab-wide-col">
                            <label for="promo" class="lk-tab__label">Промокод</label>
                            <input type="text" class="lk-tab__input" name="promo" id="promo" placeholder="">
                            <button class="lk-tab__submit">Применить</button>
                        </div>
                    </form>-->
                    <div class="lk-tab-bonus">
                        <span>Мои бонусные баллы:</span>
                        <span>3220 <span>₽</span></span>
                    </div>
                    <form class="lk-tab" id="lk-info3">
 <label for="country" class="lk-tab__label">Страна доставки</label> <input type="text" class="lk-tab__input" name="country" id="country" placeholder=""> <label for="city" class="lk-tab__label">Город доставки</label> <input type="text" class="lk-tab__input" name="city" id="city" placeholder=""> <label for="street" class="lk-tab__label">Улица</label> <input type="text" class="lk-tab__input" name="street" id="street" placeholder=""> <label for="flat" class="lk-tab__label">Квартира</label> <input type="text" class="lk-tab__input" name="flat" id="flat" placeholder=""> <label for="index" class="lk-tab__label">Индекс</label> <input type="text" class="lk-tab__input" name="index" id="index" placeholder=""> <button class="lk-tab__submit">Сохранить изменения</button>
			</form>
*/?>
            <?$APPLICATION->IncludeComponent(
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
            <?$APPLICATION->IncludeComponent(
                "bitrix:sale.personal.profile.list",
                "profile",
                array(
                    "PATH_TO_DETAIL" => "",
                    "PER_PAGE" => "1",
                    "SET_TITLE" =>"N",
                ),
                $component
            );?>
		</div>
	</div>
	 <?/*<div class="service-tabs">
        <section class="service-tabs-wrap lk">
            <span class="service-tabs-navigation__span"> </span>
            <ul class="service-tabs-navigation">
                <li><a class="service-tabs-navigation__item" href="#serviceTab1">Mои заказы</a></li>
                <li><a class="service-tabs-navigation__item" href="#serviceTab2">Мои данные</a></li>
                <li><a class="service-tabs-navigation__item" href="#serviceTab3">Адрес доставки</a></li>
                <!--			<li><a class="service-tabs-navigation__item" href="#serviceTab4">Пользовательское соглашение</a></li>--> <!--			<li><a class="service-tabs-navigation__item" href="#serviceTab5">Таблица размеров</a></li>--> <!--			<li><a class="service-tabs-navigation__item" href="#feedback">Обратная связь</a></li>-->
                <?global $USER;
                if ($USER->IsAuthorized()){?>
                    <a class="service-tabs-navigation__item" href="?logout=yes" id="logout" >Выйти</a>
                <?}?>
            </ul>

        </section>
        <div class="service-tabs-tab lk" id="serviceTab1">
            <div class="service-tabs-tab__title">
                Mои заказы
            </div>

        </div>
        <div class="service-tabs-tab lk" id="serviceTab2">
            <div class="service-tabs-tab__title">
                Мои данные
            </div>
            <div class="service-tabs-tab__text" id="auth">
                <?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"personal", 
	array(
		"AJAX_MODE" => $arParams["AJAX_MODE_PRIVATE"],
		"CHECK_RIGHTS" => "N",
		"EDITABLE_EXTERNAL_AUTH_ID" => $arParams["EDITABLE_EXTERNAL_AUTH_ID"],
		"SEND_INFO" => "N",
		"SET_TITLE" => "N",
		"COMPONENT_TEMPLATE" => "personal",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => ""
	),
	$component
);?>
            </div>
        </div>
        <div class="service-tabs-tab lk" id="serviceTab3">
            <div class="service-tabs-tab__title">
                Адрес доставки
            </div>
            <div class="service-tabs-tab__text">
                <?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.edit", 
	"subscribe", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALLOW_ANONYMOUS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "subscribe",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SET_TITLE" => "N",
		"SHOW_AUTH_LINKS" => "N",
		"SHOW_HIDDEN" => "Y"
	),
	false
);?>
            </div>
        </div>
    </div>*/?>
<?/*
    <div class="login">
        <form class="login-col" action="#">
            <div class="login-col__title">Login</div>
            <label for="login">Login email</label>
            <input type="text" id="login">
            <label for="password">Password</label>
            <input type="password" id="password">
            <div class="login-col-row">
                <label for="remember">
                    <input type="checkbox" id="remember"><span></span><span>Remember me</span>
                </label>
            </div><span>Forgot Password?</span>
            <button class="login-col__btn" type="submit">Login</button>
        </form>
        <form class="login-col" action="#">
            <div class="login-col__title">Create an account</div>
            <label for="email">Email</label>
            <input type="text" id="email">
            <label for="pass">Account password</label>
            <input type="password" id="pass">
            <label for="confirmPass">Password Confirmation</label>
            <input type="password" id="confirmPass">
            <div class="login-col-row">
                <label for="newsletter">
                    <input type="checkbox" id="newsletter"><span></span><span>Sign up to the newsletter</span>
                </label>
            </div>
            <div class="login-col-row">
                <label for="male">
                    <input type="radio" name="sex" id="male"><span></span><span>Male</span>
                </label>
                <label for="female">
                    <input type="radio" name="sex" id="female"><span></span><span>Female</span>
                </label>
            </div>
            <div class="login-col-row">
                <label for="privacy">
                    <input type="checkbox" id="privacy"><span></span><span>I have read the privacy information notice</span>
                </label>
            </div>
            <button class="login-col__btn" type="submit">Create</button>
        </form>
    </div>
    */?>
</div>
<br><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>