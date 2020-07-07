<?
//$url = 'https://levitacia.bitrix24.ru/rest/1/kufnoohpwvnvjpjj/crm.deal.list/';
$url = 'https://levitacia.bitrix24.ru/rest/1/kufnoohpwvnvjpjj/crm.contact.list/';
$data = [];
if( $curl = curl_init() ) {
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
    $data = json_decode($out, true);
    curl_close($curl);
}
echo count($data['result']).'<br>';
echo '<pre>';
print_r($data);
echo '</pre>';

/*foreach ($data['result'] as $item){
    echo $item['ID'].' --- '.$item['STAGE_ID'].'<br>';
}*/