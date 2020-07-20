<?
define ('CASHBACK_PERCENT', 3);
mb_internal_encoding('utf-8');
use Bitrix\Main;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

function getColor ( $id , $filter = []){
    if ($id==0) return false;
    if (CModule::IncludeModule("highloadblock") ) {
        $hlblock = HL\HighloadBlockTable::getById($id)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entityClass = $entity->getDataClass();
        $res = $entityClass::getList(array('select' => array('*'), 'filter' => $filter));
        $row = $res->fetch();
        return $row;
    }else return false;
}



AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);
function _Check404Error()
{
    if (defined('ERROR_404') && ERROR_404 == 'Y' || CHTTP::GetLastStatus() == "404 Not Found") {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        require $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/404.php';
        require $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/footer.php';
    }
}
Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderSaved',
    'saleOrderSaved'
);
function saleOrderSaved(Main\Event $event)
{
    /** @var Order $order */
    $order = $event->getParameter("ENTITY");
    $propertyCollection = $order->getPropertyCollection();
    $userID = $order->getUserId();
    $propsData = [];
    foreach ($propertyCollection as $propertyItem) {
        if (!empty($propertyItem->getField("CODE"))) {
            $propsData[$propertyItem->getField("CODE")] = trim($propertyItem->getValue());
        }
    }
    $user = new CUser;
    $fields = Array(
        "PERSONAL_PHONE"=>$propsData['PHONE'],
        /*"PHONE_NUMBER"=>$propsData['PHONE'],*/
    );
    $user->Update($userID, $fields);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/order.txt', serialize($userID).serialize($propsData),FILE_APPEND);
}
function OnBeforeUserUpdateHandler(&$arFields)
{
    $arFields["LOGIN"] = $arFields["EMAIL"];
    return $arFields;
}

AddEventHandler("sale", "OnSaleBeforeOrderCanceled", "OnSaleBeforeOrderCanceledHandlers");

function OnSaleBeforeOrderCanceledHandlers(&$order)
{
    if ($order->isCanceled()) {
        $order->setField("STATUS_ID", 'C');
    }
}


AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserRegisterHandler");
function OnBeforeUserRegisterHandler($args)
{
    $GLOBALS['REGISTER_ERROR'] = "Пользователь с данной почтой уже зарегистрирован!";
    $data = CUser::GetList(($by = "ID"), ($order = "ASC"),
        array(
            "EMAIL" => $args['EMAIL']
        )
    );
    if ($arUser = $data->Fetch()) {
        $GLOBALS['REGISTER_ERROR'] = "Пользователь с данной почтой уже зарегистрирован!";
        return false;
    }
    return true;
}

function sendInSlack($message, $token = "https://hooks.slack.com/services/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")
{
    $postString = json_encode([
        'text' => $message,
    ]);

    $ch = curl_init();
    $options = [
        CURLOPT_URL => $token,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Content-type: application/json'],
        CURLOPT_POSTFIELDS => $postString
    ];
    if (defined('CURLOPT_SAFE_UPLOAD')) {
        $options[CURLOPT_SAFE_UPLOAD] = true;
    }
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    curl_close($ch);
}

AddEventHandler("main", "OnAfterUserUpdate", "OnAfterUserChangePassword");
function OnAfterUserChangePassword($args)
{
    $GLOBALS['CHEK'] = 'TEST';
    unset($_SESSION['USER_USER_CHECKWORD']);
    $GLOBALS['CHANGE_PASSWORD'] = $args['RESULT'];
    return true;
}

\Bitrix\Main\EventManager::getInstance()->addEventHandler('sale', 'OnSaleOrderEntitySaved', 'OnStatusChange');
function OnStatusChange(Bitrix\Main\Event $event)
{
    $arEmailFields = array();
    $order = $event->getParameter("ENTITY");
    $oldValues = $event->getParameter("VALUES");
    $arOrderVals = $order->getFields()->getValues();

    if ($arOrderVals['STATUS_ID'] == "P" && CModule::IncludeModule('sale')) {
        $money = $order->getPrice();
        $priceAdd = ($money * (CASHBACK_PERCENT / 100)); //вычисление процентов

        $res = CSaleUserTransact::GetList(
            array("ID" => "DESC"),
            array(
                "USER_ID" => $order->getUserId(),
                "ORDER_ID" => $order->getId(),
            ),
            false,
            array("nPageSize" => 1)
        );

        $transfer = $res->fetch();

        if (!$transfer || $transfer['DEBIT'] == "N") {
            CSaleUserAccount::UpdateAccount(
                $order->getUserId(),
                $priceAdd,
                'RUB',
                "ORDER_PAY",
                $order->getId()
            );
        }
    }
}



AddEventHandler("sale", "OnOrderNewSendEmail", "OnOrderChangeMailCustom");//new
/*AddEventHandler("sale", "OnOrderPaySendEmail", "OnOrderChangeMailCustom");//payd
AddEventHandler("sale", "OnSaleStatusEMail", "OnOrderChangeMailCustom");//change
AddEventHandler("sale", "OnOrderCancelSendEmail", "OnOrderChangeMailCustom");//cansel*/
function OnOrderChangeMailCustom($orderID, &$eventName, &$arFields)
{
    $data = '<table class="basket">';
    $basket = [];
    $orderProps = [];

    $dbBasketItems = CSaleBasket::GetList(array(), array("ORDER_ID" => $orderID), false, false, array());
    while ($arItems = $dbBasketItems->Fetch()) {
        $basket[$arItems['PRODUCT_ID']] = $arItems;
    }
    $dbOrderProps = CSaleOrderPropsValue::GetList([], ["ORDER_ID" => $orderID, "CODE" => ["LOCATION", "STREET","	HOUSE","FLAT"]]);
    while ($arOrderProps = $dbOrderProps->GetNext()){
        $orderProps[$arOrderProps['CODE']] = $arOrderProps;
    }
    $location = CSaleLocation::GetByID($orderProps['LOCATION']['VALUE_ORIG'], 'ru');
    $address = '';
    $address .= $location['CITY_NAME']?'г. '.$location["CITY_NAME"]:'';
    $address .= !empty($orderProps['STREET']['VALUE'])?' ул. '.$orderProps['STREET']['VALUE']:'';
    $address .= !empty($orderProps['HOUSE']['VALUE'])?' д. '.$orderProps['HOUSE']['VALUE']:'';
    $address .= !empty($orderProps['FLAT']['VALUE'])?' кв. '.$orderProps['FLAT']['VALUE']:'';

    if (CModule::IncludeModule("iblock")) {
        $arFilter = array("IBLOCK_ID" => 3, "ID" => array_keys($basket));
        $res = CIBlockElement::GetList([], $arFilter, false, []);
        while ($ob = $res->GetNextElement()) {
            $fields = $ob->GetFields();
            $fields['PROPERTIES'] = $ob->GetProperties();
            $basket[$fields['ID']]['PRODUCT_FIELDS'] = $fields;
        }
        foreach ($basket as $key => $basketItem) {
            $colorName = $basketItem['PRODUCT_FIELDS']['PROPERTIES']['TSVET']['VALUE'];
            $size = $basketItem['PRODUCT_FIELDS']['PROPERTIES']['RAZMER']['VALUE'];
            $color = getColor(2, ['UF_NAME' => $colorName]);
            $photoUrl = CFile::GetPath($basketItem['PRODUCT_FIELDS']['PROPERTIES']['MORE_PHOTO']['VALUE'][0]);
            $data .= '<tr class="basket-item-row">
                    <td>
                        <a href="' . $basketItem["DETAIL_PAGE_URL"] . '" class="product-link">
                            <img class="product-img" src="https://levitacia.co' . $photoUrl . '" alt="' . $basketItem['NAME'] . '">
                        </a>
                    </td>
                    <td>
                        <div class="product-name">' . $basketItem['NAME'] . '</div>
                        <div class="product-item">
                        
                            <div class="product-size">' . $size . '</div>
                            <div class="product-color"><span class="product-color-view" style="background: ' . $color['UF_HEX_COLOR'] . '"></span> ' . $colorName . '</div>
                        </div>
                    </td>
                    <td>x' . $basketItem['QUANTITY'] . '</td>
                    <td>' . CurrencyFormat($basketItem['PRICE'] * $basketItem['QUANTITY'], $basketItem['CURRENCY']) . '</td>
                  </tr>
            ';
        }
    }

    $data .= '</table>';
    $arOrder = CSaleOrder::GetByID($orderID);
    $delivery = CSaleDelivery::GetByID($arOrder['DELIVERY_ID']);
    //$arFields["ORDER_FULL"] = $location['COUNTRY_NAME'].'--'.$location['CITY_NAME'].'--'.$address;
    $arFields["FULL_NAME"] = $arOrder['USER_NAME'].' '.$arOrder['USER_LAST_NAME'];
    $arFields["PRICE_DELIVERY"] = CurrencyFormat($arOrder['PRICE_DELIVERY'],$arOrder['CURRENCY']);
    $arFields["FULL_PRICE"] = CurrencyFormat($arOrder['PRICE'],$arOrder['CURRENCY']);
    $arFields['BASKET'] = $data;
    $arFields['CASHBACK'] = ($arOrder['PRICE'] * (CASHBACK_PERCENT / 100));
    $arFields['SHIPMENT_CODE'] = $arOrder['TRACKING_NUMBER'];
    $arFields['SHIPMENT_LINK'] = 'https://cdek.ru/tracking?order_id='.$arOrder['TRACKING_NUMBER'];
    $arFields['SHIPMENT_DESCRIPTION'] = $delivery['DESCRIPTION'];
    $arFields['SHIPMENT_NAME'] = $delivery['NAME'];
    $arFields['ADDRESS'] = $address;
    $arFields['PAYMENT_LINK'] = '';
}


