<?php

declare(strict_types = 1);

namespace Vgip\Intime\Type;

use Vgip\Intime\Type\TypeInterface\TypeInterface;
use Vgip\Intime\Type\TypeInterface\TypeTrait;
use Vgip\Intime\Type\Validator\ByType;

class TypeDateTime implements TypeInterface
{
    use TypeTrait;
    

    private $hasTime;
    
    private $hasMicrotime;
    
    private $hasTimezone;
    
    private $min;
    
    private $max;
    
    private $hasNull;
    
    
    public function __construct(?string $min, ?string $max, ?bool $hasNull)
    {
        $this->validator = new ByType();
        
        $this->min      = $min;
        $this->max      = $max;
        $this->hasNull  = $hasNull;
    }
    
    public function getMin() : ?string
    {
        return $this->min;
    }
    
    public function getMax() : ?string
    {
        return $this->max;
    }
    
    public function getHasNull() : ?bool
    {
        return $this->hasNull;
    }
    

    public function setDateTimeFormat(bool $hasTime = null, bool $hasMicrotime = null, bool $hasTimezone = null)
    {
        $this->hasTime      = $hasTime;
        
        if (true !== $this->hasTime) {
            $this->hasMicrotime = null;
        }
        $this->hasMicrotime      = $hasMicrotime;
        
        if (true !== $this->hasTime OR true !== $this->hasMicrotime) {
            $this->hasTimezone = null;
        }
        $this->hasTimezone  = $hasTimezone;
    }
    
    public function getDateTimeFormat()
    {
        $format = 'Y-m-d';
        
        if (true === $this->hasTime) {
            $format .= ' H:i:s';
        }
        if (true === $this->hasMicrotime) {
            $format .= '.u';
        }
        if (true === $this->hasTimezone) {
            $format .= ' e';
        }
        
        return $format;
    }

    public function getHasTime() : ?bool
    {
        return $this->hasTime;
    }

    public function getHasMicrotime() : ?bool
    {
        return $this->hasMicrotime;
    }

    public function getHasTimezone() : ?bool
    {
        return $this->hasTimezone;
    }
}
