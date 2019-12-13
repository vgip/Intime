<?php

declare(strict_types=1);

namespace Vgip\Intime\Type\TypeInterface;

use Vgip\Intime\Type\Validator\ValidatorInterface\ValidatorInterface;

trait TypeTrait
{
    private $validator;

    public function getValidator() : ValidatorInterface
    {
        return $this->validator;
    }
}
