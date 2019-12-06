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
//$intimeApiConfig->setRestContentType('application/xml');
//$intimeApiConfig->setRestContentType('text/xml');
$intimeApiConfig->setResultDataSkipIfError(true);

$intimeApi              = new IntimeApi($intimeApiConfig);

//$resultConnection         = $intimeApi->getCountry(1);
//$resultConnection         = $intimeApi->getRegion(2, 1, 1);
//$resultConnection         = $intimeApi->getDistrictByRegionId(5);
//$resultConnection         = $intimeApi->getLocality(null, null, 1, 20);
//$resultConnection         = $intimeApi->getLocality(199);
$resultConnection         = $intimeApi->getLocalityByRegionId(20);
//$resultConnection         = $intimeApi->getBranch(null, null, 18);
//$resultConnection         = $intimeApi->getBranch(null, null, null, null, 5451);
//$resultConnection         = $intimeApi->getBranchWorkHours(1554);
//$resultConnection         = $intimeApi->getBranchApi2();
//$resultConnection         = $intimeApi->getGoodsDescription();
//$resultConnection         = $intimeApi->getPackaging(23);

$declarationUpdateData = [
    'p_decl_id' => $declarationId,
];
//$resultConnection         = $intimeApi->updateDeclaration($declarationUpdateData);
//$resultConnection         = $intimeApi->deleteDeclaration($declarationId);
//$resultConnection         = $intimeApi->getDeclaration($declarationId);
//$resultConnection         = $intimeApi->getDeclarationStatus($declarationId);
//$resultConnection         = $intimeApi->getDeclarationStatusMin($declarationId);
//$resultConnection         = $intimeApi->getDeclarationCalculate([]);



//$pathEntityModified = join(DIRECTORY_SEPARATOR, [$pathMain, 'tests', 'EntityModified', 'DistrictTest.php']);
//require $pathEntityModified.'';
//$districtTest = new DistrictTest();
//$processingSetter = ProcessingSetter::getInstance();
//$processingSetter->setDistrict($districtTest);

$dataUrlRequest = $resultConnection->getRequestUrl();

/**$dataRaw        = $resultConnection->getAnswerRaw();
print_r($dataRaw);*/

/**$dataArrayRaw   = $resultConnection->getAnswerArrayRaw();
print_r($dataArrayRaw);*/

$data           = $resultConnection->getAnswerArray();
print_r($data); 

/** $dataObj        = $resultConnection->getAnswer();
print_r($dataObj); */

$error = $resultConnection->getError();
$errorCounter = $error->getErrorCounter();
print_r($errorCounter);

if ($errorCounter > 0) {
    print_r($error->getErrorAll());
}

echo '|'.$dataUrlRequest.'|';
//print_r($dataRaw);
//print_r($dataArrayRaw);

