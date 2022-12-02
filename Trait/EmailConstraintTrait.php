<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Trait;

use Luckyseven\Bundle\LuckysevenValidationBundle\Validator\UniqueEmail;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

trait EmailConstraintTrait
{
    /**
     * @param string|null $entity
     * @param array $notIn
     * @return array
     */
    protected function isTypeEmail(string $entity = null, array $notIn = []): array
    {
        $collection = [
            new NotBlank(),
            new Length(['min' => 3, 'max' => 255]),
            new Email(),
        ];
        if ($entity) {
            $collection[] = new UniqueEmail($entity, $notIn);
        }
        return $collection;
    }
}
