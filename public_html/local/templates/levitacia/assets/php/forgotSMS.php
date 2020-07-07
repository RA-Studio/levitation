<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
require_once $_SERVER['DOCUMENT_ROOT'].'/local/php_interface/sendSMSLib/sendSmsFunc.php';
if(isset($_POST['phone']) && $_POST['phone']) {
    global $USER;
    $data = CUser::GetList(($by="ID"), ($order="ASC"),
        array(
            'ACTIVE' => 'Y'
        )
    );
    $userExist = false;
    while($arUser = $data->Fetch()) {
        if(!empty($arUser['PERSONAL_PHONE'])){
            $userPhone = preg_replace("/[^,.0-9]/", '', $arUser['PERSONAL_PHONE']);
            if($userPhone === $_POST['phone']){
                $_SESSION['CHK_PSW_USER_ID_'] = $arUser['ID'];
                $userExist = true;
            }
        }
    }

    if($userExist) {
        $msg = random_int(1000, 9999);
        if (send_sms($_POST['phone'], $msg)){
            $_SESSION['USER_USER_CHECKWORD'] = password_hash($msg, PASSWORD_DEFAULT);
            echo json_encode(array(
                'response' => 'Сообщение отправлено на Ваш номер! Перенаправление на страницу восстановления пароля...',
                'success' => true,
            ));
        } else {
            echo json_encode(array(
                'response' => 'Не верный номер. Если ошибка не пропадает, свяжитесь с администратором сайта.',
                'success' => false,
            ));
        }
    } else {
        echo json_encode(array(
            'response' => 'Не найдено ни одного пользователя с введенным номером! Попробуйте ввести E-mail.',
            'success' => false,
        ));
    }
}

if (isset($_POST['hash']) && isset($_POST['code'])) {
    if (password_verify($_POST['code'], $_POST['hash'])) {
        //unset($_SESSION['USER_USER_CHECKWORD']);
        $user = new CUser;
        $fields = Array(
            "PASSWORD"          => $_POST['userPassw'],
            "CONFIRM_PASSWORD"  => $_POST['userPasswConfirm'],
        );
        $user->Update($_SESSION['CHK_PSW_USER_ID_'], $fields);
        $strError = $user->LAST_ERROR;

        if($strError === '') {
            echo json_encode(array(
                'response' => 'Пароль успешно изменен!',
                'success' => true,
            ));
        } else {
            echo json_encode(array(
                'response' => $strError,
                'success' => false,
            ));
        }
    } else {
        echo json_encode(array(
            'response' => 'Не верный код.',
            'success' => false,
        ));
    }
}

?>