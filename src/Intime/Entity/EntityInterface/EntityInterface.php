<?php

/**
 * Create object form default data in array
 */

declare(strict_types = 1);

namespace Vgip\Intime\Entity\EntityInterface;

interface EntityInterface
{
    public function getType();
    
    public function getAccordanceSourceInternal();
    
    public function getConverterToInternal();
    
    public function getStorage();
}
