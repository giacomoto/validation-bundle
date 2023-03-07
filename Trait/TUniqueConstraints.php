<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Trait;

use Luckyseven\Bundle\LuckysevenValidationBundle\Validator\UniqueConstraint;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

trait TUniqueConstraints
{
    /**
     * @param string|null $entity
     * @param string $fieldName
     * @param array $notIn
     * @return array
     */
    protected function isUnique(string $entity, string $fieldName, array $notIn = []): array
    {
        return [
            new UniqueConstraint($entity, $fieldName, $notIn)
        ];
    }
}
