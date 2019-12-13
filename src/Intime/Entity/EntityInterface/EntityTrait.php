<?php

declare(strict_types=1);

namespace Vgip\Intime\Entity\EntityInterface;

use Vgip\Intime\Entity\Helper\TypeHook;
use Vgip\Intime\Entity\Helper\AccordanceSourceInternal;
use Vgip\Intime\Entity\Helper\ConverterHook;
use Vgip\Intime\Entity\Helper\StorageHook;
use Vgip\Intime\Entity\Helper\StorageInterface\StorageInterface;

trait EntityTrait
{
    private $typeHook;
    
    private $accordanceSourceInternal;
    
    private $converterToInternalHook;
    
    private $storageHook;

    
    public function __construct() 
    {
        $this->typeHook = new TypeHook();
        $this->setTypeDefault();
        
        $this->accordanceSourceInternal = new AccordanceSourceInternal();
        $this->setAccordanceSourceInternalDefault();
        
        $this->converterToInternalHook = new ConverterHook();
        $this->setConverterToInternalDefault($this->getType());
        
        $this->storageHook = new StorageHook();
        $this->setStorageDefault($this->getType());
    }
    
    public function getType() : TypeHook
    {
        return $this->typeHook;
    }

    public function getAccordanceSourceInternal() : AccordanceSourceInternal
    {
        return $this->accordanceSourceInternal;
    }
    
    public function getConverterToInternal()
    {
        return $this->converterToInternalHook;
    }
    
    public function getStorage() : StorageInterface
    {
        return clone $this->storageHook;
    }

}
