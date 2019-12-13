<?php

declare(strict_types=1);

namespace Vgip\Intime\Type\Validator;

use DateTime;
use Vgip\Intime\Type\Validator\ValidatorInterface\ValidatorInterface;
use Vgip\Intime\Type\Validator\ValidatorInterface\ValidatorTrait;
use Vgip\Intime\Type\TypeInterface\TypeInterface;
use Vgip\Intime\Type\DetectorType;
use Vgip\Intime\Error\Error;

class ByType implements ValidatorInterface
{
    use ValidatorTrait;
    
    private $type;
    
    private $error;
    
    public function isValid($value, TypeInterface $type)
    {
        $this->type = $type;
        $this->error = new Error();
        
        $typeName = DetectorType::getTypeNameByTypeObject($type);
        
        $validatorMethodName   = 'isValid'.$typeName;
        $valueConverted        = $this->$validatorMethodName($value, $type);

        return $valueConverted;
    }

    public function isValidBool(?bool $value)
    {
        $res = true;
        
        if (null === $value AND false === $this->type->getHasNull()) {
            $this->error->setErrorMessage('validation_by_type_bool_has_null', 'value contains an invalid value null');
            $res = false;
        } 
        
        return $res;
    }
    
    public function isValidDateTime(?string $value)
    {
        $res = true;
        
        if (null !== $value) {
            $valueDateTime = new DateTime($value);
            $dateTimeFormat = $this->type->getDateTimeFormat();
        }
        
        $dateTimeMin = new DateTime($this->type->getMin());
        $dateTimeMax = new DateTime($this->type->getMax());
        if (null !== $this->type->getMin() AND $valueDateTime < $dateTimeMin) {
            $this->error->setErrorMessage('validation_by_type_date_time_less_min', 'value "'.$value.'" is less than minimum "'.$dateTimeMin->format($dateTimeFormat).'"');
            $res = false;
        } else if (null !== $this->type->getMax() AND $valueDateTime > $dateTimeMax) {
            $this->error->setErrorMessage('validation_by_type_date_time_greater_max', 'value "'.$value.'" is greater than maximum "'.$dateTimeMax->format($dateTimeFormat).'"');
            $res = false;
        } else if (null === $value AND false === $this->type->getHasNull()) {
            $this->error->setErrorMessage('validation_by_type_date_time_has_null', 'value contains an invalid value null');
            $res = false;
        }
        
        return $res;
    }
    
    public function isValidString(?string $value)
    {
        $res = true;
        
        if (null !==  $value) {
            $valueLength = mb_strlen($value);
        } else {
            $valueLength = 0;
        }
        
        if ((null === $value OR '' === $value) AND 0 === $this->type->getMin()) {
            $res = true;
        } elseif (null !== $this->type->getMin() AND $valueLength < $this->type->getMin()) {
            $this->error->setErrorMessage('validation_by_type_string_less_min', 'the value contains "'.$valueLength.'" characters, which is less than the minimum number of "'.$this->type->getMin().'" characters');
            $res = false;
        } else if (null !== $this->type->getMax() AND $valueLength > $this->type->getMax()) {
            $this->error->setErrorMessage('validation_by_type_string_less_max', 'the value contains "'.$valueLength.'" characters, which is greater than the maximum number of "'.$this->type->getMax().'" characters');
            $res = false;
        } else if (null !== $this->type->getMin() AND 0 !== $this->type->getMin() AND 0 === $valueLength) {
            $this->error->setErrorMessage('validation_by_type_string_has_null', 'value contains an invalid value null, the value contains "0" characters, which is less than the minimum number of "'.$this->type->getMin().'" characters');
            $res = false;
        } else if (null !== $this->type->getPattern() AND !preg_match($this->type->getPattern(), (string)$value)) {
            $this->error->setErrorMessage('validation_by_type_string_incorrect', 'value "'.$value.'" contains invalid characters and does not pass pattern "'.$this->type->getPattern().'"');
            $res = false;
        }
        
        return $res;
    }
    
    public function isValidInt(?int $value)
    {
        $res = true;
        
        if (true === $this->type->getHasNull() AND null === $value) {
            $res = true;
        } elseif (null !== $this->type->getMin() AND $value < $this->type->getMin()) {
            $this->error->setErrorMessage('validation_by_type_int_less_min', 'value "'.$value.'" is less than minimum "'.$this->type->getMin().'"');
            $res = false;
        } else if (null !== $this->type->getMax() AND $value > $this->type->getMax()) {
            $this->error->setErrorMessage('validation_by_type_int_greater_max', 'value "'.$value.'" is greater than maximum "'.$this->type->getMax().'"');
            $res = false;
        } else if (null === $value AND false === $this->type->getHasNull()) {
            $this->error->setErrorMessage('validation_by_type_int_has_null', 'value contains an invalid value null');
            $res = false;
        }
        
        return $res;
    }
    
    public function getError()
    {
        return $this->error;
    }
}
