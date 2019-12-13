<?php

declare(strict_types=1);

namespace Vgip\Intime\Api\Connection;

use Vgip\Intime\Api\ConfigInterface;

interface connectionInterface
{
    public function __construct(string $action, array $data, ConfigInterface $config);
    
    public function connect(string $url, string $body): ?string;
}
