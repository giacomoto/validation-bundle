<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Trait;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Rollerworks\Component\PasswordStrength\Validator\Constraints as RollerworksPassword;

trait PasswordConstraintTrait
{
    /**
     * @param int $maxLength
     * @param int $minLength
     * @return array
     */
    protected function isTypePassword(int $maxLength = 255, int $minLength = 0): array
    {
        return [
            new NotBlank(),
            new Length(['min' => $minLength, 'max' => $maxLength]),
            new Type('string'),
            new RollerworksPassword\PasswordStrength([
                'minLength' => $minLength,
                'minStrength' => 5
            ]),
            new RollerworksPassword\PasswordRequirements([
                'minLength' => $minLength,
                'requireCaseDiff' => false,
                'requireLetters' => true,
                'requireNumbers' => true,
                'requireSpecialCharacter' => true
            ])
        ];
    }
}
