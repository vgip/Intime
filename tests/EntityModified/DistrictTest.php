<?php

declare(strict_types=1);

//namespace Vgip\Intime\Entity;

use Vgip\Intime\Entity\EntityInterface\EntityTrait;
use Vgip\Intime\Entity\EntityInterface\EntityInterface;
use Vgip\Intime\Type\TypeInt;
//use Vgip\Intime\Type\TypeString;
//use Vgip\Intime\Type\TypeBool;
//use Vgip\Intime\Type\TypeDateTime;
//use Vgip\Intime\Dir\Pattern;
use Vgip\Intime\Type\Converter\AnyToInternal;
use Vgip\Intime\Converter\StringConverter;
use Vgip\Intime\Dir\PropertyTypeCommon;
use Vgip\Intime\Entity\District;

class DistrictTest extends District
{
    use EntityTrait;

    
    protected function setTypeDefault()
    {
        $propertyTypeCommon = PropertyTypeCommon::getInstance();

        $type = [
            'id'                    => new TypeInt(1, 20),
            'region_id'             => $propertyTypeCommon->getRegionId(),
            'name_ua'               => $propertyTypeCommon->getNameUa(),
            'name_en'               => $propertyTypeCommon->getNameEn(),
            'name_ru'               => $propertyTypeCommon->getNameRu(),
            'name_short_ua'         => $propertyTypeCommon->getNameShortUa(),
            'name_short_en'         => $propertyTypeCommon->getNameShortEn(),
            'name_short_ru'         => $propertyTypeCommon->getNameShortRu(),
            'code'                  => $propertyTypeCommon->getCode(),
            'update_date'           => $propertyTypeCommon->getUpdateDate(),
            'status'                => $propertyTypeCommon->getStatus(),
        ];
        
        $this->typeHook->_setAll($type);
    }
    
    protected function setAccordanceSourceInternalDefault()
    {
        /**
         * District property accordance
         *
         * $accordanceSourceInternal array Source name => internal name
         */
        
        $accordanceSourceInternal = [
            'id'                        => 'id',
            'area_id'                   => 'region_id',          
            'district_name_ua'          => 'name_ua',          
            'district_name_en'          => 'name_en',          
            'district_name_ru'          => 'name_ru',          
            'district_short_name_ua'    => 'name_short_ua',
            'district_short_name_en'    => 'name_short_en',
            'district_short_name_ru'    => 'name_short_ru',
            'district_code'             => 'code',
            'last_change'               => 'update_date',
            'status'                    => 'status',
        ];
        
        $this->accordanceSourceInternal->setAll($accordanceSourceInternal);
    }
    
    protected function setConverterToInternalDefault($type)
    {
        foreach ($this->property AS $propertyName) {
            $propertyNameCamelCase = StringConverter::convertLowerSnakeCaseToUpperCamelCase($propertyName);
            $methodName = 'get'.$propertyNameCamelCase;
            $converter[$propertyName] = new AnyToInternal($type->$methodName(), true);
        }
        
        $this->converterToInternalHook->_setAll($converter); 
    }

    protected function setStorageDefault($type)
    {
        foreach ($this->property AS $propertyName) {
            $storage[$propertyName] = null;
        }
        
        $this->storageHook->_setAll($storage); 
    }
}
