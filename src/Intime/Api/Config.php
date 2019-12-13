<?php

declare(strict_types=1);

namespace Vgip\Intime\Api;

use Vgip\Intime\Api\ConfigInterface;
use Vgip\Intime\Api\ConfigPropertyTrait;
use Vgip\Intime\Api\ConfigDefault;

class Config implements ConfigInterface
{
    use ConfigPropertyTrait;
    
    public function __construct(ConfigInterface $config = null)
    {
        if (null !== $config) {
            $this->setConfigFromObject($config);
        } else {
            $configDefault = new ConfigDefault();
            $configDefault->setDefaultConfig();
            $this->setConfigFromObject($configDefault);
        }
    }
    
    private function setConfigFromObject(ConfigInterface $config)
    {
        $property       = get_object_vars($this);
        foreach ($property AS $key => $null) {
            $sourceMethodNameGet = 'get'.ucfirst($key);
            $destinationMethodNameSet = 'set'.ucfirst($key);
            
            $this->$destinationMethodNameSet($config->$sourceMethodNameGet());
        }
    }
}
