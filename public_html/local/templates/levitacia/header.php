<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?$APPLICATION->ShowTitle()?></title><?
    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    $APPLICATION->ShowMeta("description");
    $APPLICATION->ShowMeta("title");
    ?><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta name="cmsmagazine" content="5030b50dd17858824f3ab635603e59bc" />
    <!--CSS--><?
    $APPLICATION->AddHeadString('<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&amp;display=swap" rel="stylesheet">',true);
    $APPLICATION->AddHeadString('<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:700&display=swap" rel="stylesheet">',true);
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/assets/scripts/fancybox/jquery.fancybox.min.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/assets/scripts/slick/slick.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/assets/scripts/slick/slick-theme.css');
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/assets/styles/app.min.css');
    ?><!--JS--><?
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/jquery.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/fancybox/jquery.fancybox.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/slick/slick.min.js");
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/assets/scripts/main.js");
    ?><!--ICONS-->
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/apple-touch-icon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/assets/images/apple-touch-icon.png">
</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
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
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="13" fill="none">
                <path d="M.5 11.933H18M.5.622H18M.5 6.277H18" stroke="#000"/>
            </svg>
        </div><?
        if(!CSite::InDir('/404.php') ) {
            ?><div class="header-menu">
            <div class="header-menu__close">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                    <path d="M1 21L21 1m0 20L1 1" stroke="#000" stroke-width=".8"/>
                </svg>
            </div>
          <!--
            <div class="header-menu-lang">
                <a class="header-menu-lang__item active" href="/en/">EN</a>
                <a class="header-menu-lang__item" href="/">RU</a>
            </div>
          -->
            <!--<div class="header-menu__item">
                <a href="login.html">Login</a>
            </div>
            <div class="header-menu__item" id="basket">
                <a href="basket-empty.html">Shopping bag<span> (0)</span></a>
            </div>-->
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
                  "PATH_TO_REGISTER" => SITE_DIR."auth/",
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
            <?
            /*
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.search",
                "",
                Array(
                    "ACTION_VARIABLE" => "action",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BASKET_URL" => "/personal/basket.php",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "N",
                    "CONVERT_CURRENCY" => "N",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_COMPARE" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "ELEMENT_SORT_FIELD" => "sort",
                    "ELEMENT_SORT_FIELD2" => "id",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "ELEMENT_SORT_ORDER2" => "desc",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                    "IBLOCK_ID" => "",
                    "IBLOCK_TYPE" => "rest_entity",
                    "LINE_ELEMENT_COUNT" => "3",
                    "NO_WORD_LOGIC" => "N",
                    "OFFERS_LIMIT" => "5",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Товары",
                    "PAGE_ELEMENT_COUNT" => "30",
                    "PRICE_CODE" => array(),
                    "PRICE_VAT_INCLUDE" => "Y",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "PRODUCT_PROPERTIES" => array(),
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "PROPERTY_CODE" => array("",""),
                    "RESTART" => "N",
                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                    "SECTION_URL" => "",
                    "SHOW_PRICE_COUNT" => "1",
                    "USE_LANGUAGE_GUESS" => "Y",
                    "USE_PRICE_COUNT" => "N",
                    "USE_PRODUCT_QUANTITY" => "N"
                ),
                array("HIDE_ICONS"=>"N")
            );
            $APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket.line",
                "",
                Array(
                    "HIDE_ON_BASKET_PAGES" => "Y",
                    "PATH_TO_AUTHORIZE" => "",
                    "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                    "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                    "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                    "PATH_TO_PROFILE" => SITE_DIR."personal/",
                    "PATH_TO_REGISTER" => SITE_DIR."login/",
                    "POSITION_FIXED" => "N",
                    "SHOW_AUTHOR" => "Y",
                    "SHOW_DELAY" => "N",
                    "SHOW_EMPTY_VALUES" => "Y",
                    "SHOW_IMAGE" => "Y",
                    "SHOW_NOTAVAIL" => "N",
                    "SHOW_NUM_PRODUCTS" => "Y",
                    "SHOW_PERSONAL_LINK" => "Y",
                    "SHOW_PRICE" => "Y",
                    "SHOW_PRODUCTS" => "Y",
                    "SHOW_REGISTRATION" => "Y",
                    "SHOW_SUMMARY" => "Y",
                    "SHOW_TOTAL_PRICE" => "Y"
                ),
                array("HIDE_ICONS"=>"N")
            );
           */
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
            ?></div><?
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
    <div class="content">
						