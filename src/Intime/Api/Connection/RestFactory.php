<?php

declare(strict_types=1);

namespace Vgip\Intime\Api\Connection;

class RestFactory implements TypeFactoryInterface
{
    public function createConnection() : RestTypeInterface 
    {
        $rest = new Rest();
        
        return $rest;
    }
}
