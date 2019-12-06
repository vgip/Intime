<?php

declare(strict_types = 1);

namespace Vgip\Intime\Dir;

use Vgip\Intime\Singleton;
use Vgip\Intime\Dir\Pattern;
use Vgip\Intime\Type\TypeInt;
use Vgip\Intime\Type\TypeString;
use Vgip\Intime\Type\TypeBool;
use Vgip\Intime\Type\TypeDateTime;
use Vgip\Intime\Type\TypeInterface\TypeInterface;

class PropertyTypeCommon
{
    use Singleton;
    
    private $id;
    
    private $countryId;
    
    private $regionId;
    
    private $districtId;
    
    private $localityId;
    
    private $localityTypeId;
    
    private $branchId;
    
    private $branchTypeId;
    
    private $branchNumber;
    
    private $companyId;
    
    private $nameUa;
    
    private $nameEn;
    
    private $nameRu;
    
    private $nameShortUa;
    
    private $nameShortEn;
    
    private $nameShortRu;
    
    private $addressUa;
    
    private $addressEn;
    
    private $addressRu;
    
    private $code;
    
    private $updateDate;
    
    private $status;
    
    private $coordinate;
    
    private $koatuu;
    
    private $index;

    private function setTypeDefault()
    {
        $pattern = Pattern::getInstance();
        $patternRegionName = [];
        $patternRegionName['ua'] = $pattern->getRegionNameUa();
        $patternRegionName['en'] = $pattern->getRegionNameEn();
        $patternRegionName['ru'] = $pattern->getRegionNameRu();
        
        $nextYearDate = (date('Y') + 1).'-'.date('m-d');
        
        $this->id               = new TypeInt(1, 1000000, false);
        $this->countryId        = new TypeInt(1, 300, false);
        $this->regionId         = new TypeInt(1, 30, false);
        $this->districtId       = new TypeInt(1, 10000, false);
        $this->localityId       = new TypeInt(1, 100000, false);
        $this->localityTypeId   = new TypeInt(0, 4, false);
        $this->branchId         = new TypeInt(1, 100000, false);
        $this->branchTypeId     = new TypeInt(2, 3, false);
        $this->branchNumber     = new TypeInt(1, 300, false);
        $this->companyId        = new TypeInt(1, 3, false);
        $this->nameUa           = new TypeString(1, 80, $patternRegionName['ua']);
        $this->nameEn           = new TypeString(0, 80, $patternRegionName['en']);
        $this->nameRu           = new TypeString(1, 80, $patternRegionName['ru']);
        $this->nameShortUa      = new TypeString(1, 30, $patternRegionName['ua']);
        $this->nameShortEn      = new TypeString(0, 30, $patternRegionName['en']);
        $this->nameShortRu      = new TypeString(1, 30, $patternRegionName['ru']);
        $this->addressUa        = new TypeString(1, 150, $pattern->getAddressUa());
        $this->addressEn        = new TypeString(0, 150, $pattern->getAddressEn());
        $this->addressRu        = new TypeString(1, 150, $pattern->getAddressRu());
        $this->code             = new TypeString(9, 9, $pattern->getIntimeCode());
        $this->updateDate       = new TypeDateTime('2000-01-01', $nextYearDate, false);
        $this->status           = new TypeBool(false);
        $this->coordinate       = new TypeString(0, null, $pattern->getCoordinate());
        $this->koatuu           = new TypeString(0, null, $pattern->getKoatuu());
        $this->index            = new TypeString(0, null, $pattern->getIndex());
    }
    
    private function init()
    {
        $this->setTypeDefault();
    }
    
    public function getId() : TypeInterface
    {
        return $this->id;
    }
    
    public function getCountryId() : TypeInterface
    {
        return $this->countryId;
    }

    public function getRegionId() : TypeInterface
    {
        return $this->regionId;
    }
    
    public function getDistrictId() : TypeInterface
    {
        return $this->districtId;
    }
    
    public function getLocalityId() : TypeInterface
    {
        return $this->localityId;
    }

    public function getLocalityTypeId() : TypeInterface
    {
        return $this->localityTypeId;
    }
    
    public function getBranchId() : TypeInterface
    {
        return $this->branchId;
    }

    public function getBranchTypeId() : TypeInterface
    {
        return $this->branchTypeId;
    }

    public function getBranchNumber() : TypeInterface
    {
        return $this->branchNumber;
    }
    
    public function getCompanyId() : TypeInterface
    {
        return $this->companyId;
    }

    public function getNameUa() : TypeInterface
    {
        return $this->nameUa;
    }

    public function getNameEn() : TypeInterface
    {
        return $this->nameEn;
    }

    public function getNameRu() : TypeInterface
    {
        return $this->nameRu;
    }

    public function getNameShortUa() : TypeInterface
    {
        return $this->nameShortUa;
    }

    public function getNameShortEn() : TypeInterface
    {
        return $this->nameShortEn;
    }

    public function getNameShortRu() : TypeInterface
    {
        return $this->nameShortRu;
    }

    public function getAddressUa() : TypeInterface
    {
        return $this->addressUa;
    }

    public function getAddressEn() : TypeInterface
    {
        return $this->addressEn;
    }

    public function getAddressRu() : TypeInterface
    {
        return $this->addressRu;
    }
        
    public function getCode() : TypeInterface
    {
        return $this->code;
    }

    public function getUpdateDate() : TypeInterface
    {
        return $this->updateDate;
    }

    public function getStatus() : TypeInterface
    {
        return $this->status;
    }
    
    public function getCoordinate() : TypeInterface
    {
        return $this->coordinate;
    }

    public function getKoatuu() : TypeInterface
    {
        return $this->koatuu;
    }

    public function getIndex() : TypeInterface
    {
        return $this->index;
    }
    
    public function setId(TypeInterface $id): void
    {
        $this->id = $id;
    }
    
    public function setCountryId(TypeInterface $countryId): void
    {
        $this->countryId = $countryId;
    }

    public function setRegionId(TypeInterface $regionId): void
    {
        $this->regionId = $regionId;
    }
    
    public function setDistrictId(TypeInterface $districtId): void
    {
        $this->districtId = $districtId;
    }

    public function setLocalityId(TypeInterface $localityId): void
    {
        $this->localityId = $localityId;
    }
    
    public function setLocalityTypeId(TypeInterface $localityTypeId): void
    {
        $this->localityTypeId = $localityTypeId;
    }

    public function setBranchId(TypeInterface $branchId): void
    {
        $this->branchId = $branchId;
    }

    public function setBranchTypeId(TypeInterface $branchTypeId): void
    {
        $this->branchTypeId = $branchTypeId;
    }

    public function setBranchNumber(TypeInterface $branchNumber): void
    {
        $this->branchNumber = $branchNumber;
    }

    public function setCompanyId(TypeInterface $companyId): void
    {
        $this->companyId = $companyId;
    }

    public function setNameUa(TypeInterface $nameUa): void
    {
        $this->nameUa = $nameUa;
    }

    public function setNameEn(TypeInterface $nameEn): void
    {
        $this->nameEn = $nameEn;
    }

    public function setNameRu(TypeInterface $nameRu): void
    {
        $this->nameRu = $nameRu;
    }

    public function setNameShortUa(TypeInterface $nameShortUa): void
    {
        $this->nameShortUa = $nameShortUa;
    }

    public function setNameShortEn(TypeInterface $nameShortEn): void
    {
        $this->nameShortEn = $nameShortEn;
    }

    public function setNameShortRu(TypeInterface $nameShortRu): void
    {
        $this->nameShortRu = $nameShortRu;
    }
    
    public function setAddressUa(TypeInterface $addressUa): void
    {
        $this->addressUa = $addressUa;
    }

    public function setAddressEn(TypeInterface $addressEn): void
    {
        $this->addressEn = $addressEn;
    }

    public function setAddressRu(TypeInterface $addressRu): void
    {
        $this->addressRu = $addressRu;
    }
    
    public function setCode(TypeInterface $code): void
    {
        $this->code = $code;
    }

    public function setUpdateDate(TypeInterface $updateDate): void
    {
        $this->updateDate = $updateDate;
    }

    public function setStatus(TypeInterface $status): void
    {
        $this->status = $status;
    }
    
    public function setCoordinate(TypeInterface $coordinate): void
    {
        $this->coordinate = $coordinate;
    }

    public function setKoatuu(TypeInterface $koatuu): void
    {
        $this->koatuu = $koatuu;
    }

    public function setIndex(TypeInterface $index): void
    {
        $this->index = $index;
    }
}
