<?php

declare(strict_types=1);

namespace Vgip\Intime\Api;

use Vgip\Intime\Api\ConfigInterface;
use Vgip\Intime\Api\Result\ResultConnectionInterface;

interface ApiInterface
{
    public function __construct(ConfigInterface $apiConfigInterface);

    public function getCountry(int $id = null): ResultConnectionInterface;
    
    public function getRegion(int $id = null, int $countryId = null, string $name = null): ResultConnectionInterface;
    
    public function getArea(int $id = null, int $countryId = null, string $name = null): ResultConnectionInterface;
    
    public function getDistrict(int $id = null, int $countryId = null, int $regionId = null, string $name = null): ResultConnectionInterface;
    
    public function getDistrictById(int $id = null): ResultConnectionInterface;
    
    public function getDistrictByRegionId(int $regionId = null): ResultConnectionInterface;
    
    public function getDistrictByAreaId(int $regionId = null): ResultConnectionInterface;
    
    public function getLocality(int $id = null, int $countryId = null, int $regionId = null, int $districtId = null, string $name = null): ResultConnectionInterface;
    
    public function getLocalityById(int $id = null): ResultConnectionInterface;
    
    public function getLocalityByRegionId(int $regionId = null): ResultConnectionInterface;
    
    public function getLocalityByAreaId(int $regionId = null): ResultConnectionInterface;
    
    public function getLocalityByDistrictId(int $districtId = null): ResultConnectionInterface;
    
    public function getBranch(int $id = null, int $countryId = null, int $regionId = null, int $districtId = null, int $localityId = null, string $name = null): ResultConnectionInterface;
    
    public function getBranchById(int $id = null): ResultConnectionInterface;
    
    public function getBranchByRegionId(int $regionId = null): ResultConnectionInterface;
    
    public function getBranchByAreaId(int $regionId = null): ResultConnectionInterface;
    
    public function getBranchByDistrictId(int $districtId = null): ResultConnectionInterface;
    
    public function getBranchByLocalityId(int $localityId = null): ResultConnectionInterface;
    
    public function getBranchApi2(int $idApi2 = null): ResultConnectionInterface;
    
    public function getBranchWorkHours(int $id): ResultConnectionInterface;
    
    public function getContentDescription(int $id = null): ResultConnectionInterface;
    
    public function getPackaging(int $id = null): ResultConnectionInterface;
    
    public function createDeclaration(array $data): ResultConnectionInterface;
    
    public function updateDeclaration(array $data): ResultConnectionInterface;
    
    public function deleteDeclaration(string $id = null): ResultConnectionInterface;
    
    public function getDeclaration(string $id = null): ResultConnectionInterface;
    
    public function getDeclarationCalculate(array $data): ResultConnectionInterface;
    
    public function getDeclarationStatus(string $id = null, string $additionalId = null): ResultConnectionInterface;
    
    public function getDeclarationStatusByAdditionalNumber(string $id = null, string $additionalNumber = null): ResultConnectionInterface;
}
