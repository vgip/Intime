<?php

declare(strict_types = 1);

namespace Vgip\Intime\Entity\SetterGetter;

class SetterGetter
{
    private $propertyValue;

    public function __construct(array $propertyValue)
    {
        $this->propertyValue = $propertyValue;
    }
}
