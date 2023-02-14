<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Interface;

use Symfony\Component\Validator\Constraints\Collection;

interface IValidationConstraints
{
    public function getConstraints(): Collection;
}
