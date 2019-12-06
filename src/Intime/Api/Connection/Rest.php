<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api\Connection;

use Vgip\Intime\Api\ConfigInterface;
use Vgip\Intime\Dir\ActionAccordance;

class Rest implements RestTypeInterface
{
    /**
     * Connect - create request and attempt to get a response to the request using a special class
     * 
     * @param string $action
     * @param array $data
     * @param ConfigInterface $config
     * @return string
     */
    public function connect(string $action, array $data, ConfigInterface $config): ?string
    {
        $connectionClass = $config->getConnection();
        $connection = new $connectionClass($action, $data, $config);

        /** "api_key" OR "p_api_key" */
        $actionAccordance = ActionAccordance::getInstance(); 
        $apiKeyName = $actionAccordance->getApiKeyName($action);  
        
        /** Add API key to data */
        $dataMergetWitApiKey = array_merge([$apiKeyName => $config->getKey()], $data);
        
        $url = $this->getUrlToRequest($config->getUrl(), $action, $dataMergetWitApiKey, $config->getRestRequestType());
        
        $body = $this->getBodyToRequest($dataMergetWitApiKey, $config->getRestRequestType(), $config->getRestContentType());
        $config->getResultConnection()->setRequestBody($body);
        
        return $connection->connect($url, $body);
    }
    
    /**
     * Get GET property to URL
     * 
     * @param string $urlApi
     * @param string $action
     * @param array $data
     * @param string $requestType
     * @return string
     */
    public function getUrlToRequest(string $urlApi, string $action, array $data, string $requestType): string
    {
        $getVar = '';
        if ('GET' === $requestType) {
            $getVar = $this->getGetVar($data);
        }
        
        $urlToRequest = $urlApi.'/'.$action.$getVar;
        
        return $urlToRequest;
    }
    
    /**
     * Get body to POST request
     * 
     * For GET request body is empty
     * 
     * @param array $data
     * @param string $requestType
     * @param string $contentType
     * @return string
     */
    public function getBodyToRequest(array $data, string $requestType, string $contentType): string
    {
        $body = '';
        
        if ('POST' === $requestType) {
            if ('application/json' === $contentType) {
                $body = $this->getBodyJson($data);
            } else {
                $body = $this->getBodyApplicationXml($data);
            } 
        }
        
        return $body;
    }
    
    /**
     * Get JSON as string with main property "Body"
     * 
     * @param array $data
     * @return string
     */
    public function getBodyJson(array $data): string
    {
        $dataJsonArr = [];
        $dataJsonArr['Body'] = $data;
        
        $dataJsonString = json_encode($dataJsonArr);
        
        return $dataJsonString;
    }
    
    /**
     * Get XML as string with main property "Body"
     * 
     * @param array $data
     * @return string
     */
    public function getBodyApplicationXml(array $data): string
    {
        $row = '';
        
        foreach ($data AS $propery => $value) {
            $row .= '  <'.$propery.'>'.$value.'</'.$propery.'>'."\n";
        }
        
        $dataApplicationXml = '<Body>'."\n".$row.'</Body>';
        
        return $dataApplicationXml;
    }

    /**
     * Get data for GET request 
     * 
     * Example: ?get_var_1=1&p2=d&...
     * 
     * @param type $data
     * @return string
     */
    private function getGetVar(array $data): string
    {
        $getVar = '';
        
        if (count($data) > 0) {
            $getVarArr = [];

            foreach ($data AS $propery => $value) {
                $getVarArr[] = $propery.'='.$value;
            }
            $getVar = '?'.join('&', $getVarArr);
        }
        
        return $getVar;
    }
}
