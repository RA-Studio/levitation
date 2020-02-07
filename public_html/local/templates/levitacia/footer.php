<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?></div><?

if(ERROR_404 !== 'Y') {
    ?><footer class="footer">
    <div class="footer-toTop <?$APPLICATION->ShowProperty('toTopClass')?>"></div>
    <div class="footer-top">
        <div class="footer-top-col"><?
            $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . "/include/copyright.php",
                array(),
                array(
                    "NAME" => "Копирайт",
                    "MODE" => "html"
                )
            );
            $APPLICATION->IncludeFile(
                SITE_TEMPLATE_PATH . "/include/developer.php",
                array(),
                array(
                    "NAME" => "Данные о разработчике",
                    "MODE" => "html"
                )
            ); ?>
        </div><?
        $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "bottom",
            Array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "COMPONENT_TEMPLATE" => ".default",
                "DELAY" => "Y",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => "",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "bottom",
                "USE_EXT" => "Y"
            )
        );
        ?></div>
</footer><?
}
?></div>
</body>
</html>
