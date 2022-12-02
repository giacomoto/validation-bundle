<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    public string $entity;
    public array $notIn;

    public function __construct(string $entity, array $notIn = [], mixed $options = null, array $groups = null, mixed $payload = null)
    {
        $options["entity"] = $entity;
        $options["notIn"] = $notIn;

        parent::__construct($options, $groups, $payload);
    }

    public string $message = 'The email "{{ string }}" is already taken.';
    public string $mode = 'strict'; // If the constraint has configuration options, define them as public properties
}
