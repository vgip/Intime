<?php

declare(strict_types = 1);

namespace Vgip\Intime\Entity\Helper;

use Vgip\Intime\Exception;

class AccordanceSourceInternal
{
    private $data;
    
    /**
    * District property accordance
    *
    * @param array $data Source name => internal name
    */
    public function setAll(array $data)
    {
        $this->data = $data;
    }

    public function getAll() : array
    {
        return $this->data;
    }
    
    public function getInternalBySource(string $nameSource) : ?string
    {
        if (isset($this->data[$nameSource])) {
            $nameInternal = $this->data[$nameSource];
        } else {
            //$nameInternal = null;
            throw new Exception('Name internal key accordance with name Source key "'.$nameSource.'" not found');
        }
        
        return $nameInternal;
    }
    
    public function getSourceByInternal(string $nameInternal) : ?string
    {
        $search = array_search($nameInternal, $this->data);
        if (false === $search) {
            $nameSource = null;
        } else {
            $nameSource = $search;
        }
        
        return $nameSource;
    }
}
