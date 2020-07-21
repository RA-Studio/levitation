<?
    require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
    include $_SERVER["DOCUMENT_ROOT"]."/local/php_interface/sendSMSLib/sendSmsFunc.php";
    
    if(!CModule::IncludeModule("iblock")) echo 'error';
    function actionReturn($data, $message, $sucsecc = true) {
        return json_encode([
            "isSuccess" => $sucsecc,
            "message" => $message,
            "data" => $data,
        ]);
    }
    function  actionSendConfirmation() {

        global $USER;
        if (!is_object($USER))  $USER = new \CUser();
        $smsText = rand(1000, 9999);
        $phone = $_REQUEST['phone'];
        $order = $_REQUEST['order'];
        
        $link = md5(sha1($order));

        if(empty($phone)){
            return actionReturn([],'не введен телефон', false);
        }
        
        $el = new CIBlockElement;
        $PROP = array();
        $PROP[40] = "Отправлено";  // Статус
        $PROP[41] = $order;  // Заказ
        
        $sendPhone = $phone;
        
        if($phone) {
            $PROP[42] = $phone;
            $sendPhone = $phone;
        }
        
        $aLPA = array(
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"      => 5,
            "NAME"           => "Отказ",
            "ACTIVE"         => "Y",
            "CODE"         => $link,
            "PROPERTY_VALUES"=> $PROP,
        );

        if($PRODUCT_ID = $el->Add($aLPA)) {

        } else {
            return actionReturn([],'Произошла ошибка', false);
        }
        
        $sendPhone = preg_replace("/[^,.0-9]/", '', $sendPhone);
        
        if($sendPhone[0] == "8") {
            $sendPhone[0] = 7;
        }
        
        $linkSendUser = "https://levitacia.co/return/signature/?ORDER_ID=".$link;
        send_sms($sendPhone, $linkSendUser);
        
        return actionReturn([
            $sendPhone,
        ], $linkSendUser);
    }

    function actionConfirmSignature() {

        $img = $_REQUEST['img'];
        $order_id = $_REQUEST['order_id'];
        $sign = json_decode($_REQUEST['sign'], true);


        CIBlockElement::SetPropertyValuesEx($sign['ID'], $sign['IBLOCK_ID'], array(
            "UF_STATUS" => "Подтверждено",
            "UF_SIGNATURE" => $img,
        ));

        return actionReturn([],'');
    }
    function actionGetSignature() {
        
        if(!isset($_REQUEST['order'])) actionReturn([], "Не задан ID заказа", false);
        
        $arFilter = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "CODE" => md5(sha1($_REQUEST['order']))); //, "PROPERTY_UF_STATUS" => "Подтверждено"
        
        $res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, false, Array("nPageSize"=>1), Array("ID", "IBLOCK_ID", "PROPERTY_*", "CODE"));
        global $USER;
        
        $sing = false;
        
        while($ob = $res->GetNextElement()) {
            $sing = $ob->GetFields();
            $sing['PROPERTIES'] = $ob->GetProperties();
        }
        if($sing === false) {
            return actionReturn([],'Произошла ошибка', false);
        }
        if($sing['PROPERTIES']['UF_SIGNATURE']['VALUE']) {
            return actionReturn([
                'sign' => $sing['PROPERTIES']['UF_SIGNATURE']['VALUE'],
            ],'');
        } else {
            return actionReturn([
                'sign' => false,
            ],'');
        }
    }
    $result = [];
    switch($_REQUEST['action']) {
        case "SendConfirmation":
            $result = actionSendConfirmation();
        break;
        case "ConfirmSignature":
            $result = actionConfirmSignature();
        break;
        case "GetSignature":
            $result = actionGetSignature();
        break;
        default: 
            $result = actionReturn([],'Произошла ошибка', false);
        break;
    }
    echo($result);