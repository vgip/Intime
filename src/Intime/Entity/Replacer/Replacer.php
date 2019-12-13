<?php
//** NOT USED */

declare(strict_types=1);

//namespace Vgip\Intime\Entity\Replacer;

class Replacer
{
    private $propertyName;
    
    private $searchReplacement = [];
    
    public function setPropertyName(string $propertyName) : void
    {
        $this->propertyName = $propertyName;
    }
    
    public function getPropertyName() : string
    {
        return $this->propertyName;
    }


    /**
     * 
     * @param array $searchReplacement - [search => replacment, ...]
     * @return void
     */
    public function setSearchReplacement(array $searchReplacement) : void
    {
        $this->searchReplacement = $searchReplacement;
    }
    
    public function getSearchReplacement() : array
    {
        return $this->searchReplacement;
    }


}
