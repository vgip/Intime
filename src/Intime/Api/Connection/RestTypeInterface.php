<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api\Connection;

use Vgip\Intime\Api\ConfigInterface;

interface RestTypeInterface
{
    public function connect(string $action, array $data, ConfigInterface $config);
}
