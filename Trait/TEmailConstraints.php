<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Trait;

use Luckyseven\Bundle\LuckysevenValidationBundle\Validator\UniqueEmail;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

trait TEmailConstraints
{
    /**
     * @return array
     */
    protected function isTypeEmail(): array
    {
        return [
            new NotBlank(),
            new Length(['min' => 3, 'max' => 255]),
            new Email(),
        ];
    }
}
