<?php

/**
 * Type string options
 * 
 * Property $hasNull not required.
 * If $min (Length min) = 0, then the value is automatically considered null.
 */

declare(strict_types=1);

namespace Vgip\Intime\Type;

use Vgip\Intime\Type\TypeInterface\TypeInterface;
use Vgip\Intime\Type\TypeInterface\TypeTrait;
use Vgip\Intime\Type\Validator\ByType;

class TypeString implements TypeInterface
{
    use TypeTrait;
    
    /**
     * Length min
     * 
     * @var int 
     */
    private $min;
    
    /**
     * Length max
     * 
     * @var int 
     */
    private $max;
    
    /**
     * Could it be null
     * 
     * @var bool
     */
    private $hasNull;
    
    /**
     * Regex pattern
     * 
     * @var type 
     */
    private $pattern;
    

    /**
     * 
     * @param int $min - >= 0 or null
     * @param int $max - >= 0 or null
     * @param string $pattern - valid pattern for php function preg_match
     */
    public function __construct(int $min = null, int $max = null, string $pattern)
    {
        $this->validator = new ByType();
        
        $this->min      = $min;
        
        $this->max      = $max;
        
        $this->pattern  = $pattern;
    }
    
    public function getMin() : ?int
    {
        return $this->min;
    }

    public function getMax() : ?int
    {
        return $this->max;
    }

    public function getPattern() : ?string
    {
        return $this->pattern;
    }
}
