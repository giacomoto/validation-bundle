<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Service;

class ValidationFactoryService
{
    public function getConstraints(string $validatorClass)
    {
        return (new $validatorClass())->getConstraints();
    }
}
