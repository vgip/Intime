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

class Api //implements ApiInterface
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
     * Get country
     *
     * Wrap for COUNTRY_BY_ID action
     *
     * @param int $id
     * @return ResultConnectionInterface
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
     * Get region (area)
     *
     * Wrap for AREA_FILTERED action
     *
     * @param int $id
     * @param int $countryId
     * @param string $name
     * @return ResultConnectionInterface
     */
    public function getRegion(int $id = null, int $countryId = null, string $name = null): ResultConnectionInterface
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
        
        $res = $this->createConnectionType('region', $data);
        
        return $res;
    }
    
    /**
     * Get area (region)
     *
     * Alias to getRegion() method
     *
     * @param int $id
     * @param int $countryId
     * @param string $name
     * @return ResultConnectionInterface
     */
    public function getArea(int $id = null, int $countryId = null, string $name = null): ResultConnectionInterface
    {
        $data = [];
        
        $res = $this->getRegion($id, $countryId, $name);
        
        return $res;
    }
    
    /**
     * Get district
     *
     * Wrap for DISTRICT_FILTERED action
     *
     * @param int $id
     * @param int $countryId
     * @param int $regionId
     * @param string $name
     * @return ResultConnectionInterface
     */
    public function getDistrict(int $id = null, int $countryId = null, int $regionId = null, string $name = null): ResultConnectionInterface
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
        
        $res = $this->createConnectionType('district', $data);
        
        return $res;
    }
    
    /**
     * Get district by id
     *
     * Partial functionality of getDistrict() method
     *
     * @param int $id
     * @return ResultConnectionInterface
     */
    public function getDistrictById(int $id = null): ResultConnectionInterface
    {
        $res = $this->getDistrict($id);
        
        return $res;
    }
    
    /**
     * Get district by region (area) id
     *
     * Partial functionality of getDistrict() method
     *
     * @param int $regionId
     * @return ResultConnectionInterface
     */
    public function getDistrictByRegionId(int $regionId = null): ResultConnectionInterface
    {
        $res = $this->getDistrict(null, null, $regionId);
        
        return $res;
    }
    
    /**
     * Get district by area (region) id
     *
     * Partial functionality of getDistrict() method
     *
     * @param int $regionId
     * @return ResultConnectionInterface
     */
    public function getDistrictByAreaId(int $regionId = null): ResultConnectionInterface
    {
        $res = $this->getDistrictByRegionId($regionId);
        
        return $res;
    }
    
    /**
     * Get locality
     *
     * Wrap for LOCALITY_FILTERED action
     *
     * @param int $id
     * @param int $countryId
     * @param int $regionId
     * @param int $districtId
     * @param string $name
     * @return ResultConnectionInterface
     */
    public function getLocality(int $id = null, int $countryId = null, int $regionId = null, int $districtId = null, string $name = null): ResultConnectionInterface
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
     * Get locality by id
     *
     * Partial functionality of getLocality() method
     *
     * @param int $regionId
     * @return ResultConnectionInterface
     */
    public function getLocalityByRegionId(int $regionId = null): ResultConnectionInterface
    {
        $res = $this->getLocality(null, null, $regionId);
        
        return $res;
    }
    
    public function getBranch(int $id = null, int $countryId = null, int $regionId = null, int $districtId = null, int $localityId = null, string $name = null): ResultConnectionInterface
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
    
    public function getGoodsDescription(int $id = null): ResultConnectionInterface
    {
        $data = [];
        
        if (null !== $id) {
            $data['id'] = $id;
        }
        
        $res = $this->createConnectionType('goods_description', $data);
        
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
    
    public function getDeclaration(string $id = null)
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
    
    public function getDeclarationStatus(string $id = null, string $additionalId = null)
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
    
    public function getDeclarationStatusMin(string $id = null)
    {
        $data = [];
        
        if (null !== $id) {
            $data['decl_num'] = $id;
        }
        
        $res = $this->createConnectionType('declaration_status_min', $data);
        
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

        $this->resultConnection->setAction($action);
        $this->resultConnection->setRequestData($data);
        
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
