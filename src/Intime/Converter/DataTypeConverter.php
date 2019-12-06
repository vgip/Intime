<?php
/**
 * Not used - under construction
 */
declare(strict_types = 1);

namespace Vgip\Intime\Converter;

use Vgip\Intime\Api\ConfigInterface;

class DataTypeConverter
{
    
    public function convert(string $contentType, string $resultFormat, string $data)
    {
        $sourceFormatRaw = $this->getReceiveDataTypeByContentType($contentType);
        if (null === $sourceFormatRaw) {
            // ERROR
        }
        
        $sourceFormatName = ucfirst($sourceFormatRaw);
        $resultFormatName = ucfirst($resultFormat);
        
        if ($sourceFormatName === $resultFormatName) {
            $res = $data;
        } else {
            $functionName = 'convert'.$sourceFormatName.'To'.$resultFormatName;
            echo $functionName;
            //$this->$functionName($data);
        }
        
        return $res;
    }

    public function getReceiveDataTypeByContentType(string $contentType) : ?string
    {
        $accordanceDataType = [
            ConfigInterface::REST_CONTENT_TYPE_JSON => 'json',
            ConfigInterface::REST_CONTENT_TYPE_XML  => 'xml',
            ConfigInterface::REST_CONTENT_TYPE_TEXT => 'xml',
        ];
        
        if (array_key_exists($contentType, $accordanceDataType)) {
            $res = $accordanceDataType[$contentType];
        } else {
            $res = null;
        }
        
        return $res;
    }
}
