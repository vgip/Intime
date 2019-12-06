<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api\Connection;

class SoapFactory implements TypeFactoryInterface
{
    public function createConnection() : TypeInterface 
    {
        $soap = new Soap();
        
        return $soap;
    }
}
