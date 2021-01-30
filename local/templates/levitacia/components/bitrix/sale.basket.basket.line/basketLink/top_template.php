<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
$dbBasketItems = CSaleBasket::GetList(
    array("NAME" => "ASC", "ID" => "ASC"),
    array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
    false,
    false,
    array("ID",  "PRODUCT_ID", "QUANTITY")
);
while ($arItems = $dbBasketItems->Fetch()){
    $arBasketItems[] = $arItems;
    $quantity +=$arItems['QUANTITY'];
}
?>

    <?if (!$compositeStub && $arParams['SHOW_AUTHOR'] == 'Y'):?>

            <?if ($USER->IsAuthorized()):
                $name = trim($USER->GetFullName());
                if (! $name)
                    $name = trim($USER->GetLogin());
                if (strlen($name) > 15)
                    $name = substr($name, 0, 12).'...';
                ?>
        <?if(CSite::InDir('/personal/index.php')){?>
            <div class="header-menu__item">
                <a href="/">Главная</a>
            </div>
            <div class="header-menu__item">
                <a href="?logout=yes"><?=GetMessage('TSB1_LOGOUT')?></a>
            </div>
        <?}else{?>
        <div class="header-menu__item">
                <a href="<?=$arParams['PATH_TO_PROFILE']?>">Мой профиль</a>
            </div>
            <?}?>
            <?else:
                $arParamsToDelete = array(
                    "login",
                    "login_form",
                    "logout",
                    "register",
                    "forgot_password",
                    "change_password",
                    "confirm_registration",
                    "confirm_code",
                    "confirm_user_id",
                    "logout_butt",
                    "auth_service_id",
                    "clear_cache",
                    "backurl",
                );

                $currentUrl = urlencode($APPLICATION->GetCurPageParam("", $arParamsToDelete));
            if ($arParams['AJAX'] == 'N')
            {
                ?><script type="text/javascript"><?=$cartId?>.currentUrl = '<?=$currentUrl?>';</script><?
            }
            else
            {
                $currentUrl = '#CURRENT_URL#';
            }

            $pathToAuthorize = $arParams['PATH_TO_AUTHORIZE'];
            //$pathToAuthorize .= (stripos($pathToAuthorize, '?') === false ? '?' : '&');
            //$pathToAuthorize .= 'login=yes&backurl='.$currentUrl;
            ?>
<div class="header-menu__item">
                <a href="<?=$pathToAuthorize?>">
                    <?=GetMessage('TSB1_LOGIN')?>
                </a>

</div>
            <?
            if ($arParams['SHOW_REGISTRATION'] === 'Y')
            {
            $pathToRegister = $arParams['PATH_TO_REGISTER'];
            $pathToRegister .= (stripos($pathToRegister, '?') === false ? '?' : '&');
            $pathToRegister .= 'register=yes&backurl='.$currentUrl;
            ?>
<div class="header-menu__item">
                <a href="<?=$pathToRegister?>">
                    <?=GetMessage('TSB1_REGISTER')?>
                </a>
</div>
                <?
            }
                ?>
            <?endif?>
    <?endif?>
<div class="header-menu__item" id="basket">
    <a href="<?=$arParams['PATH_TO_BASKET']?>">Корзина
        <span>(<span class="cart-num"><?=($quantity) ? $quantity : 0;?></span>)</span>
    </a>
</div>