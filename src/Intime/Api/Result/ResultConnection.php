<?php

declare(strict_types = 1);

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

    public function setAction(string $action)
    {
        $this->action       = $action;
    }
    
    public function getAction() : string
    {
        return $this->action;
    }
    
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function getConfig() : ConfigInterface
    {
        return $this->config;
    }
    
    public function setAnswerRaw(string $answerRaw)
    {
        $this->answerRaw = $answerRaw;
    }
    
    public function getAnswerRaw() : ?string
    {
        return $this->answerRaw;
    }
    
    public function getAnswerArrayRaw() : ?array
    {
        $resultConvertionMethodName = $this->getConvertionMethodName();
        
        if (null === $this->answerRaw) {
            $dataSource = [];
        } else {
            $dataSource = ConverterRaw::$resultConvertionMethodName($this->answerRaw, $this->action);
        }
        
        return $dataSource;
    }
    
    public function getAnswerTypeByFlag(string $flagRaw)
    {
        if ('object' === $flagRaw) {
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
    
    public function getAnswerArray() : ?array
    {
        $data = $this->getAnswerTypeByFlag('array');
        
        return $data;
    }
    
    public function getAnswerObject() : ?array
    {
        $data = $this->getAnswerTypeByFlag('object');
        
        return $data;
    }

    public function getAnswer()
    {
        $res = $this->getAnswerObject();
        
        return $res;
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
    
    
    public function getError()
    {
        return $this->error;
    }

    public function setRequestUrl(string $requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }
    
    public function getRequestUrl(): ?string
    {
        return $this->requestUrl;
    }
    
    public function getRequestBody(): ?string
    {
        return $this->requestBody;
    }

    public function setRequestData(array $requestData)
    {
        $this->requestData  = $requestData;
    }
    
    public function setRequestBody($requestBody) 
    {
        $this->requestBody = $requestBody;
    }

    public function getRequestData() : array
    {
        return $this->requestData;
    }

    public function setConnectionData($connectionData)
    {
        $this->connectionData = $connectionData;
    }
    
    public function getConnectionData() 
    {
        return $this->connectionData;
    }
}
