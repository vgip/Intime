<?php

declare(strict_types=1);

namespace Vgip\Intime\Entity\Config\District;

use Vgip\Intime\Type\TypeInterface\TypeInterface;

class District
{
    //use StructureTrait;
    
    private $id;
    
    private $regionId;
    
    private $code;
    
    private $status;
    
    private $nameEn;
    
    private $nameUa;
    
    private $nameRu;
    
    private $shortNameEn;
    
    private $shortNameUa;
    
    private $shortNameRu;
    
    private $dateUpdate;
    
    
    public function setId(TypeInterface $id = null)
    {
        if (null === $id) {
            $this->id = new TypeInt(1, 100000, false);
        } else {
            $this->id = $id;
        }
    }
    
    public function getId() : TypeInterface
    {
        return $this->id;
    }

    public function setRegionId(TypeInterface $regionId)
    {
        $this->regionId = $regionId;
    }
    
    public function getRegionId() : int
    {
        return $this->regionId;
    }
    
    public function setCode(string $code) : void
    {
        $this->code = $code;
    }
    
    public function getCode() : string
    {
        return $this->code;
    }

    public function setStatus(bool $status) : void
    {
        $this->status = $status;
    }
    
    public function getStatus() : bool
    {
        return $this->status;
    }

    public function setNameEn(string $nameEn) : void
    {
        $this->nameEn = $nameEn;
    }
    
    public function getNameEn() : string
    {
        return $this->nameEn;
    }

    public function setNameUa(string $nameUa) : void
    {
        $this->nameUa = $nameUa;
    }
    
    public function getNameUa() : string
    {
        return $this->nameUa;
    }

    public function setNameRu(string $nameRu) : void
    {
        $this->nameRu = $nameRu;
    }
    
    public function getNameRu() : string
    {
        return $this->nameRu;
    }

    public function setShortNameEn(string $shortNameEn) : void
    {
        $this->shortNameEn = $shortNameEn;
    }
    
    public function getShortNameEn() : string
    {
        return $this->shortNameEn;
    }

    public function setShortNameUa(string $shortNameUa) : void
    {
        $this->shortNameUa = $shortNameUa;
    }
    
    public function getShortNameUa() : string
    {
        return $this->shortNameUa;
    }

    public function setShortNameRu(string $shortNameRu) : void
    {
        $this->shortNameRu = $shortNameRu;
    }
    
    public function getShortNameRu() : string 
    {
        return $this->shortNameRu;
    }

    public function setDateUpdate(string $dateUpdate) : void
    {
        $this->dateUpdate = $dateUpdate;
    }
    
    public function getDateUpdate() : string
    {
        return $this->dateUpdate;
    }
}
