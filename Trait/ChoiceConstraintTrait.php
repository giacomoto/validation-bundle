<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Trait;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;

trait ChoiceConstraintTrait
{
    /**
     * @param array $choices
     * @return array
     */
    public function isTypeChoice(array $choices): array
    {
        return [
            new NotBlank(),
            new Choice($choices),
        ];
    }
}
