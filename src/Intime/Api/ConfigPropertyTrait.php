<?php

/**
 * Config property trait
 * 
 * See available values to some methods in constants Vgip\Intime\Api\ConfigInterface class
 */

declare(strict_types=1);

namespace Vgip\Intime\Api;

use Vgip\Intime\Api\Result\ResultConnectionInterface;
use Vgip\Intime\Api\ConfigDefault;
use Vgip\Intime\Exception;

Trait ConfigPropertyTrait
{
    /** 
     * Intime API key
     * 
     * You must get this private key on the site https://my.intime.ua/
     * After registering your account 
     * or use default key, but it will not allow you to create, view and 
     * some more actions will be unavailable.
     * 
     * @var string 
     */
    private $key;

    /**
     * Main API URL
     * 
     * @var string 
     */
    private $url;
    
    /**
     * Connection type: REST or SOAP
     * 
     * @var string 
     */
    private $connectionType;
    
    /**
     * Class for connection to Inime API
     * 
     * @var Vgip\Intime\Api\Connection\ConnectionInterface object 
     */
    private $connection;
    
    /**
     * Timeout to connect to a remote Intime API server 
     * 
     * @var int (in seconds) 
     */
    private $connectionTimeout;
    
    /**
     * Require (true) or not (false) verification of SSL certificate used if SSL (https) connection used
     * 
     * @var bool 
     */
    private $connectionSslVerifyPeer;
    
    /**
     * Require (true) or not (false) verification of peer name if SSL (https) connection used
     * 
     * @var bool 
     */
    private $connectionSslVerifyPeerName;
    
    /**
     * REST request type: GET or POST
     * 
     * Get request does not work with many api methods
     * 
     * @var string 
     */
    private $restRequestType;
    
    /**
     * REST content type header
     * 
     * The header affects the type of response received (XML or JSON).
     * 
     * @var string
     */
    private $restContentType;
    
    /**
     * Validate data (true) or not (false) from API result
     * 
     * Only applicable if running Vgip\Intime\Api\Api methods 
     * getAnswerArray() or getAnswer()
     * 
     * @var bool 
     */
    private $resultValidation;
    
    /**
     * Object with connection results
     * 
     * @var Vgip\Intime\Api\ResultConnectionInterface Object 
     */
    private $resultConnection;
    
    /**
     * Hide API response row results if at least one error is found in it
     * 
     * Only applicable if running Vgip\Intime\Api\Api methods 
     * getAnswerArray() or getAnswer()
     * 
     * @var bool  
     */
    private $resultDataSkipIfError;
    
    public function setKey(string $key): ?bool
    {
        $res = null;
        
        $this->key = $key;
        
        return $res;
    }
    
    public function getKey(): string
    {
        return $this->key;
    }

    public function setUrl(string $url): ?bool
    {
        $res = null;
        
        $this->url = $url;
        
        return $res;
    }
    
    public function getUrl(): string
    {
        return $this->url;
    }
    
    public function setConnectionType(string $connectionType): ?bool
    {
        $res = null;
        
        $this->connectionType = $connectionType;
       
        return $res;
    }
    
    public function getConnectionType(): string
    {
        return $this->connectionType;
    }
    
    public function setConnection(string $connection): ?bool
    {
        $res = null;
        
        $this->connection = $connection;
       
        return $res;
    }
    
    public function getConnection(): string
    {
        return $this->connection;
    }
    
    public function setConnectionTimeout(int $connectionTimeout): ?bool
    {
        $res = null;
        
        $this->connectionTimeout = $connectionTimeout;
       
        return $res;
    }
    
    public function getConnectionTimeout(): int
    {
        return $this->connectionTimeout;
    }

    public function setConnectionSslVerifyPeer(bool $connectionSslVerifyPeer): ?bool
    {
        $res = null;
        
        $this->connectionSslVerifyPeer = $connectionSslVerifyPeer;
        
        return $res;
    }
    
    public function getConnectionSslVerifyPeer(): bool
    {
        return $this->connectionSslVerifyPeer;
    }

    public function setConnectionSslVerifyPeerName(bool $connectionSslVerifyPeerName): ?bool
    {
        $res = null;
        
        $this->connectionSslVerifyPeerName = $connectionSslVerifyPeerName;
        
        return $res;
    }
    
    public function getConnectionSslVerifyPeerName(): bool
    {
        return $this->connectionSslVerifyPeerName;
    }
    
    public function setRestRequestType($restRequestType): ?bool
    {
        $res = null;
        
        $this->restRequestType = $restRequestType;
        
        return $res;
    }
    
    public function getRestRequestType(): string
    {
        return $this->restRequestType;
    }

    public function setRestContentType($restContentType): ?bool
    {
        $res = null;
        
        $availableType = [
            ConfigDefault::REST_CONTENT_TYPE_JSON,
            ConfigDefault::REST_CONTENT_TYPE_XML,
            ConfigDefault::REST_CONTENT_TYPE_TEXT,
        ];

        if (!in_array($restContentType, $availableType, true)) {
            throw new Exception('Rest content type "'.$restContentType.'" is not valid, available content types: '.join(', ', $availableType));
        } 

        $this->restContentType = $restContentType;

        return $res;
    }

    public function getRestContentType(): string
    {
        return $this->restContentType;
    }
    
    public function setResultValidation(bool $resultValidation): ?bool
    {
        $res = null;
        
        $this->resultValidation = $resultValidation;
        
        return $res;
    }

    public function getResultValidation(): bool
    {
        return $this->resultValidation;
    }

    public function setResultConnection(ResultConnectionInterface $resultConnection): ?bool
    {
        $res = null;
        
        $this->resultConnection = $resultConnection;
        
        return $res;
    }
    
    public function getResultConnection(): ResultConnectionInterface
    {
        return $this->resultConnection;
    }
    
    public function setResultDataSkipIfError(bool $resultDataSkipIfError) 
    {
        $this->resultDataSkipIfError = $resultDataSkipIfError;
    }
    
    public function getResultDataSkipIfError(): bool
    {
        return $this->resultDataSkipIfError;
    }
}
