<?php

declare(strict_types = 1);

namespace Vgip\Intime\Dir;

use Vgip\Intime\Singleton;

class Pattern
{
    use Singleton;
    
    private $regionNameUa = '~^[а-я\s\-\'іїєґІЇЄҐ]+$~ui';
    
    private $regionNameEn = '~^[a-z\s\'-]+$~ui';
    
    private $regionNameRu = '~^[а-я\sёЁ-]+$~ui';
    
    private $branchNameUa = '~^[а-я0-9\s\-\'іїєґІЇЄҐ]+$~ui';
    
    private $branchNameEn = '~^[a-z0-9\s\'-]+$~ui';
    
    private $branchNameRu = '~^[а-я0-9\sёЁ-]+$~ui';
    
    private $addressUa = '~^[а-я0-9\s\-\'іїєґІЇЄҐ\.\,\/]+$~ui';
    
    private $addressEn = '~^[a-z0-9\s\'\-\.\,\/]+$~ui';
    
    private $addressRu = '~^[а-я0-9\sёЁ\-\.\,\/]+$~ui';
    
    private $intimeCode = '~^[0-9]{9}$~u';
    
    private $date = '~^[0-9]{4}-[0-9]{2}-[0-9]{2}$~u';
    
    private $coordinate = '~^[0-9]{2}(?:\,|\.)[0-9]{4,8}$~u';
    
    private $koatuu = '~^[0-9]{10}$~u';
    
    private $index = '~^[0-9]{5}$~u';
    
    public function getRegionNameUa(): string
    {
        return $this->regionNameUa;
    }
    
    public function getRegionNameEn(): string
    {
        return $this->regionNameEn;
    }

    public function getRegionNameRu(): string
    {
        return $this->regionNameRu;
    }
    
    public function getBranchNameUa(): string
    {
        return $this->branchNameUa;
    }

    public function getBranchNameEn(): string
    {
        return $this->branchNameEn;
    }

    public function getBranchNameRu(): string
    {
        return $this->branchNameRu;
    }

    public function getAddressUa(): string
    {
        return $this->addressUa;
    }

    public function getAddressEn(): string
    {
        return $this->addressEn;
    }

    public function getAddressRu(): string
    {
        return $this->addressRu;
    }
            
    public function getIntimeCode(): string 
    {
        return $this->intimeCode;
    }

    public function getDate(): string
    {
        return $this->date;
    }
    
    public function getCoordinate(): string
    {
        return $this->coordinate;
    }
    
    public function getKoatuu(): string
    {
        return $this->koatuu;
    }

    public function getIndex(): string
    {
        return $this->index;
    }

    public function setRegionNameUa(string $regionNameUa): void
    {
        $this->regionNameUa = $regionNameUa;
    }
    
    public function setRegionNameEn(string $regionNameEn): void
    {
        $this->regionNameEn = $regionNameEn;
    }

    public function setRegionNameRu(string $regionNameRu): void
    {
        $this->regionNameRu = $regionNameRu;
    }

    public function setBranchNameUa(string $branchNameUa): void
    {
        $this->branchNameUa = $branchNameUa;
    }

    public function setBranchNameEn(string $branchNameEn): void
    {
        $this->branchNameEn = $branchNameEn;
    }

    public function setBranchNameRu(string $branchNameRu): void
    {
        $this->branchNameRu = $branchNameRu;
    }

    public function setAddressUa(string $addressUa): void
    {
        $this->addressUa = $addressUa;
    }

    public function setAddressEn(string $addressEn): void
    {
        $this->addressEn = $addressEn;
    }

    public function setAddressRu(string $addressRu): void
    {
        $this->addressRu = $addressRu;
    }

    public function setIntimeCode(string $intimeCode): void
    {
        $this->intimeCode = $intimeCode;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function setCoordinate(string $coordinate): void
    {
        $this->coordinate = $coordinate;
    }
    
    public function setKoatuu(string $koatuu): void
    {
        $this->koatuu = $koatuu;
    }

    public function setIndex(string $index): void
    {
        $this->index = $index;
    }
}
