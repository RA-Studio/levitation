<?php

require_once 'sms.ru.php';

/*function send_sms($phone, $message)
{
    //https://cab.websms.ru//http_in5.asp?http_username=director@levitacia.co&http_password=b6ZaDkGBMtH77rQ&phone_list=79992373291&message=текст сообщения&format=xml

    $login = "director@levitacia.co";
    $password = "b6ZaDkGBMtH77rQ";
    $u        = 'http://www.websms.ru/http_in6.asp';
    $params = array(
        'http_username' => $login,
        'http_password' => $password,
        'Phone_list' => $phone,
        'Message' => $message
    );
    $ch       = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_URL, $u);
    $u = trim(curl_exec($ch));

    if (!curl_errno($ch)) {
        $info = curl_getinfo($ch);
    }else{
        $info = curl_getinfo($ch);
    }

    curl_close($ch);

    if($info['http_code'] != 200) {
        echo json_encode(array(
            'response' => $info['http_code'],
            'success' => false,
        ));
        return false;
    }

    preg_match("/message_id\s*=\s*[0-9]+/i", $u, $arr_id);

    return preg_replace("/message_id\s*=\s*//*i", "", @strval($arr_id[0]));
}*/

function send_sms($toPhone, $msg){
    $smsru = new SMSRU('620D388E-5B62-EAF5-B47E-7249373AC58F');

    $data = new stdClass();
    $data->to = $toPhone;
    $data->text = $msg;

    $sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную

    if ($sms->status == "OK") { // Запрос выполнен успешно
        /*echo "Сообщение отправлено успешно. ";
        echo "ID сообщения: $sms->sms_id. ";
        echo "Ваш новый баланс: $sms->balance";*/
        return true;
    } else {
        /*echo "Сообщение не отправлено. ";
        echo "Код ошибки: $sms->status_code. ";
        echo "Текст ошибки: $sms->status_text.";*/
        return false;
    }
}

if(!empty($_REQUEST['BX_USER_ID']) && !empty($_REQUEST['BITRIX_SM_LOGIN'])) {
    if(isset($_POST['phone'])){
        $toPhone = $_POST['phone'];
        $msg = random_int(1000, 9999);
        /*echo json_encode(array(
            'response' => password_hash($msg, PASSWORD_DEFAULT),
            'code' => $msg,
            'success' => true,
        ));*/

        if (send_sms($toPhone, $msg)){
            echo json_encode(array(
                'response' => password_hash($msg, PASSWORD_DEFAULT),
                'code' => $msg,
                'success' => true,
            ));
        } else {
            echo json_encode(array(
                'response' => 'Не верный номер. Если ошибка не пропадает, свяжитесь с администратором сайта.',
                'success' => false,
            ));
        }
    }

    if (isset($_POST['hash']) && isset($_POST['code'])) {
        if (password_verify($_POST['code'], $_POST['hash'])) {
            echo json_encode(array(
                'success' => true,
            ));
        } else {
            echo json_encode(array(
                'response' => 'Не верный код.',
                'success' => false,
            ));
        }
    }
}

?>
