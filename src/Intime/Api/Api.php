<?php

/**
 * Api - get data from API
 */

declare(strict_types=1);

namespace Vgip\Intime\Api;

use Vgip\Intime\Api\ConfigInterface;
use Vgip\Intime\Api\Connection\RestFactory;
use Vgip\Intime\Api\Connection\SoapFactory;
use Vgip\Intime\Dir\ActionAccordance;
use Vgip\Intime\Api\Result\ResultConnectionInterface;

class Api implements ApiInterface
{
    private $config;
    
    private $resultConnection;
    
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
        
        $this->resultConnection = $config->getResultConnection();
        
        $this->resultConnection->setConfig($config);
    }
    
    /**
     * Wrap for COUNTRY_BY_ID action
     */
    public function getCountry(int $id = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['id'] = $id;
        }
        
        $res = $this->createConnectionType('country', $data);
        
        return $res;
    }
    
    /**
     * Wrap for AREA_FILTERED action
     */
    public function getRegion(int $id = null, ?int $countryId = 215, string $name = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['id'] = $id;
        }
        
        if (null !== $countryId) {
            $data['country_id'] = $countryId;
        }
        
        if (null !== $name) {
            $data['name'] = $name;
        }
        print_r($name);
        $res = $this->createConnectionType('region', $data);
        
        return $res;
    }
    
    /**
     * Alias for getRegion() method
     */
    public function getArea(int $id = null, ?int $countryId = 215, string $name = null): ResultConnectionInterface
    {
        $res = $this->getRegion($id, $countryId, $name);
        
        return $res;
    }
    
    /**
     * Wrap for DISTRICT_FILTERED action
     */
    public function getDistrict(int $id = null, ?int $countryId = 215, int $regionId = null, string $name = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['id'] = $id;
        }
        
        if (null !== $countryId) {
            $data['country_id'] = $countryId;
        }
        
        if (null !== $regionId) {
            $data['area_id'] = $regionId;
        }
        
        if (null !== $name) {
            $data['name'] = $name;
        }
        print_r($data);
        $res = $this->createConnectionType('district', $data);
        
        return $res;
    }
    
    /**
     * Partial functionality of getDistrict() method
     */
    public function getDistrictById(int $id = null): ResultConnectionInterface
    {
        $res = $this->getDistrict($id);
        
        return $res;
    }
    
    /**
     * Partial functionality of getDistrict() method
     */
    public function getDistrictByRegionId(int $regionId = null): ResultConnectionInterface
    {
        $res = $this->getDistrict(null, null, $regionId);
        
        return $res;
    }
    
    /**
     * Alias for getDistrict() method
     */
    public function getDistrictByAreaId(int $regionId = null): ResultConnectionInterface
    {
        $res = $this->getDistrictByRegionId($regionId);
        
        return $res;
    }
    
    /**
     * Wrap for LOCALITY_FILTERED action
     * CAUTION, calling a function without parameters (or all set to zero) 
     * will return approximately 27,000 results
     */
    public function getLocality(int $id = null, ?int $countryId = 215, int $regionId = null, int $districtId = null, string $name = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['id'] = $id;
        }
        
        if (null !== $countryId) {
            $data['country_id'] = $countryId;
        }
        
        if (null !== $regionId) {
            $data['area_id'] = $regionId;
        }
        
        if (null !== $districtId) {
            $data['district_id'] = $districtId;
        }
        
        if (null !== $name) {
            $data['name'] = $name;
        }
        
        $res = $this->createConnectionType('locality', $data);
        
        return $res;
    }
    
    /**
     * Partial functionality of getLocality() method
     */
    public function getLocalityById(int $id = null): ResultConnectionInterface
    {
        $res = $this->getLocality($id);
        
        return $res;
    }
    
    /**
     * Partial functionality of getLocality() method
     */
    public function getLocalityByRegionId(int $regionId = null): ResultConnectionInterface
    {
        $res = $this->getLocality(null, null, $regionId);
        
        return $res;
    }
    
    /**
     * Alias for getLocality() method
     */
    public function getLocalityByAreaId(int $regionId = null): ResultConnectionInterface
    {
        $res = $this->getLocalityByRegionId($regionId);
        
        return $res;
    }
    
    /**
     * Partial functionality of getLocality() method
     */
    public function getLocalityByDistrictId(int $districtId = null): ResultConnectionInterface
    {
        $res = $this->getLocality(null, null, null, $districtId);
        
        return $res;
    }
    
    /**
     * Wrap for BRANCH_FILTERED action
     */
    public function getBranch(int $id = null, ?int $countryId = 215, int $regionId = null, int $districtId = null, int $localityId = null, string $name = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['id'] = $id;
        }
        
        if (null !== $countryId) {
            $data['country_id'] = $countryId;
        }
        
        if (null !== $regionId) {
            $data['area_id'] = $regionId;
        }
        
        if (null !== $districtId) {
            $data['district_id'] = $districtId;
        }
        
        if (null !== $localityId) {
            $data['locality_id'] = $localityId;
        }
        
        if (null !== $name) {
            $data['name'] = $name;
        }
        
        $res = $this->createConnectionType('branch', $data);
        
        return $res;
    }
    
    /**
     * Partial functionality of getBranch() method
     */
    public function getBranchById(int $id = null): ResultConnectionInterface
    {
        $res = $this->getBranch($id);
        
        return $res;
    }
    
    /**
     * Partial functionality of getBranch() method
     */
    public function getBranchByRegionId(int $regionId = null): ResultConnectionInterface
    {
        $res = $this->getBranch(null, null, $regionId);
        
        return $res;
    }
    
    /**
     * Alias for getBranchByRegionId() method
     */
    public function getBranchByAreaId(int $regionId = null): ResultConnectionInterface
    {
        $res = $this->getBranchByRegionId($regionId);
        
        return $res;
    }

    /**
     * Partial functionality of getBranch() method
     */
    public function getBranchByDistrictId(int $districtId = null): ResultConnectionInterface
    {
        $res = $this->getBranch(null, null, null, $districtId);
        
        return $res;
    }
    
    /**
     * Partial functionality of getBranch() method
     */
    public function getBranchByLocalityId(int $localityId = null): ResultConnectionInterface
    {
        $res = $this->getBranch(null, null, null, null, $localityId);
        
        return $res;
    }
    
    /**
     * WARNING: a call without parameters returns a large amount of data
     *
     * @param int $branchId
     * @return type
     */
    public function getBranchWorkHours(int $branchId = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $branchId) {
            $data['id'] = $branchId;
        }
        
        $res = $this->createConnectionType('branch_work_hours', $data);
        
        return $res;
    }
    
    public function getBranchApi2(int $idApi2 = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $idApi2) {
            $data['id_api2'] = $idApi2;
        }
        
        $res = $this->createConnectionType('branch_api2', $data);
        
        return $res;
    }
    
    public function getContentDescription(int $id = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['id'] = $id;
        }
        
        $res = $this->createConnectionType('content_description', $data);
        
        return $res;
    }
    
    public function getPackaging(int $id = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['id'] = $id;
        }
        
        $res = $this->createConnectionType('packaging', $data);
        
        return $res;
    }
    
    public function createDeclaration(array $data): ResultConnectionInterface
    {
        $res = $this->createConnectionType('declaration_create', $data);
        
        return $res;
    }
    
    public function updateDeclaration(array $data): ResultConnectionInterface
    {
        $res = $this->createConnectionType('declaration_update', $data);
        
        return $res;
    }
    
    public function deleteDeclaration(string $id = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['pdecl_id'] = $id;
        }
        
        $res = $this->createConnectionType('declaration_delete', $data);
        
        return $res;
    }
    
    public function getDeclaration(string $id = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['decl_num'] = $id;
        }
        
        $res = $this->createConnectionType('declaration', $data);
        
        return $res;
    }
    
    public function getDeclarationCalculate(array $data): ResultConnectionInterface
    {
        $res = $this->createConnectionType('declaration_calculate', $data);
        
        return $res;
    }
    
    public function getDeclarationStatus(string $id = null, string $additionalId = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['decl_num'] = $id;
        }
        
        if (null !== $additionalId) {
            $data['p_dop_num'] = $additionalId;
        }
        
        $res = $this->createConnectionType('declaration_status', $data);
        
        return $res;
    }
    
    public function getDeclarationStatusByAdditionalNumber(string $id = null, string $additionalNumber = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['decl_num'] = $id;
        }
        
        if (null !== $additionalNumber) {
            $data['p_dop_num'] = $additionalNumber;
        }
        
        $res = $this->createConnectionType('declaration_status_additional_number', $data);
        
        return $res;
    }

    public function getResultConnection()
    {
        return $this->resultConnection;
    }

    
    private function createConnectionType($action, $data)
    {
        $connectionTypeUpper = $this->config->getConnectionType();
        $connectionTypeLower = mb_strtolower($connectionTypeUpper);
        $connectionType = ucfirst($connectionTypeLower);
        
        $functionName   = 'createConnectionType' . $connectionType;
        
        $actionAccordance = ActionAccordance::getInstance();
        $actionApiName  = $actionAccordance->getActionNameIntimeByInternal($action);
        
        $connection = $this->$functionName($actionApiName, $data);
        
        $res = $connection->connect($actionApiName, $data, $this->config);

        $dataSet = (count($data) > 0) ? $data : null;
        
        $this->resultConnection->setAction($action);
        $this->resultConnection->setRequestData($dataSet);
        
        return $this->resultConnection;
    }

    private function createConnectionTypeRest($action, $data)
    {
        $connectionTypeFactory = new RestFactory();
        $resultConnection = $connectionTypeFactory->createConnection($action, $data, $this->config);
        
        return $resultConnection;
    }
    
    private function createConnectionTypeSoap($action, $data)
    {
        $connectionTypeFactory = new SoapFactory();
        $resultConnection = $connectionTypeFactory->createConnection($action, $data, $this->config);
        
        return $resultConnection;
    }
}
