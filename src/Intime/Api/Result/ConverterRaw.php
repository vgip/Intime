<?php

/**
 * Converter raw result format
 */

declare(strict_types = 1);

namespace Vgip\Intime\Api\Result;

use Vgip\Intime\Dir\ActionAccordance;

class ConverterRaw
{
    public static function convertXmlToArray()
    {
        exit('Raw converter under conctruction');
    }
    
    public static function convertJsonToArray(string $rawResultData, string $action) : ?array
    {
        $resRaw = json_decode($rawResultData, true);
        
        $actionAccordance = ActionAccordance::getInstance();
        $actionArrayKey = $actionAccordance->getAnswerArrayKey($action);
        $actionArrayKeyPrefixes = $actionAccordance->getPrefixes($action);
        
        $entriesGet = $actionArrayKeyPrefixes[1].$actionArrayKey;
        $entryGet = $actionArrayKeyPrefixes[2].$actionArrayKey;
        $res = $resRaw[$entriesGet][$entryGet];
        
        return $res;
    }
}
