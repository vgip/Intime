<?php

declare(strict_types=1);

namespace Vgip\Intime\Api;

use Vgip\Intime\Api\ConfigInterface;
use Vgip\Intime\Api\ConfigPropertyTrait;

class ConfigDefault implements ConfigInterface
{
    use ConfigPropertyTrait;
    
    /**
     * API key default
     * 
     * If you do not have a key, you can use this key: 10000000000001234567 
     * to work with some methods: getCounty(), getLocality() and etc.
     */
    const KEY_1                     = '10000000000001234567';
    
    const URL_SOAP_1                = 'http://esb.intime.ua:8080/services/intime_api_3.0?wsdl';
    
    const URL_REST_1                = 'https://ex.intime.ua:8443/intime_api_3.0';
    
    const URL_REST_2                = 'https://esb.intime.ua:8243/intime_api_3.0';

    const CONNECTION_TYPE_REST      = 'REST';
    
    const CONNECTION_TYPE_SOAP      = 'SOAP';
    
    const REST_CONNECTION_CLASS     = 'Vgip\\Intime\\Api\\Connection\\Rest\\FileGetContents';
    
    const SOAP_CONNECTION_CLASS     = null;
    
    const REST_REQUEST_TYPE_GET     = 'GET';
    
    const REST_REQUEST_TYPE_POST    = 'POST';
    
    const REST_CONTENT_TYPE_JSON    = 'application/json';
    
    const REST_CONTENT_TYPE_XML     = 'application/xml';
    
    const REST_CONTENT_TYPE_TEXT    = 'text/xml';
    
    const RESULT_FORMAT_ARRAY_RAW   = 'array_raw';
    
    const RESULT_FORMAT_ARRAY       = 'array';
    
    const RESULT_FORMAT_OBJECT      = 'object';
    
    const RESULT_CONNECTION_CLASS   = 'Vgip\\Intime\\Api\\Result\\ResultConnection';
    
    public function setDefaultConfig()
    {
        $this->setKey(self::KEY_1);
        $this->setUrl(self::URL_REST_1);
        $this->setConnectionType(self::CONNECTION_TYPE_REST);
        
        $connectionClass = $this->getConnectionDefault();
        $this->setConnection($connectionClass);
        
        $this->setConnectionTimeout(30);
        
        $this->setConnectionSslVerifyPeer(false);
        $this->setConnectionSslVerifyPeerName(false);
        
        $this->setRestRequestType(self::REST_REQUEST_TYPE_POST);
        $this->setRestContentType(self::REST_CONTENT_TYPE_JSON);
        $this->setResultValidation(true);
        
        $resultConnectionClassName = self::RESULT_CONNECTION_CLASS;
        $resultConnection          = new $resultConnectionClassName();
        $this->setResultConnection($resultConnection);
        
        $this->setResultDataSkipIfError(false);
    }

    private function getConnectionDefault()
    {
        $connectionType = $this->getConnectionType();
        $constantName = $connectionType.'_CONNECTION_CLASS';
        
        $connectionClass = constant(self::class.'::'.$constantName);
        
        return $connectionClass;
    }
}
