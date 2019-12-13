<?php

declare(strict_types=1);

namespace Vgip\Intime\Type;

use Vgip\Intime\Type\TypeInterface\TypeInterface;
use Vgip\Intime\Type\TypeInterface\TypeTrait;
use Vgip\Intime\Type\Validator\ByType;

class TypeBool implements TypeInterface
{
    use TypeTrait;

    
    private $hasNull;
    

    public function __construct(bool $hasNull = null)
    {
        $this->validator = new ByType();
        
        $this->hasNull  = $hasNull;

    }

    public function getHasNull() : ?bool
    {
        return $this->hasNull;
    }
}
