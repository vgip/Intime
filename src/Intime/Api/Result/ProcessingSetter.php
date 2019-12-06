<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api\Result;

use Vgip\Intime\Entity\Country;
use Vgip\Intime\Entity\Region;
use Vgip\Intime\Entity\District;
use Vgip\Intime\Entity\Locality;
use Vgip\Intime\Entity\Branch;
use Vgip\Intime\Singleton;
use Vgip\Intime\Entity\EntityInterface\EntityInterface;

class ProcessingSetter
{
    use Singleton;
    
    private $country;
    
    private $region;
    
    private $district;
    
    private $locality;
    
    private $branch;
    
    public function setCountry(EntityInterface $country)
    {
        $this->country = $country;
    }
    
    public function getCountry() : EntityInterface
    {
        if (null === $this->country) {
            $this->country = new Country();
        }
        
        return $this->country;
    }
    
    public function setRegion(EntityInterface $region) 
    {
        $this->region = $region;
    }
    
    public function getRegion() : EntityInterface
    {
        if (null === $this->region) {
            $this->region = new Region();
        }
        
        return $this->region;
    }

    public function setDistrict(EntityInterface $district) 
    {
        $this->district = $district;
    }
    
    public function getDistrict() : EntityInterface
    {
        if (null === $this->district) {
            $this->district = new District();
        }
        
        return $this->district;
    }
    
    public function setLocality(EntityInterface $locality) 
    {
        $this->locality = $locality;
    }

    public function getLocality() : EntityInterface
    {
        if (null === $this->locality) {
            $this->locality = new Locality();
        }        
        
        return $this->locality;
    }
    
    public function setBranch(EntityInterface $branch) 
    {
        $this->branch = $branch;
    }

    public function getBranch() : EntityInterface
    {
        if (null === $this->branch) {
            $this->branch = new Branch();
        }
        
        return $this->branch;
    }
}
