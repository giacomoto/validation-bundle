<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniqueEmailValidator extends ConstraintValidator
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueEmail) {
            throw new UnexpectedTypeException($constraint, UniqueEmail::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'string');

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }

        // access your configuration options like this:
        // if ('strict' === $constraint->mode) {
        //     // ...
        // }

        if ($constraint->entity) {
            $data = $this->entityManager->getRepository($constraint->entity)->findBy(['email' => $value]);
            foreach ($data as $datum) {
                if (!in_array($datum->getId(), $constraint->notIn)) {
                    $this->context->buildViolation($constraint->message)
                        ->setParameter('{{ string }}', $value)
                        ->addViolation();
                    break;
                }
            }
        }
    }
}
