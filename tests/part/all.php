<?php 

use Vgip\Intime\Api\Config AS IntimeApiConfig;
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

$intimeApiConfig        = new IntimeApiConfig();
$intimeApiConfig->setKey($apiKey);
$intimeApiConfig->setRestRequestType('POST');
//$intimeApiConfig->setRestContentType('application/xml');
//$intimeApiConfig->setRestContentType('text/xml');
$intimeApiConfig->setResultDataSkipIfError(true);

$intimeApi              = new IntimeApi($intimeApiConfig);

//$resultConnection         = $intimeApi->getCountry(215);
$resultConnection         = $intimeApi->getRegion(null, null);
//$resultConnection         = $intimeApi->getArea(null, 215, 'Дніпропетровська');
//$resultConnection         = $intimeApi->getDistrict(null, null, null);
//$resultConnection         = $intimeApi->getDistrict();
//$resultConnection         = $intimeApi->getDistrictByRegionId(5);
//$resultConnection         = $intimeApi->getDistrictByAreaId(6);
//$resultConnection         = $intimeApi->getLocality(null, null, 1, 20, 'Бережанка');
//$resultConnection         = $intimeApi->getLocality(199);
//$resultConnection         = $intimeApi->getLocalityById(199);
//$resultConnection         = $intimeApi->getLocalityByRegionId(20);
//$resultConnection         = $intimeApi->getLocalityByAreaId(22);
//$resultConnection         = $intimeApi->getLocalityByDistrictId(321);
//$resultConnection         = $intimeApi->getLocalityByDistrictId();
//$resultConnection         = $intimeApi->getBranch();
//$resultConnection         = $intimeApi->getBranch(2290);
//$resultConnection         = $intimeApi->getBranch(null, null, null, null, 231);
//$resultConnection         = $intimeApi->getBranch(null, null, null, null, null, 'Корюковка');
//$resultConnection         = $intimeApi->getBranch(null, null, null, null, 5451);
//$resultConnection         = $intimeApi->getBranchById(2306);
//$resultConnection         = $intimeApi->getBranchByRegionId(1);
//$resultConnection         = $intimeApi->getBranchByAreaId(26);
//$resultConnection         = $intimeApi->getBranchByDistrictId(35);
//$resultConnection         = $intimeApi->getBranchByLocalityId(29);
//$resultConnection         = $intimeApi->getBranchWorkHours(1554);
//$resultConnection         = $intimeApi->getBranchApi2();
//$resultConnection         = $intimeApi->getContentDescription(111243);
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

//$dataUrlRequest = $resultConnection->getRequestUrl();

echo "\n\n -----------------------------------\n\n";

var_dump($resultConnection->getRequestData());

echo "\n\nRESULT CONNECTION START -----------------------------------\n\n";

print_r($resultConnection);

echo "\n\nDATA START -----------------------------------\n\n";

$dataRaw        = $resultConnection->getAnswerRaw();
print_r($dataRaw);

$dataArrayRaw   = $resultConnection->getAnswerArrayRaw();
print_r($dataArrayRaw);
//echo '|-';
//var_dump($dataArrayRaw);
//echo '-|';
//echo '|'.count($dataArrayRaw).'|';

$data           = $resultConnection->getAnswerArray();
print_r($data);

/**$dataObj        = $resultConnection->getAnswerObject();
print_r($dataObj);*/

echo "\n\nDATA -----------------------------------\n\n";

$error = $resultConnection->getError();
var_dump($error);
$errorCounter = $error->getErrorCounter();
print_r($errorCounter);

if ($errorCounter > 0) {
    print_r($error->getErrorAll());
}

echo '|'.$dataUrlRequest.'|';
//print_r($dataRaw);
//print_r($dataArrayRaw);

