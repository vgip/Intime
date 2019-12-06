<?php

declare(strict_types = 1);

namespace Vgip\Intime\Api\Connection\Rest;

interface RestInterface
{
    public function connect(string $url, string $body);
}

