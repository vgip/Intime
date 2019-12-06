<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api;

interface ApiInterface
{
    //public function __construct(Vgip\Intime\Api\ApiConfigInterface $apiConfigInterface);

    public function getCountry(int $id = null);
    
    public function getRegion(int $id = null, int $countryId = null, string $name = null);
    
    /** 
     * Smilar (other name) $this->getRegion() method
     * 
     * @param int $id
     * @param int $countryId
     * @param string $regionName
     */
    public function getArea(int $id = null, int $countryId = null, string $name = null);
    
    public function getDistrict(int $id = null, int $countryId = null, int $regionId = null, string $name = null);
    
    public function getLocality(int $id = null, int $countryId = null, int $regionId = null, int $districtId = null, string $name = null);
    
    public function getBranch(int $id = null, int $countryId = null, int $regionId = null, int $districtId = null, int $localityId = null, string $name = null);
    
    public function getBranchWorkHours(int $id);
}
