<?php 

use Vgip\Intime\Api\Config AS IntimeApiConfig;
use Vgip\Intime\Api\ConfigDefault AS IntimeApiConfigDefault;
use Vgip\Intime\Api\Api AS IntimeApi;
use Vgip\Intime\Dir\PropertyTypeCommon;
use Vgip\Intime\Type\TypeInt;

use Vgip\Intime\Api\Result\ProcessingSetter;

$apiKey = '10000000000001234567';
$declarationId = '';

$pathConfig = join(DIRECTORY_SEPARATOR, [GIP_STORAGE_PRIVATE, 'config', 'config.php']);
require $pathConfig;

//$property = PropertyTypeCommon::getInstance();
//$idType = new TypeInt(5, 100000, false);
//$property->setId($idType);

$intimeApiConfigDefault = new IntimeApiConfigDefault();
$intimeApiConfigDefault->setDefaultConfig();

$intimeApiConfig        = new IntimeApiConfig($intimeApiConfigDefault);
$intimeApiConfig->setKey($apiKey);
$intimeApiConfig->setRestRequestType('POST');
$intimeApiConfig->setResultDataSkipIfError(false);

$intimeApi              = new IntimeApi($intimeApiConfig);

$declarationCreateData = [
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
    'return_day'                => '1',
    'cost_return'               => '2123',
    'cash_on_delivery_sum'      => '2125',
    'client_doc_id'             => '',
    'cancel_packaging'          => '',
    'sender_paid_sum'           => '',
    'third_party_okpo'          => '',
    'third_party_company_name'  => '',
    'third_party_cellphone'     => '',
    'third_party_lastname'      => '',
    'third_party_patronymic'    => '',
    'third_party_address'       => '',
    'packages'                  => '',
    'commands'                  => '',
    'services'                  => '',
    'containers'                => '',
    'seats'                     => '<SEAT>
<GOODS_TYPE_ID>1</GOODS_TYPE_ID>
<WEIGHT_M>32</WEIGHT_M>
<LENGTH_M>60</LENGTH_M>
<WIDTH_M>30</WIDTH_M>
<HEIGHT_M>45</HEIGHT_M>
<WEIGHT_R></WEIGHT_R>
<GSIZE_R></GSIZE_R>
<COUNT_M>2</COUNT_M>
<GOODS_TYPE_DESCR_ID>836</GOODS_TYPE_DESCR_ID>
<BOX_ID></BOX_ID>
</SEAT>',
];
$resultConnection         = $intimeApi->createDeclaration($declarationCreateData);

$dataRequest    = $resultConnection->getRequestBody();

$dataRaw           = $resultConnection->getAnswerRaw();
//$data = $resultConnection->getAnswerArrayRaw();
//$data = $resultConnection->getAnswerArray();
//$data = $resultConnection->getAnswer();

$error = $resultConnection->getError();
$errorCounter = $error->getErrorCounter();

if ($errorCounter > 0) {
    print_r($error->getErrorAll());
}
print_r($dataRequest);
print_r($dataRaw);
