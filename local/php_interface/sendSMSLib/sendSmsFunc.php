<?
require_once 'sms.ru.php';
function send_sms($toPhone, $msg){
    $smsru = new SMSRU('620D388E-5B62-EAF5-B47E-7249373AC58F');

    $data = new stdClass();
    $data->to = $toPhone;
    $data->text = $msg;

    $sms = $smsru->send_one($data);

    if ($sms->status == "OK") {
        $status = true;
    } else {
        $status = false;
    }
    return $status;
}
?>