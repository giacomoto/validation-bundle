<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Trait;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

trait StringConstraintTrait
{
    /**
     * @param int $maxLength
     * @param int $minLength
     * @return array
     */
    protected function isTypeString(int|null $maxLength = 255, int $minLength = 0): array
    {
        return [
            new NotBlank(),
            new Length(['min' => $minLength, 'max' => $maxLength]),
            new Type('string'),
        ];
    }
}
