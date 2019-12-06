<?php

declare(strict_types = 1);

namespace Vgip\Intime\Entity;

use Vgip\Intime\Entity\EntityInterface\EntityTrait;
use Vgip\Intime\Entity\EntityInterface\EntityInterface;
use Vgip\Intime\Type\Converter\AnyToInternal;
use Vgip\Intime\Converter\StringConverter;
use Vgip\Intime\Dir\PropertyTypeCommon;

class Region implements EntityInterface
{
    use EntityTrait;
    
    /** All entity property (value is all internal key name) */
    protected $property = [
        'id',
        'country_id',
        'name_ua',
        'name_en',
        'name_ru',
        'name_short_ua',
        'name_short_en',
        'name_short_ru',
        'code',
        'update_date',
        'status',
    ];
    
    /**
     * Set default types for each property
     */
    protected function setTypeDefault(): void
    {
        $propertyTypeCommon = PropertyTypeCommon::getInstance();

        /**
         * Internal key name => type object
         */
        $type = [
            'id'                         => $propertyTypeCommon->getRegionId(),
            'country_id'                 => $propertyTypeCommon->getCountryId(),
            'name_ua'                    => $propertyTypeCommon->getNameUa(),
            'name_en'                    => $propertyTypeCommon->getNameEn(),
            'name_ru'                    => $propertyTypeCommon->getNameRu(),
            'name_short_ua'              => $propertyTypeCommon->getNameShortUa(),
            'name_short_en'              => $propertyTypeCommon->getNameShortEn(),
            'name_short_ru'              => $propertyTypeCommon->getNameShortRu(),
            'code'                       => $propertyTypeCommon->getCode(),
            'update_date'                => $propertyTypeCommon->getUpdateDate(),
            'status'                     => $propertyTypeCommon->getStatus(),
        ];
        
        $this->typeHook->_setAll($type);
    }
    
    /**
     * Set accordance Intime key name to internal key name
     */
    protected function setAccordanceSourceInternalDefault(): void
    {
        /**
         * Source key => internal key
         */
        $accordanceSourceInternal = [
            'id'                        => 'id',
            'country_id'                => 'country_id',
            'area_name_ua'              => 'name_ua',          
            'area_name_en'              => 'name_en',          
            'area_name_ru'              => 'name_ru',          
            'short_area_name_ua'        => 'name_short_ua',
            'short_area_name_en'        => 'name_short_en',
            'short_area_name_ru'        => 'name_short_ru',
            'area_code'                 => 'code',
            'last_change'               => 'update_date',
            'status'                    => 'status',
        ];
        
        $this->accordanceSourceInternal->setAll($accordanceSourceInternal);
    }
    
    /**
     * Set converter to convert data from Intime API to internal format
     * 
     * Example date convertion from 2017-05-11T21:09:47.000+03:00 to 2017-05-11
     */
    protected function setConverterToInternalDefault(): void
    {
        foreach ($this->property AS $propertyName) {
            $propertyNameCamelCase = StringConverter::convertLowerSnakeCaseToUpperCamelCase($propertyName);
            $methodName = 'get'.$propertyNameCamelCase;
            $converter[$propertyName] = new AnyToInternal($this->typeHook->$methodName(), true);
        }
        
        $this->converterToInternalHook->_setAll($converter); 
    }

    /**
     * Object to store entity property
     */
    protected function setStorageDefault(): void
    {
        foreach ($this->property AS $propertyName) {
            $storage[$propertyName] = null;
        }
        
        $this->storageHook->_setAll($storage); 
    }
}
