<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once $_SERVER['DOCUMENT_ROOT'].'/local/php_interface/sendSMSLib/sendSmsFunc.php';
global $USER;
if(isset($_POST['phone'])){
    $toPhone = $_POST['phone'];

    $data = CUser::GetList(($by="ID"), ($order="ASC"),
        array(
            'ACTIVE' => 'Y'
        )
    );
    $userExist = false;
    while($arUser = $data->Fetch()) {
        if(!empty($arUser['PERSONAL_PHONE'])){
            $userPhone = preg_replace("/[^,.0-9]/", '', $arUser['PERSONAL_PHONE']);
            if($userPhone === $toPhone){
                $_SESSION['USER_ID'] = $arUser['ID'];
                $userExist = true;
            }
        }
    }

    if($userExist) {
        $msg = random_int(1000, 9999);

        if (send_sms($toPhone, $msg)){
            echo json_encode(array(
                'response' => 'На указанный выше телефон отправлен код подтверждения, введите его и нажмите на кнопку войти',
                'hash' => password_hash($msg, PASSWORD_DEFAULT),
                'success' => true,
            ));
        } else {
            echo json_encode(array(
                'response' => 'Не верный номер. Если ошибка не пропадает, свяжитесь с администратором сайта или попробуйте авторизоваться с помощью <a href="/personal/mail-login/">E-mail</a>.',
                'success' => false,
            ));
        }
    } else {
        echo json_encode(array(
            'response' => 'Не найдено ни одного пользователя с введенным номером! Попробуйте войти по <a href="/personal/mail-login/" style="text-decoration: underline">почте</a> или <a href="/personal/login/#lk-acc2" style="text-decoration: underline">создать аккаунт.</a>',
            'success' => false,
        ));
    }
}

if (isset($_POST['hash']) && isset($_POST['code'])) {
    if (password_verify($_POST['code'], $_POST['hash'])) {
        $USER ->Authorize($_SESSION['USER_ID']);
        echo json_encode(array(
            'response' => 'Успешно! Перенаправление в личный кабинет...',
            'success' => true,
        ));
    } else {
        echo json_encode(array(
            'response' => 'Не верный код.',
            'success' => false,
        ));
    }
}

?>
