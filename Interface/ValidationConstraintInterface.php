<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Interface;

use Symfony\Component\Validator\Constraints\Collection;

interface ValidationConstraintInterface
{
    public function getConstraints(): Collection;
}
