<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api;

use Vgip\Intime\Api\ConfigInterface;
use Vgip\Intime\Api\ConfigPropertyTrait;

class ConfigDefault implements ConfigInterface
{
    use ConfigPropertyTrait;
    
    public function setDefaultConfig()
    {
        $this->setKey(ConfigInterface::KEY_1);
        $this->setUrl(ConfigInterface::URL_REST_1);
        $this->setConnectionType(ConfigInterface::CONNECTION_TYPE_REST);
        
        $connectionClass = $this->getConnectionDefault();
        $this->setConnection($connectionClass);
        
        $this->setConnectionTimeout(30);
        
        $this->setConnectionSslVerifyPeer(false);
        $this->setConnectionSslVerifyPeerName(false);
        
        $this->setRestRequestType(ConfigInterface::REST_REQUEST_TYPE_POST);
        $this->setRestContentType(ConfigInterface::REST_CONTENT_TYPE_JSON);
        $this->setResultValidation(true);
        
        $resultConnectionClassName = ConfigInterface::RESULT_CONNECTION_CLASS;
        $resultConnection          = new $resultConnectionClassName();
        $this->setResultConnection($resultConnection);
        
        $this->setResultDataSkipIfError(false);
    }

    private function getConnectionDefault()
    {
        $connectionType = $this->getConnectionType();
        $constantName = $connectionType.'_CONNECTION_CLASS';
        
        $connectionClass = constant(ConfigInterface::class.'::'.$constantName);
        
        return $connectionClass;
    }
}
