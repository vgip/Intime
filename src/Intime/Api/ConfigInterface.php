<?php

declare(strict_types=1);

namespace Vgip\Intime\Api;

use Vgip\Intime\Api\Result\ResultConnectionInterface;

interface ConfigInterface
{
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
