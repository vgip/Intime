<?php

/**
 * Hook type property setter and getter
 * 
 * Example real methods:
 * 
 *     public function setId(TypeInterface $id = null) : void
 *     {
 *         $this->id = $id;
 *     }
 * 
 *     public function getId() : TypeInterface
 *     {
 *        return $this->id;
 *     }
 * 
 */

declare(strict_types = 1);

namespace Vgip\Intime\Entity\Helper;

use Vgip\Intime\Exception;
use Vgip\Intime\Converter\StringConverter;
use Vgip\Intime\Type\TypeInterface\TypeInterface;

class TypeHook
{
    private $data;
    
    public function _setAll($dataRaw)
    {
        foreach ($dataRaw AS $propertyLowerSnakeCase => $value) {
            $propertyLowerCamelCase = StringConverter::convertLowerSnakeCaseToLowerCamelCase($propertyLowerSnakeCase);
            $this->data[$propertyLowerCamelCase] = $value;
        }
        //print_r($this->data);
    }
    
    public function __call(string $name, array $arguments)
    {
        $patternSet = '~^set([A-Z][a-zA-Z0-9]{1,30})$~u';
        $patternGet = '~^get([A-Z][a-zA-Z0-9]{1,30})$~u';
        $match = [];
        
        if (preg_match($patternSet, $name, $match)) {
            $property = $this->runPropertyValidation($match[1]);
            
            $this->hookSetter($property, $arguments);
        } elseif (preg_match($patternGet, $name, $match)) {
            $property = $this->runPropertyValidation($match[1]);
            
            $res = $this->hookGetter($property, $arguments);
            
            return $res;
        } else {
            $this->hookException('undefined_method');
        }
    }
    
    /**
     * Setter method emulator
     * 
     * @param string $property
     * @param array $arguments
     */
    private function hookSetter(string $property, array $arguments)
    {
        $argumentCounter = count($arguments);
        if (1 !== $argumentCounter) {
            $message = 'Number of method arguments is '.$argumentCounter.', expected 1';
            $this->hookException($message);
        } else {
            $value = $arguments[0];
            if (!($value instanceof TypeInterface)) {
                $message = 'Property is not object or not instance of Vgip\Intime\Type\TypeInterface\TypeInterface ';
                $this->hookException($message);
            } else {
                $this->data[$property] = $value;
            }
        } 
    }
    
    /**
     * Getter method emulator
     * 
     * @param type $property
     * @param type $arguments
     * @return TypeInterface
     */
    private function hookGetter(string $property, array $arguments) : TypeInterface
    {
        $argumentCounter = count($arguments);
        if (0 < $argumentCounter) {
            $message = 'Number of method arguments is '.$argumentCounter.', expected 0';
            $this->hookException($message);
        } else {
            return $this->data[$property];
        } 
    }
    
    private function hookException($message)
    {
        $messageList = [
            'undefined_method' => 'Call to undefined method',
        ];
        
        $messagePrint = (isset($messageList[$message])) ? $messageList[$message] : $message;
        
        throw new Exception($messagePrint);
    }
    
    private function runPropertyValidation($propertyRaw)
    {
        $property = stringConverter::convertUpperCamelCaseToLowerCamelCase($propertyRaw);
        if (!array_key_exists($property, $this->data)) {
            $this->hookException('validation found undefined method by internal name '.$property);
        }
        
        return $property;
    }
}
