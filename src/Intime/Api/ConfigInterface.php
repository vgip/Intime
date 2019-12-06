<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api;

use Vgip\Intime\Api\Result\ResultConnectionInterface;

interface ConfigInterface
{
 
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
    
    
    public function setKey(string $key) : ?bool;
    
    public function getKey() : string;
    
    public function setUrl(string $url) : ?bool;
    
    public function getUrl() : string;
    
    public function setConnectionType(string $name) : ?bool;
    
    public function getConnectionType() : string;
    
    public function setConnection(string $name) : ?bool;
    
    public function getConnection() : string;
    
    public function setConnectionTimeout(int $connectionTimeout) : ?bool;
    
    public function getConnectionTimeout() : int;
    
    public function setConnectionSslVerifyPeer(bool $value) : ?bool;

    public function getConnectionSslVerifyPeer() : bool;
    
    public function setConnectionSslVerifyPeerName(bool $value) : ?bool;

    public function getConnectionSslVerifyPeerName() : bool;
    
    public function setRestRequestType(string $name) : ?bool;
    
    public function getRestRequestType() : string;
    
    public function setRestContentType(string $name) : ?bool;
    
    public function getRestContentType() : string;
    
    public function setResultValidation(bool $name) : ?bool;

    public function getResultValidation() : bool;
    
    public function setResultConnection(ResultConnectionInterface $resultConnection) : ?bool;

    public function getResultConnection() : ResultConnectionInterface;
    
    public function setResultDataSkipIfError(bool $resultDataSkipIfError);
    
    public function getResultDataSkipIfError() : bool;
}
