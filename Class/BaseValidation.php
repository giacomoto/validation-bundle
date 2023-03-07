<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Class;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

use Luckyseven\Bundle\LuckysevenValidationBundle\Interface\IValidationConstraints;

abstract class BaseValidation implements IValidationConstraints
{
    public function __construct(
        protected Security $security,
        protected ParameterBagInterface $parameterBag,
    )
    {
    }
}
