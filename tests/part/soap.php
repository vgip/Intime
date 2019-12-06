<?php

$timeoutSec = 2;
$apiKey = '10000000000001234567';

$pathConfig = join(DIRECTORY_SEPARATOR, [GIP_STORAGE_PRIVATE, 'config', 'config.php']);
require $pathConfig;

ini_set('default_socket_timeout', $timeoutSec);

$option = [
    'connection_timeout' => $timeoutSec,
//    'trace'              => 1,
//    'exceptions'         => 0
];
$urlWsdl = 'http://esb.intime.ua:8080/services/intime_api_3.0?wsdl';

header("Content-Type: application/json;charset=utf-8");
$soapClient = new SoapClient($urlWsdl, $option);

$param = [
    'api_key'                   => $apiKey,
    'locality_id'               => '112', // Kyiv
    'sender_warehouse_id'       => '1651', 
    'sender_address'            => '', 
    'receiver_okpo'             => '', 
    'receiver_company_name'     => '', 
    'receiver_cellphone'        => '380503234560',
    'receiver_lastname'         => 'Фетербух',
    'receiver_firstname'        => 'Джон',
    'receiver_patronymic'       => 'Валентинович',
    'receiver_locality_id'      => '199',
    'receiver_warehouse_id'     => '1785',
    'receiver_address'          => '',
    'payment_type_id'           => '1',
    'payer_type_id'             => '2',
    'return_day'                => '',
    'cost_return'               => '2123',
    'cash_on_delivery_sum'      => '2125',
    'client_doc_id'             => '',
    'cancel_packaging'          => '',
    'sender_paid_sum'           => '',
    'third_party_okpo'          => '',
    'third_party_company_name'  => '',
    'third_party_cellphone'     => '',
    'third_party_lastname'      => '',
    'third_party_firstname'     => '',
    'third_party_patronymic'    => '',
    'third_party_locality_id'   => '',
    'third_party_store_id'      => '',
    'third_party_address'       => '',
    'packages'                  => '',
    'commands'                  => '',
    'services'                  => '',
    'containers'                => '',
    'seats'                     => '<SEAT>
<WEIGHT_M>15</WEIGHT_M>
<LENGTH_M>2</LENGTH_M>
<WIDTH_M>3</WIDTH_M>
<HEIGHT_M>1</HEIGHT_M>
<COUNT_M>1</COUNT_M>
<GOODS_TYPE_ID>1</GOODS_TYPE_ID>
<GOODS_TYPE_DESCR_ID>241</GOODS_TYPE_DESCR_ID>
</SEAT>',
];

$response = $soapClient->declaration_insert_update($param);

var_dump($response);
//var_dump($soapClient->__getFunctions ());
//var_dump($soapClient->__getTypes());

//  print "<pre>\n";
//  print "Запрос :\n".htmlspecialchars($client->__getLastRequest()) ."\n";
//  print "Ответ:\n".htmlspecialchars($client->__getLastResponse())."\n";
//  print "</pre>";

echo 'Under construction';
