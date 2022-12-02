<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Trait;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

trait BoolConstraintTrait
{
    /**
     * @return array
     */
    public function isTypeBool(): array
    {
        return [
            new NotBlank(),
            new Type('bool'),
            new Choice([true, false]),
        ];
    }
}
