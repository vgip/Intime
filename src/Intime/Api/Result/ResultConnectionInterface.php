<?php

declare(strict_types=1);

namespace Vgip\Intime\Api\Result;

use Vgip\Intime\Api\ConfigInterface;
use Vgip\Intime\Error\Error;

interface ResultConnectionInterface
{
    public function __construct();

    public function setAnswerRaw(string $answer): void;
    
    public function getAnswerRaw(): ?string;
    
    public function getAnswerArrayRaw(): ?array;
    
    public function getAnswerArray(): ?array;
    
    public function getAnswerObject(): ?array;
    
    public function getError(): Error;
    
    public function setAction(string $action): void;
    
    public function getAction(): ?string;
    
    public function setRequestUrl(string $requestUrl): void;
    
    public function getRequestUrl(): ?string;
    
    public function setRequestBody($requestBody): void;
    
    public function getRequestBody(): ?string;
    
    public function setRequestData(?array $requestData): void;
    
    public function getRequestData(): ?array;
        
    public function setConnectionData(array $connectionData): void;
    
    public function getConnectionData(): array;
    
    public function setConfig(ConfigInterface $config);
    
    public function getConfig(): ConfigInterface;
}
