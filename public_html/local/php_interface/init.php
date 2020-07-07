<?
mb_internal_encoding('utf-8');
use Bitrix\Main;
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
        $tallage = 3;
        $priceAdd = ($money * ($tallage / 100)); //вычисление процентов

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

