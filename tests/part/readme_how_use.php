<?php

use Vgip\Intime\Api\Config AS IntimeApiConfig;
use Vgip\Intime\Api\ConfigDefault AS IntimeApiConfigDefault;
use Vgip\Intime\Api\Api AS IntimeApi;

$apiKey = '10000000000001234567';

$intimeApiConfigDefault = new IntimeApiConfigDefault();
$intimeApiConfigDefault->setDefaultConfig();

$intimeApiConfig        = new IntimeApiConfig($intimeApiConfigDefault);
$intimeApiConfig->setKey($apiKey);

$intimeApi              = new IntimeApi($intimeApiConfig);
$intimeApi->getDistrictByRegionId(2);
$resultConnection       = $intimeApi->getResultConnection();
print_r($resultConnection);
