<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api\Connection\Rest;

use Vgip\Intime\Api\Connection\ConnectionInterface;
use Vgip\Intime\Api\ConfigInterface;

class FileGetContents implements ConnectionInterface, RestInterface
{
    /** Not use - only for compatibility in feature and compatibility with SOAP methof call */
    private $action;
    
    /** Not use - only for compatibility in feature and compatibility with SOAP methof call */
    private $data;
    
    private $config;
    
    public function __construct(string $action, array $data, ConfigInterface $config)
    {
        $this->config   = $config;
        
        $this->action   = $action;
        $this->data     = $data;
    }
    
    public function connect(string $url, string $body): ?string
    {
        $contextOption = $this->getContextOption($body);
        
        $this->config->getResultConnection()->setRequestUrl($url);
        
        $answer = @file_get_contents($url, false, stream_context_create($contextOption));
        if (false === $answer) {
            $error = error_get_last();
            //$this->config->getResultConnection()->setError($error);
            $this->config->getResultConnection()->getError()->setErrorMessage('rest_connection_file_get_contents', 'rest connection file get contents (PHP function file_getcontents()) returned error with type '.$error['type'].' and message: "'.$error['message'].'"');
            $answerRes = null;
        } else {
            $this->config->getResultConnection()->setAnswerRaw($answer);
            $answerRes = $answer;
        }
         
        $connectionData = [];
        $connectionData['contextOption']    = $contextOption;
        $connectionData['body']             = $body;
        
        $this->config->getResultConnection()->setConnectionData($connectionData);
        
        return $answerRes;
    }

    private function getContextOption(string $body)
    {
    $contextOption = [
        'ssl' => [
            'verify_peer'       => $this->config->getConnectionSslVerifyPeer(),
            'verify_peer_name'  => $this->config->getConnectionSslVerifyPeerName(),
        ],
        'http' => [
            'method'  => $this->config->getRestRequestType(),
            'header'  => 'Content-Type: '.$this->config->getRestContentType()."\r\n",
            'content' => $body,
            'timeout' => $this->config->getConnectionTimeout(),
        ],
    ];
    
    return $contextOption;
    }
}
