<?php

declare(strict_types=1);

namespace Vgip\Intime\Entity;

use Vgip\Intime\Entity\EntityInterface\EntityTrait;
use Vgip\Intime\Entity\EntityInterface\EntityInterface;
use Vgip\Intime\Type\TypeInt;
use Vgip\Intime\Type\TypeString;
use Vgip\Intime\Dir\Pattern;
use Vgip\Intime\Type\Converter\AnyToInternal;
use Vgip\Intime\Converter\StringConverter;
use Vgip\Intime\Dir\PropertyTypeCommon;

class Branch implements EntityInterface
{
    use EntityTrait;
    
    /** All entity property (value is all internal key name) */
    private $property = [
        'id',
        'parent_id',
        'type_id',
        'number',
        'name_ua',
        'name_en',
        'name_ru',
        'name_short_ua',
        'name_short_en',
        'name_short_ru',
        'locality_id',
        'latitude',
        'longitude',
        'company_id',
        'address_ua',
        'address_en',
        'address_ru',
        'update_date',
        'status',
    ];
    
    /**
     * Set default types for each property
     */
    private function setTypeDefault(): void
    {
        $propertyTypeCommon = PropertyTypeCommon::getInstance();
        
        $pattern = Pattern::getInstance();
        $patternBranchName = [];
        $patternBranchName['ua'] = $pattern->getBranchNameUa();
        $patternBranchName['en'] = $pattern->getBranchNameEn();
        $patternBranchName['ru'] = $pattern->getBranchNameRu();

        /**
         * Internal key name => type object
         */
        $type = [
            'id'                        => $propertyTypeCommon->getBranchId(),
            'parent_id'                 => new TypeInt($propertyTypeCommon->getBranchId()->getMin(), $propertyTypeCommon->getBranchId()->getMax(), true),
            'type_id'                   => $propertyTypeCommon->getBranchTypeId(),
            'number'                    => $propertyTypeCommon->getBranchNumber(),
            'name_ua'                   => new TypeString(1, 80, $patternBranchName['ua']),
            'name_en'                   => new TypeString(0, 80, $patternBranchName['en']),
            'name_ru'                   => new TypeString(1, 80, $patternBranchName['ru']),
            'name_short_ua'             => new TypeString(1, 30, $patternBranchName['ua']),
            'name_short_en'             => new TypeString(0, 30, $patternBranchName['en']),
            'name_short_ru'             => new TypeString(1, 30, $patternBranchName['ru']),
            'locality_id'               => $propertyTypeCommon->getLocalityId(),
            'latitude'                  => $propertyTypeCommon->getCoordinate(),
            'longitude'                 => $propertyTypeCommon->getCoordinate(),
            'company_id'                => $propertyTypeCommon->getCompanyId(),
            'address_ua'                => $propertyTypeCommon->getAddressUa(),
            'address_en'                => $propertyTypeCommon->getAddressEn(),
            'address_ru'                => $propertyTypeCommon->getAddressRu(),
            'update_date'               => $propertyTypeCommon->getUpdateDate(),
            'status'                    => $propertyTypeCommon->getStatus(),
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
            'parent_id'                 => 'parent_id',
            'branch_type_id'            => 'type_id',
            'branch_number'             => 'number',
            'branch_name_ua'            => 'name_ua',          
            'branch_name_en'            => 'name_en',          
            'branch_name_ru'            => 'name_ru',          
            'branch_short_name_ua'      => 'name_short_ua',
            'branch_short_name_en'      => 'name_short_en',
            'branch_short_name_ru'      => 'name_short_ru',
            'locality_id'               => 'locality_id',
            'latitude'                  => 'latitude',
            'longitude'                 => 'longitude',
            'company_id'                => 'company_id',
            'address_ua'                => 'address_ua',
            'address_en'                => 'address_en',
            'address_ru'                => 'address_ru',
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
    public function setConverterToInternalDefault(): void
    {
        foreach ($this->property AS $propertyName) {
            $propertyNameCamelCase = StringConverter::convertLowerSnakeCaseToUpperCamelCase($propertyName);
            $methodName = 'get'.$propertyNameCamelCase;
            $converter[$propertyName] = new AnyToInternal($this->typeHook->$methodName(), true);
            if ('parent_id' === $propertyName) {
                $converter[$propertyName]->setZeroToNull(true);
            }
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
