<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api;

use Vgip\Intime\Api\ConfigInterface;
use Vgip\Intime\Api\ConfigPropertyTrait;
use Vgip\Intime\Api\ConfigDefault;

class Config implements ConfigInterface
{
    use ConfigPropertyTrait;
    
    public function __construct(ConfigInterface $configDefault = null) 
    {
        if (null !== $configDefault) {
            $this->setValueDefault($configDefault);
        }
        
    }
    
    private function setValueDefault($configDefault)
    {
        $property       = get_object_vars($this);
        foreach ($property AS $key => $v) {
            $sourceMethodNameGet = 'get'.ucfirst($key);
            $destinationMethodNameSet = 'set'.ucfirst($key);
            
            $this->$destinationMethodNameSet($configDefault->$sourceMethodNameGet());
        }
    }
}
