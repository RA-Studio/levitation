<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
$data = '{"ID":"312","LID":"s1","ACCOUNT_NUMBER":"312","TRACKING_NUMBER":null,"PAY_SYSTEM_ID":"3","DELIVERY_ID":"45","DATE_INSERT":"2020-07-07 14:48:06","DATE_UPDATE":"2020-07-07 14:48:06","PERSON_TYPE_ID":"1","USER_ID":"226","PAYED":"N","IS_SYNC_B24":"N","DATE_PAYED":null,"EMP_PAYED_ID":null,"DEDUCTED":"N","DATE_DEDUCTED":null,"EMP_DEDUCTED_ID":null,"REASON_UNDO_DEDUCTED":null,"STATUS_ID":"N","DATE_STATUS":"2020-07-07 14:48:06","EMP_STATUS_ID":null,"MARKED":"N","DATE_MARKED":null,"EMP_MARKED_ID":null,"REASON_MARKED":null,"PRICE_DELIVERY":"0","ALLOW_DELIVERY":"N","DATE_ALLOW_DELIVERY":null,"EMP_ALLOW_DELIVERY_ID":null,"RESERVED":"N","PRICE":"18490","CURRENCY":"RUB","DISCOUNT_VALUE":"0","TAX_VALUE":"3081.67","SUM_PAID":"0.00","USER_DESCRIPTION":"","PAY_VOUCHER_NUM":null,"PAY_VOUCHER_DATE":null,"ADDITIONAL_INFO":null,"COMMENTS":null,"COMPANY_ID":"0","CREATED_BY":null,"RESPONSIBLE_ID":null,"STAT_GID":null,"DATE_PAY_BEFORE":null,"DATE_BILL":null,"IS_RECURRING":"N","RECURRING_ID":null,"LOCKED_BY":null,"DATE_LOCK":null,"RECOUNT_FLAG":"Y","AFFILIATE_ID":null,"DELIVERY_DOC_NUM":null,"DELIVERY_DOC_DATE":null,"UPDATED_1C":"N","ORDER_TOPIC":null,"XML_ID":"bx_5f0460f680617","ID_1C":null,"VERSION_1C":null,"VERSION":"0","EXTERNAL_ORDER":"N","STORE_ID":null,"CANCELED":"N","EMP_CANCELED_ID":null,"DATE_CANCELED":null,"REASON_CANCELED":null,"BX_USER_ID":null,"SEARCH_CONTENT":null,"RUNNING":"Y","DATE_INSERT_FORMAT":"07.07.2020","DATE_UPDATE_SHORT":"2020-07-07 00:00:00","DATE_STATUS_SHORT":"2020-07-07 00:00:00","DATE_CANCELED_SHORT":null,"BY_RECOMMENDATION":"N","LOCK_STATUS":"green","LOCK_USER_NAME":null,"RESPONSIBLE_LOGIN":null,"RESPONSIBLE_NAME":null,"RESPONSIBLE_LAST_NAME":null,"RESPONSIBLE_SECOND_NAME":null,"RESPONSIBLE_EMAIL":null,"RESPONSIBLE_WORK_POSITION":null,"RESPONSIBLE_PERSONAL_PHOTO":null,"USER_LOGIN":"vasilevich-a-s@mail.ru","USER_NAME":"test","USER_LAST_NAME":"test","USER_EMAIL":"vasilevich-a-s@mail.ru","UALIAS_0":null,"UALIAS_1":null,"UALIAS_2":"226","DATE_UPDATE_FORMAT":"07.07.2020 14:48:06","DATE_STATUS_FORMAT":"07.07.2020 14:48:06"}';
$basket = '{"ID":"1198","LID":"s1","FUSER_ID":"44536","ORDER_ID":"314","PRODUCT_ID":"97","PRODUCT_PRICE_ID":"72","PRICE_TYPE_ID":"1","NAME":"\u0411\u0440\u044e\u043a\u0438 \u043c\u043e\u0434\u0443\u043b\u044c\u043d\u044b\u0435 \"\u0421\u043e\u043b\u0434\u0430\u0442\" (\u0447\u0451\u0440\u043d\u044b\u0439, M)","PRICE":"18490.0000","CURRENCY":"RUB","BASE_PRICE":"18490.0000","VAT_INCLUDED":"Y","DATE_INSERT":{},"DATE_UPDATE":{},"DATE_REFRESH":null,"WEIGHT":"0.00","QUANTITY":1,"DELAY":"N","CAN_BUY":"Y","MARKING_CODE_GROUP":null,"MODULE":"catalog","PRODUCT_PROVIDER_CLASS":"\Bitrix\Catalog\Product\CatalogProvider","NOTES":"\u0420\u043e\u0437\u043d\u0438\u0447\u043d\u0430\u044f","DETAIL_PAGE_URL":"\/levitatsiya_kontsept\/bryuki_modulnye_soldat\/","DISCOUNT_PRICE":"0.0000","CATALOG_XML_ID":"400c703c-5d66-49aa-b4e6-dbd140988637#","PRODUCT_XML_ID":"b1645c3f-077a-11ea-b7f1-a836628b84c7#b1645c41-077a-11ea-b7f1-a836628b84c7","DISCOUNT_NAME":null,"DISCOUNT_VALUE":null,"DISCOUNT_COUPON":null,"VAT_RATE":"0.2000","SUBSCRIBE":"N","RESERVED":"N","RESERVE_QUANTITY":null,"BARCODE_MULTI":"N","CUSTOM_PRICE":"N","DIMENSIONS":"a:3:{s:5:\"WIDTH\";N;s:6:\"HEIGHT\";N;s:6:\"LENGTH\";N;}","TYPE":null,"SET_PARENT_ID":null,"MEASURE_CODE":"796","MEASURE_NAME":"\u0448\u0442","CALLBACK_FUNC":null,"ORDER_CALL BACK_FUNC":null,"CANCEL_CALLBACK_FUNC":null,"PAY_CALLBACK_FUNC":null,"RECOMMENDATION":null,"SORT":"100","XML_ID":"bx_5f04959269be7"}';
?>

<?
$arSelect = Array("ID", "IBLOCK_ID", "NAME","TSVET","RAZMER","MORE_PHOTO");
$arFilter = Array("IBLOCK_ID"=>3, "ID"=>97,);
$basket = [];
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement()){
    if(is_object($ob)) {
        $arFields = $ob->GetFields();
        $arFields['PROPERTIES'] = $ob->GetProperties();
        $basket[97]['PRODUCT_FIELDS'] = $arFields;
    }
}
?>
<pre><?print_r($basket)?></pre>
<pre style="text-align: center"><?=print_r(json_decode(),true)?>
</pre>
---------------
    <pre style="text-align: center"><?=print_r(json_decode($basket),true)?>
</pre>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>