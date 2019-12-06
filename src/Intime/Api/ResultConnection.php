<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api;

use Vgip\Intime\Api\ConfigInterface;

class ResultConnection implements ResultConnectionInterface
{
    private $action;
    
    private $config;
    
    private $answer;
    
    private $error;
    
    private $requestData;
    
    private $requestUrl;
    
    private $connectionData;


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
    
    public function setAnswer(string $answer)
    {
        $this->answer = $answer;
    }
    
    public function getAnswer() : ?string
    {
        return $this->answer;
    }
    
    /** Deprecated - delete in release */
    public function getResultArrayFromJson()
    {
        $resRaw = json_decode($this->answer, true);
        
        $entriesGet = 'Entries_get_'.$this->action;
        $entryGet = 'Entry_get_'.$this->action;
        $res = $resRaw[$entriesGet][$entryGet];
        
        return $res;
    }

    public function setError($error)
    {
        $this->error = $error;
    }
    
    public function getError()
    {
        return $this->error;
    }

    public function setRequestUrl(string $requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }
    
    public function getRequestUrl() : ?string
    {
        return $this->requestUrl;
    }
    
    public function setRequestData(array $requestData)
    {
        $this->requestData  = $requestData;
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
