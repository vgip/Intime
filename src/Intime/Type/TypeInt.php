<?php

declare(strict_types=1);

namespace Vgip\Intime\Type;

use Vgip\Intime\Type\TypeInterface\TypeInterface;
use Vgip\Intime\Type\TypeInterface\TypeTrait;
use Vgip\Intime\Type\Validator\ByType;

class TypeInt implements TypeInterface
{
    use TypeTrait;
    
    
    private $min;
    
    private $max;
    
    private $hasNull;
    
    
    public function __construct(int $min = null, int $max = null, bool $hasNull = null)
    {
        $this->validator = new ByType();
        
        $this->min      = $min;
        
        $this->max      = $max;
        
        $this->hasNull  = $hasNull;
    }
    
    public function getMin() : ?int
    {
        return $this->min;
    }

    public function getMax() : ?int
    {
        return $this->max;
    }

    public function getHasNull() : ?bool
    {
        return $this->hasNull;
    }
}
