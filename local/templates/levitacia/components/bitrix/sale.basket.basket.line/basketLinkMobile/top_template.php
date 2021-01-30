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
<!--<a class="header__cart" href="<?/*=$arParams['PATH_TO_BASKET']*/?>" id="bx_basketFKauiI">-->
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" viewBox="0 0 24 24"><path d="M10 19.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5zm3.5-1.5c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm-10.563-5l-2.937-7h16.812l-1.977 7h-11.898zm11.233-5h-11.162l1.259 3h9.056l.847-3zm5.635-5l-3.432 12h-12.597l.839 2h13.239l3.474-12h1.929l.743-2h-4.195z"/></svg>
    <span><span class="mobileMenu-numGoods"><?=($quantity) ? $quantity : 0;?></span></span>
<!--</a>-->