<?php

declare(strict_types = 1);

namespace Vgip\Intime\Type;

use Vgip\Intime\Type\TypeInterface\TypeInterface;

class DetectorType
{
    /**
     * Get type name by object with TypeInterface
     * 
     * Result example: Int, DateTime, etc.
     * 
     * @param TypeInterface $type
     * @return string
     */
    public static function getTypeNameByTypeObject(TypeInterface $type) : string
    {
        $className              = get_class($type);
        $classNameShortArr      = explode('\\', $className);
        $classNameShort         = array_pop($classNameShortArr);
        $typeName               = mb_substr($classNameShort, 4);
        
        return $typeName;
    }
}
