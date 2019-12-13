<?php
/**
 * API Connection Result: storage to data from source (API), errors 
 * and other service data (request parameter and etc). 
 * 
 * Initialized automatically from Vgip\Intime\Api\Api. 
 * Returned by methods $api->getCountry(), $api->createDeclaration(), etc.
 */
declare(strict_types=1);

namespace Vgip\Intime\Api\Result;

use Vgip\Intime\Api\ConfigInterface;
use Vgip\Intime\Api\Result\ConverterRaw;
use Vgip\Intime\Api\Result\ResultProcessing;
use Vgip\Intime\Error\Error;

class ResultConnection implements ResultConnectionInterface
{
    private $action;
    
    private $config;
    
    private $answerRaw;
    
    private $error;
    
    private $requestBody;
    
    private $requestData;
    
    private $requestUrl;
    
    private $connectionData;

    private $resultProcessing;
    
    public function __construct() 
    {
        $this->resultProcessing = new ResultProcessing();
        
        $this->error = new Error();
    }

    /**
     * @internal set raw response from API
     * 
     * @param string $answerRaw
     * @return void
     */
    public function setAnswerRaw(string $answerRaw): void
    {
        $this->answerRaw = $answerRaw;
    }
    
    /**
     * Get raw answer from API as string. If the answer is empty, null will be returned.
     * 
     * @return string|null
     */
    public function getAnswerRaw(): ?string
    {
        return $this->answerRaw;
    }
    
    /**
     * Get the response with the raw data as an array.
     * 
     * @return array|null
     */
    public function getAnswerArrayRaw(): ?array
    {
        $resultConvertionMethodName = $this->getConvertionMethodName();
        
        if (null === $this->answerRaw) {
            $dataSource = null;
        } else {
            $dataSource = ConverterRaw::$resultConvertionMethodName($this->answerRaw, $this->action);
        }
        
        return $dataSource;
    }
    
    /**
     * Get answer as array with converted to internal format keys and values.
     * 
     * @return array|null
     */
    public function getAnswerArray(): ?array
    {
        $data = $this->getAnswerConvertedByType('array');
        
        return $data;
    }
    
    /**
     * Get an array of objects using get*() methods to access object properties.
     * 
     * @return array|null
     */
    public function getAnswerObject(): ?array
    {
        $data = $this->getAnswerConvertedByType('object');
        
        return $data;
    }
    
    /**
     * If errors occurred while connecting to the API, they will be written 
     * to Vgip\Intime\Error\Error object. 
     * 
     * If the correctness of the incoming data was validated, 
     * in case of errors found, information about them will 
     * also be recorded in this object.
     * 
     * @return Error
     */
    public function getError(): Error
    {
        return $this->error;
    }
    
    /**
     * @internal
     * 
     * @param string $action
     * @return void
     */
    public function setAction(string $action): void
    {
        $this->action       = $action;
    }
    
    /**
     * Get action name.
     * 
     * E.g. "district", "content_description", "declaration_create", etc, 
     * depending on the running method from Vgip\Intime\Api\Api 
     * (getDistrict(), getContentDescription(), createDeclaration() respectively). 
     * A complete list of titles is available here: Vgip\Intime\Dir\ActionAccordance.
     * 
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @internal
     * 
     * @param string $requestUrl
     * @return void
     */
    public function setRequestUrl(string $requestUrl): void
    {
        $this->requestUrl = $requestUrl;
    }
    
    /**
     * Get URL address of connection to API
     * 
     * @return string|null
     */
    public function getRequestUrl(): ?string
    {
        return $this->requestUrl;
    }
    
    /**
     * @internal
     * 
     * @param type $requestBody
     * @return void
     */
    public function setRequestBody($requestBody): void 
    {
        $this->requestBody = $requestBody;
    }
    
    /**
     * Get the request body if exists (for GET requests, the body is absent) or null. 
     * 
     * Data may contain key for API.
     * 
     * @return string|null
     */
    public function getRequestBody(): ?string
    {
        return $this->requestBody;
    }

    /**
     * @internal
     * 
     * @param array $requestData
     * @return void
     */
    public function setRequestData(?array $requestData): void
    {
        $this->requestData  = $requestData;
    }

    /**
     * Get data for request building or null, if data not exists 
     * (request created without parameters e.g. $api->getCountry()).
     * 
     * @return array|null
     */
    public function getRequestData(): ?array
    {
        return $this->requestData;
    }

    /**
     * @internal
     * 
     * @param array $connectionData
     * @return void
     */
    public function setConnectionData(array $connectionData): void
    {
        $this->connectionData = $connectionData;
    }
    
    /**
     * Get all connection data as array. 
     * 
     * Data may contain key for API.
     * 
     * @return array
     */
    public function getConnectionData(): array
    {
        return $this->connectionData;
    }
    
    /**
     * @internal
     * 
     * @param ConfigInterface $config
     * @return void
     */
    public function setConfig(ConfigInterface $config): void
    {
        $this->config = $config;
    }

    /**
     * @internal
     * 
     * @return ConfigInterface
     */
    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }
    
    private function getAnswerConvertedByType(string $type)
    {
        if ('object' === $type) {
            $flag = 'object';
        } else {
            $flag = 'array';
        }
        
        $dataSource = $this->getAnswerArrayRaw();
        
        $this->resultProcessing->setValidation($this->config->getResultValidation(), $this->config->getResultDataSkipIfError());
        $this->resultProcessing->setStorageType($flag);
        $this->resultProcessing->setAction($this->action);
        
        $data = $this->resultProcessing->getData($dataSource);
        
        $this->error->setErrorMessageAll($this->resultProcessing->getError());
        
        return $data;
    }
    
    private function getConvertionMethodName()
    {
        $answerFormat = 'Xml';
        
        $connectionType = $this->config->getConnectionType();
        if ($this->config->getConnectionType($connectionType) === 'REST') {
            $restContentType = $this->config->getRestContentType();
            if ('application/json' === $restContentType) {
                $answerFormat = 'Json';
            }
        } else {
            $answerFormat = 'Xml';
        }
        
        $convertionMethodName = 'convert'.$answerFormat.'ToArray';
        
        return $convertionMethodName;
    }
}
