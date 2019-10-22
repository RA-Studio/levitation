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
    <!--CSS--><?
    $APPLICATION->AddHeadString('<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&amp;display=swap" rel="stylesheet">',true);
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
<div id="panel">
    <?$APPLICATION->ShowPanel();?>
</div>
<div class="wrapper">
    <div class="overlay"></div>
    <header class="header">
        <a class="header__logo" href="/">
            <img src="<?=SITE_TEMPLATE_PATH?>/assets/images/logo.png" alt="">
        </a>
        <a class="header__cart" href="basket.html">
            <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.1594 18H0.272991C0.198264 18 0.126809 17.9694 0.0755367 17.9155C0.024264 17.8615 -0.00300873 17.7889 0.000264002 17.7142L0.6139 4.82781C0.620991 4.68218 0.740446 4.56818 0.886628 4.56818H12.5457C12.6914 4.56818 12.8114 4.68218 12.8184 4.82781L13.4321 17.7142C13.4354 17.7889 13.4086 17.8615 13.3568 17.9155C13.305 17.9694 13.2335 18 13.1594 18ZM0.558809 17.4545H12.873L12.2855 5.11363H1.14626L0.558809 17.4545Z" fill="black"></path>
                <path d="M9.66421 6.20455C9.51366 6.20455 9.39148 6.08236 9.39148 5.93182V3.22091C9.39148 1.746 8.19148 0.545455 6.71603 0.545455C5.24057 0.545455 4.04057 1.746 4.04057 3.22091V5.93182C4.04057 6.08236 3.91839 6.20455 3.76784 6.20455C3.6173 6.20455 3.49512 6.08236 3.49512 5.93182V3.22091C3.49512 1.44491 4.94003 0 6.71603 0C8.49203 0 9.93693 1.44491 9.93693 3.22091V5.93182C9.93693 6.08236 9.8153 6.20455 9.66421 6.20455Z" fill="black"></path>
            </svg>
            <span>5</span>
        </a>
        <div class="header__burger">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="13" fill="none">
                <path d="M.5 11.933H18M.5.622H18M.5 6.277H18" stroke="#000"/>
            </svg>
        </div>
        <div class="header-menu">
            <div class="header-menu__close">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none">
                    <path d="M1 21L21 1m0 20L1 1" stroke="#000" stroke-width=".8"/>
                </svg>
            </div>
            <div class="header-menu-lang">
                <a class="header-menu-lang__item active" href="#">EN</a>
                <a class="header-menu-lang__item" href="#">RU</a>
            </div>
            <div class="header-menu__item">
                <a href="login.html">Login</a>
            </div>
            <div class="header-menu__item" id="basket">
                <a href="basket-empty.html">Shopping bag<span> (0)</span></a>
            </div>
            <div class="header-menu__item" id="basket">
                <a href="basket.html">Shopping bag<span> (2)</span></a>
            </div>
            <div class="header-menu__item" id="search-btn">
                <a href="#">Search</a>
                <div class="header-menu__item-search-wrap">
                    <form class="header-menu__item-search" action="#">
                        <input type="text" name="search">
                        <button type="submit">Ок</button>
                    </form>
                </div>
            </div>
            <div class="header-menu__item"><a href="/">Show all</a></div>
            <div class="header-menu__item"><a href="concept-good.html">Concept only</a></div>
            <div class="header-menu__item"><a href="basic-good.html">Without concept</a></div>
        </div>
    </header>
    <div class="banners">
        <a class="banners-item" href="#" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/images/banners-item.jpg')">
            <span style="bottom: 100px">Special Offer</span>
        </a>
        <a class="banners-item" href="#" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/images/banners-item.jpg')">
            <span style="bottom: 100px">Special Offer</span>
        </a>
        <a class="banners-item" href="#" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/assets/images/banners-item.jpg')">
            <span style="bottom: 100px">Special Offer</span>
        </a>
    </div>
    <div class="content">
						