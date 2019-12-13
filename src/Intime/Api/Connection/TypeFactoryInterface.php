<?php

declare(strict_types=1);

namespace Vgip\Intime\Api\Connection;

interface TypeFactoryInterface
{
    public function createConnection() : RestTypeInterface;
}
