<?php

declare(strict_types = 1);

namespace Vgip\Intime\Entity;

use Vgip\Intime\Entity\EntityInterface\EntityTrait;
use Vgip\Intime\Entity\EntityInterface\EntityInterface;
use Vgip\Intime\Type\Converter\AnyToInternal;
use Vgip\Intime\Converter\StringConverter;
use Vgip\Intime\Dir\PropertyTypeCommon;

class Locality implements EntityInterface
{
    use EntityTrait;
    
    /** All entity property (value is all internal key name) */
    private $property = [
        'id',
        'region_id',
        'type_id',
        'name_ua',
        'name_en',
        'name_ru',
        'name_short_ua',
        'name_short_en',
        'name_short_ru',
        'code',
        'update_date',
        'status',
        'district_id',
        'latitude',
        'longitude',
        'koatuu',
        'index_1',
        'index_2',
    ];
    
    /**
     * Set default types for each property
     */
    private function setTypeDefault(): void
    {
        $propertyTypeCommon = PropertyTypeCommon::getInstance();

        /**
         * Internal key name => type object
         */
        $type = [
            'id'                    => $propertyTypeCommon->getLocalityId(),
            'region_id'             => $propertyTypeCommon->getRegionId(),
            'type_id'               => $propertyTypeCommon->getLocalityTypeId(),
            'name_ua'               => $propertyTypeCommon->getNameUa(),
            'name_en'               => $propertyTypeCommon->getNameEn(),
            'name_ru'               => $propertyTypeCommon->getNameRu(),
            'name_short_ua'         => $propertyTypeCommon->getNameShortUa(),
            'name_short_en'         => $propertyTypeCommon->getNameShortEn(),
            'name_short_ru'         => $propertyTypeCommon->getNameShortRu(),
            'code'                  => $propertyTypeCommon->getCode(),
            'update_date'           => $propertyTypeCommon->getUpdateDate(),
            'status'                => $propertyTypeCommon->getStatus(),
            'district_id'           => $propertyTypeCommon->getDistrictId(),
            'latitude'              => $propertyTypeCommon->getCoordinate(),
            'longitude'             => $propertyTypeCommon->getCoordinate(),
            'koatuu'                => $propertyTypeCommon->getKoatuu(),
            'index_1'               => $propertyTypeCommon->getIndex(),
            'index_2'               => $propertyTypeCommon->getIndex(),
        ];
        
        $this->typeHook->_setAll($type);
    }
    
    /**
     * Set accordance Intime key name to internal key name
     */
    private function setAccordanceSourceInternalDefault(): void
    {
        /**
         * Source key => internal key
         */
        $accordanceSourceInternal = [
            'id'                        => 'id',
            'area_id'                   => 'region_id',    
            'locality_type_id'          => 'type_id',
            'locality_name_ua'          => 'name_ua',          
            'locality_name_en'          => 'name_en',          
            'locality_name_ru'          => 'name_ru',          
            'locality_short_name_ua'    => 'name_short_ua',
            'locality_short_name_en'    => 'name_short_en',
            'locality_short_name_ru'    => 'name_short_ru',
            'locality_code'             => 'code',
            'last_change'               => 'update_date',
            'status'                    => 'status',
            'district_id'               => 'district_id',
            'latitude'                  => 'latitude',
            'longitude'                 => 'longitude',
            'koatuu'                    => 'koatuu',
            'index_1'                   => 'index_1',
            'index_2'                   => 'index_2',
        ];
        
        $this->accordanceSourceInternal->setAll($accordanceSourceInternal);
    }
    
    /**
     * Set converter to convert data from Intime API to internal format
     * 
     * Example date convertion from 2017-05-11T21:09:47.000+03:00 to 2017-05-11
     */
    public function setConverterToInternalDefault(): void
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
    public function setStorageDefault(): void
    {
        foreach ($this->property AS $propertyName) {
            $storage[$propertyName] = null;
        }
        
        $this->storageHook->_setAll($storage); 
    }
}
