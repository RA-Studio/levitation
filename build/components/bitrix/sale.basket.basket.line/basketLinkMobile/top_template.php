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
<!--<a class="header__cart" href="<?/*=$arParams['PATH_TO_BASKET']*/?>">-->
    <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.1594 18H0.272991C0.198264 18 0.126809 17.9694 0.0755367 17.9155C0.024264 17.8615 -0.00300873 17.7889 0.000264002 17.7142L0.6139 4.82781C0.620991 4.68218 0.740446 4.56818 0.886628 4.56818H12.5457C12.6914 4.56818 12.8114 4.68218 12.8184 4.82781L13.4321 17.7142C13.4354 17.7889 13.4086 17.8615 13.3568 17.9155C13.305 17.9694 13.2335 18 13.1594 18ZM0.558809 17.4545H12.873L12.2855 5.11363H1.14626L0.558809 17.4545Z" fill="black"></path>
        <path d="M9.66421 6.20455C9.51366 6.20455 9.39148 6.08236 9.39148 5.93182V3.22091C9.39148 1.746 8.19148 0.545455 6.71603 0.545455C5.24057 0.545455 4.04057 1.746 4.04057 3.22091V5.93182C4.04057 6.08236 3.91839 6.20455 3.76784 6.20455C3.6173 6.20455 3.49512 6.08236 3.49512 5.93182V3.22091C3.49512 1.44491 4.94003 0 6.71603 0C8.49203 0 9.93693 1.44491 9.93693 3.22091V5.93182C9.93693 6.08236 9.8153 6.20455 9.66421 6.20455Z" fill="black"></path>
    </svg>
    <span>(<span class="mobileMenu-numGoods"><?=($quantity) ? $quantity : 0;?></span>)</span>
<!--</a>-->