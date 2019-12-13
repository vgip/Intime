<?php

declare(strict_types=1);

namespace Vgip\Intime\Type\Converter;

use DateTime;
use Vgip\Intime\Type\Converter\ConverterInterface\ConverterInterface;
use Vgip\Intime\Type\Converter\ConverterInterface\ConverterTrait;
use Vgip\Intime\Type\TypeInterface\TypeInterface;
use Vgip\Intime\Type\DetectorType;

class AnyToInternal implements ConverterInterface
{
    use ConverterTrait;
    
    
    private $type;
    
    private $trim = true;
    
    private $stringEmtyToNull = true;
    
    private $zeroToNull = false;
    
    
    public function __construct(TypeInterface $type, $trim = true, $stringEmtyToNull = true) 
    {
        $this->type             = $type;
        $this->trim             = $trim;
        $this->stringEmtyToNull = $stringEmtyToNull;
    }
    
    public function setZeroToNull(bool $zeroToNull)
    {
        $this->zeroToNull = $zeroToNull;
    }
    
    public function convert($valueRaw)
    {
        if (is_array($valueRaw) AND 1 === count($valueRaw) AND isset($valueRaw['@nil']) AND 'true' === $valueRaw['@nil']) {
            $valueRaw = '';
        }
        if (true === $this->trim) {
            $valueRaw = trim((string)$valueRaw);
        }
        if (true === $this->zeroToNull AND '0' === (string)$valueRaw) {
            $valueRaw = null;
        }
        
        $typeName = DetectorType::getTypeNameByTypeObject($this->type);
        
        $conversionMethodName   = 'convertTo'.$typeName;
        $valueConverted         = $this->$conversionMethodName($valueRaw);
        
        return $valueConverted;
    }
    
    public function convertToInt($valueRaw) : ?int
    {
        if ("" === $valueRaw OR null === $valueRaw) {
            $valueConverted = null;
        } else {
            $valueConverted = (int)$valueRaw;
        }
        
        
        return $valueConverted;
    }
    
    public function convertToFloat($valueRaw) : ?float
    {
        if ("" === $valueRaw) {
            $valueConverted = null;
        } else {
            $valueConverted = (float)$valueRaw;
        }
        
        return $valueConverted;
    }
    
    public function convertToString($valueRaw) : ?string
    {
        if ("" === $valueRaw AND true === $this->stringEmtyToNull) {
            $valueConverted = null;
        } else {
            $valueConverted = (string)$valueRaw;
        }
        
        return $valueConverted;
    }
    
    public function convertToBool($valueRaw) : ?bool
    {
        $valueConverted = (bool)$valueRaw;
        
        return $valueConverted;
    }
    
    public function convertToDateTime($valueRaw)
    {
        $valueConverted = $this->convertToString($valueRaw);
        
        $format = $this->type->getDateTimeFormat();
        
        $date = new DateTime($valueRaw); 
        $valueConverted = $date->format($format);
        
        return $valueConverted;
    }
}
