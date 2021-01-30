<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?=SITE_CHARSET?>">
    <title><?$APPLICATION->ShowTitle()?></title><?
    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    $APPLICATION->ShowMeta("description");
    $APPLICATION->ShowMeta("title");
    ?><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <!--CSS--><?
    $APPLICATION->AddHeadString('<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&amp;display=swap" rel="stylesheet">',true);
    $APPLICATION->AddHeadString('<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:700&display=swap" rel="stylesheet">',true);
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/assets/scripts/fancybox/jquery.fancybox.min.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/assets/scripts/slick/slick.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/assets/scripts/slick/slick-theme.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/assets/styles/app.min.css');
    ?><!--JS-->
    
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.4.0/dist/lazyload.min.js"></script>
    <?
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/jquery.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/fancybox/jquery.fancybox.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/slick/slick.min.js");
    $APPLICATION->AddHeadScript("/local/components/slam/easyform/templates/uniform/uniform.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/main.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/ecommerceFunc.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/IMask.js");
    
    //if(in_array($_SERVER['REMOTE_ADDR'],['185.97.201.199', '83.102.147.81', '78.107.205.212', '5.18.184.71'])){
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/authSms.js");
    //}
    ?><!--ICONS-->
    <?
    $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH."/include/counters.php",
        array(),
        array(
            "NAME"=>"counters",
            "MODE" => "html"
        )
    );
    ?>
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/apple-touch-icon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/apple-touch-icon.png">

    
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M22FJDX"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<?global $USER;
/*
if(!$USER->IsAdmin()){?>
    <style>
        .plug-popup {
            display: flex;
            position: fixed;
            z-index: 10000;
            width: 100%;
            height: 100%;
            background: white;
            top: 0;
            left: 0;
        }
        .plug-popup__wrapper{
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            margin: auto auto;
            position: relative;
            text-align: center;
            width: 684px;
        }
        .plug-popup__main{
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
        }
        .plug-popup__main-title{
            font-size: 39px;
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .plug-popup__main-description{
            font-size: 25px;
        }
        .plug-popup__footer{
            display: flex;
            justify-content: space-around;
            text-decoration: underline;
        }
    </style>
    <div class="plug-popup">
        <div class="plug-popup__wrapper">
            <div class="plug-popup__main">
                <div class="plug-popup__main-title">
                    Сайт временно недоступен - ведутся технические работы!
                </div>
                <div class="plug-popup__main-description">
                    Приносим извинения за доставленные неудобства.
                </div>
            </div>
            <div class="plug-popup__footer">
                <a href="tel:8 (800) 350-20-28" class="plug-popup__footer-phone">8 (800) 350-20-28</a>
                <a href="mailto:info@levitacia.co" class="plug-popup__footer-mail">info@levitacia.co</a>
            </div>
        </div>
    </div>
<?}else{?>

<?}*/?>
<div class="wrapper">
    <div class="overlay"></div>
    <?
    if(!defined('ERROR_404') && ERROR_404 !=='Y' ) { // если не на 404
    ?>
    <header class="header"><?
        if(CSite::InDir('/index.php') && !isset($_GET['q'])){?>
            <span class="header__logo"><?
            $APPLICATION->IncludeFile(
                    SITE_TEMPLATE_PATH."/include/logo.php",
                    array(),
                    array(
                            "NAME"=>"Логотип",
                            "MODE" => "html"
                    )
            );
            ?></span><?
        }else{
            ?><a class="header__logo" href="/"><?
            $APPLICATION->IncludeFile(
                    SITE_TEMPLATE_PATH."/include/logo.php",
                    array(),
                    array(
                            "NAME"=>"Логотип",
                            "MODE" => "html"
                    )
            );
            ?></a><?
        }
        ?>
        <!--bascet-->
        <?$APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket.line",
                "basketLinkMobile",
                array(
                        "COMPONENT_TEMPLATE" => "basketLink",
                        "HIDE_ON_BASKET_PAGES" => "N",
                        "PATH_TO_AUTHORIZE" => "",
                        "PATH_TO_BASKET" => SITE_DIR."basket/",
                        "PATH_TO_ORDER" => SITE_DIR."basket/checkout/",
                        "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                        "PATH_TO_PROFILE" => SITE_DIR."personal/",
                        "PATH_TO_REGISTER" => SITE_DIR."login/",
                        "POSITION_FIXED" => "N",
                        "SHOW_AUTHOR" => "N",
                        "SHOW_EMPTY_VALUES" => "Y",
                        "SHOW_NUM_PRODUCTS" => "Y",
                        "SHOW_PERSONAL_LINK" => "N",
                        "SHOW_PRODUCTS" => "N",
                        "SHOW_REGISTRATION" => "N",
                        "SHOW_TOTAL_PRICE" => "N"
                ),
                false
        );?>
        <!--Menu-->
        <div class="header__burger">
            <svg width="26" height="17" viewBox="0 0 26 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 7H26V10H0V7ZM0 14H26V17H0V14Z" fill="black"/>
            <path d="M26 3H0V0H26V3Z" fill="black"/>
            </svg>
        </div><?
        if(!CSite::InDir('/404.php') ) {
            ?><div class="header-menu">
            <div class="header-menu__close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/></svg>
            </div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket.line",
                "basketLink",
                array(
                  "COMPONENT_TEMPLATE" => "basketLink",
                  "HIDE_ON_BASKET_PAGES" => "N",
                  "PATH_TO_AUTHORIZE" => SITE_DIR."personal/login/",
                  "PATH_TO_BASKET" => SITE_DIR."basket/",
                  "PATH_TO_ORDER" => SITE_DIR."basket/checkout/",
                  "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                  "PATH_TO_PROFILE" => SITE_DIR."personal/",
                  "PATH_TO_REGISTER" => SITE_DIR."personal/login/",
                  "POSITION_FIXED" => "N",
                  "SHOW_AUTHOR" => "Y",
                  "SHOW_EMPTY_VALUES" => "Y",
                  "SHOW_NUM_PRODUCTS" => "Y",
                  "SHOW_PERSONAL_LINK" => "Y",
                  "SHOW_PRODUCTS" => "N",
                  "SHOW_REGISTRATION" => "N",
                  "SHOW_TOTAL_PRICE" => "N"
                ),
                false
              );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:search.page",
                "catalog",
                array(
                    "RESTART" => "Y",
                    "NO_WORD_LOGIC" => "Y",
                    "USE_LANGUAGE_GUESS" => "N",
                    "CHECK_DATES" => "Y",
                    "arrFILTER" => array(
                            0 => "iblock_catalog",
                    ),
                    "={\"arrFILTER_iblock_\".\$arParams[\"IBLOCK_TYPE\"]}" => array(
                            0 => $arParams["IBLOCK_ID"],
                    ),
                    "USE_TITLE_RANK" => "N",
                    "DEFAULT_SORT" => "rank",
                    "FILTER_NAME" => "catalogFilter",
                    "SHOW_WHERE" => "N",
                    "arrWHERE" => "",
                    "SHOW_WHEN" => "N",
                    "PAGE_RESULT_COUNT" => (isset($arParams["PAGE_RESULT_COUNT"])?$arParams["PAGE_RESULT_COUNT"]:50),
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "N",
                    "COMPONENT_TEMPLATE" => "catalog",
                    "arrFILTER_iblock_catalog" => array(
                            0 => "2",
                    ),
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600"
                ),
                $component,
                array(
                        "HIDE_ICONS" => "N"
                )
            );?>


            <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"collection",
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPONENT_TEMPLATE" => "collection",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "collection",
		"USE_EXT" => "Y"
	),
	false
); ?>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "top",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "COMPONENT_TEMPLATE" => "top",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "N"
                ),
                false
            );
            ?>
            </div><?
        }

        ?></header>
    <?
    if(!CSite::InDir('/basket/index.php')) {

        $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . "/include/banners.php",
                array(),
                array(
                        "NAME" => "Логотип",
                        "MODE" => "html"
                )
        );
    }
    } else {
        ?>
        <header class="header">
            <span class="header__logo"><?
                $APPLICATION->IncludeFile(
                        SITE_TEMPLATE_PATH."/include/logo.php",
                        array(),
                        array(
                                "NAME"=>"Логотип",
                                "MODE" => "html"
                        )
                );
                ?></span>
        </header>
        <?
    }
    ?>

    <?/**/?>
    <?global $USER;
    if($USER->IsAdmin()){?>
    <?}else{?>
        <?$APPLICATION->IncludeComponent("bitrix:sender.subscribe", "subscribe", Array(
            "AJAX_MODE" => "Y",	// Включить режим AJAX
            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
            "AJAX_OPTION_HISTORY" => "Y",	// Включить эмуляцию навигации браузера
            "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
            "CACHE_TIME" => "3600",	// Время кеширования (сек.)
            "CACHE_TYPE" => "A",	// Тип кеширования
            "CONFIRMATION" => "N",	// Запрашивать подтверждение подписки по email
            "HIDE_MAILINGS" => "Y",	// Скрыть список рассылок, и подписывать на все
            "SET_TITLE" => "N",	// Устанавливать заголовок страницы
            "SHOW_HIDDEN" => "Y",	// Показать скрытые рассылки для подписки
            "USER_CONSENT" => "N",	// Запрашивать согласие
            "USER_CONSENT_ID" => "0",	// Соглашение
            "USER_CONSENT_IS_CHECKED" => "Y",	// Галка по умолчанию проставлена
            "USER_CONSENT_IS_LOADED" => "N",	// Загружать текст сразу
            "USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
        ),
            false
        );?>
        <?if($_SESSION['SHOW_SUBSCRIBE']!='N'){?>
            <?$APPLICATION->IncludeComponent("bitrix:sender.subscribe", "subscribeMobile", Array(
                "AJAX_MODE" => "Y",	// Включить режим AJAX
                "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                "AJAX_OPTION_HISTORY" => "Y",	// Включить эмуляцию навигации браузера
                "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                "CACHE_TIME" => "3600",	// Время кеширования (сек.)
                "CACHE_TYPE" => "A",	// Тип кеширования
                "CONFIRMATION" => "N",	// Запрашивать подтверждение подписки по email
                "HIDE_MAILINGS" => "Y",	// Скрыть список рассылок, и подписывать на все
                "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                "SHOW_HIDDEN" => "Y",	// Показать скрытые рассылки для подписки
                "USER_CONSENT" => "N",	// Запрашивать согласие
                "USER_CONSENT_ID" => "0",	// Соглашение
                "USER_CONSENT_IS_CHECKED" => "Y",	// Галка по умолчанию проставлена
                "USER_CONSENT_IS_LOADED" => "N",	// Загружать текст сразу
                "USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
            ),
                false
            );?>
        <?}?>
    <?}?>
    <div class="content">

						