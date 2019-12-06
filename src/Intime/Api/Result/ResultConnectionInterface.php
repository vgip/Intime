<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api\Result;

use Vgip\Intime\Api\ConfigInterface;

interface ResultConnectionInterface
{
    public function setAction(string $action);
    
    public function getAction() : ?string;
    
    public function setConfig(ConfigInterface $config);
    
    public function getConfig() : ConfigInterface;
    
    public function setAnswerRaw(string $answer);
    
    public function getAnswerRaw() : ?string;
    
    //public function setError($error);
    
    public function getError();
    
    public function setRequestUrl(string $requestUrl);
    
    public function getRequestUrl() : ?string;
    
    public function setRequestData(array $requestData);
    
    public function getRequestData() : array;
        
    public function setConnectionData($connectionData);
    
    public function getConnectionData();
}
