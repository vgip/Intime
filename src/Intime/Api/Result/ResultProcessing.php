<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api\Result;

use Vgip\Intime\Converter\StringConverter;
use Vgip\Intime\Error\Error;
use Vgip\Intime\Api\Result\ProcessingSetter;

class ResultProcessing
{
    
    private $validation = true;
    
    private $notValidDataRowSkipIfError = true;
    
    /**
     * Type row storage
     * 
     * @var string 'object' or 'array' flag
     */
    private $storageType = 'object';
    
    private $action;

    private $error;
    
    public function __construct() 
    {
        $this->error = new Error();
    }

    public function setValidation(bool $validation, bool $notValidDataRowSkipIfError)
    {
        $this->validation                   = $validation;
        $this->notValidDataRowSkipIfError   = $notValidDataRowSkipIfError;
    }
    
    public function setStorageType(string $storageType)
    {
        $this->storageType = $storageType;
    }
    
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    public function getData(array $data) : array
    {
        $storageRow = [];
        
        $processingSetter               = ProcessingSetter::getInstance();
        $processingSetterFunctionName   = 'get'.ucfirst($this->action);
        $actionObject = $processingSetter->$processingSetterFunctionName();
        //exit('dev stop');
        //$actionObjectName   = 'Vgip\\Intime\\Entity\\'.$this->actionAccordance[$this->action];
        //$actionObject       = new $actionObjectName();
        
        $accordanceSourceInternal = $actionObject->getAccordanceSourceInternal();
        $rowCounter = 0;
        
        $getterMethodNameList = [];
        $errPropertyFlag = false;
        
        foreach ($data AS $rowNumberSource => $row) {
            $rowCounter++;
            
            if (1 === $rowCounter) {
                $converter  = $actionObject->getConverterToInternal();
                $type       = $actionObject->getType();
            }
            
            if ('object' === $this->storageType) {
                $storageObject[$rowCounter] = $actionObject->getStorage();
            }
            
            foreach ($row AS $keySourceName => $value) {

                /** Object getter */
                if (1 === $rowCounter) {
                    $keyInternalName    = $accordanceSourceInternal->getInternalBySource($keySourceName);           // Example: name_short_ua
                    $propertyName       = StringConverter::convertLowerSnakeCaseToUpperCamelCase($keyInternalName); // Example: NameShortUa
                    $getterMethodName   = 'get'.$propertyName;                                                      // Example: getNameShortUa
                    $setterMethodName   = 'set'.$propertyName;                                                      // Example: SetNameShortUa
                    
                    $keyInternalNameList[$keySourceName]    = $keyInternalName;
                    $getterMethodNameList[$keySourceName]   = $getterMethodName;
                    $setterMethodNameList[$keySourceName]   = $setterMethodName;
                    $propertyNameList[$keySourceName]       = $propertyName;
                    
                    $converterList[$keySourceName]          = $converter->$getterMethodName();
                    $typeObjList[$keySourceName]            = $type->$getterMethodName();
                    $validatorList[$keySourceName]          = $typeObjList[$keySourceName]->getValidator();
                }

                /** Convertion to internal format */
                $convertedValue     = $converterList[$keySourceName]->convert($value);
                
                /** Validate */
                if (true === $this->validation) {
                    $validateResult     = $validatorList[$keySourceName]->isValid($convertedValue, $typeObjList[$keySourceName]);
                
                    $errorMessage = '';
                    if (false === $validateResult) {
                        $error          = $validatorList[$keySourceName]->getError();
                        $errorMessage   = 'source data validation row #'.$rowCounter.' (row source #'.$rowNumberSource.'), property "'.$propertyNameList[$keySourceName].'": '.join(';', $error->getErrorAll());
                        $errorKey       = 'row_'.$rowCounter.'_'.$keyInternalNameList[$keySourceName];
                        $this->error->setErrorMessage($errorKey, $errorMessage);
                        $errPropertyFlag = true;
                        
                        if (true === $this->notValidDataRowSkipIfError) {
                            continue;
                        }
                    }
                }
                
                $setterMethodName = $setterMethodNameList[$keySourceName];
                
                if ('object' === $this->storageType) {
                    $storageObject[$rowCounter]->$setterMethodName($convertedValue);
                } else {
                    $storageRow[$rowCounter][$keyInternalNameList[$keySourceName]] = $convertedValue;
                }
            }
            
            if ('object' === $this->storageType) {
                $storageRow[$rowCounter] = $storageObject[$rowCounter];
            }
            
            if (true === $errPropertyFlag AND true === $this->notValidDataRowSkipIfError) {
                unset($storageRow[$rowCounter]);
                $errPropertyFlag = false;
            }
        }
        
        return $storageRow;
    }
    
    public function getError()
    {
        return $this->error;
    }
    
    public function setErrorMessage(string $key, string $value)
    {
        return $this->error->setErrorMessage($key, $value);
    }
    
    public function setErrorMessageAll(Error $error)
    {
        return $this->error->setErrorMessageAll($error);
    }
}
