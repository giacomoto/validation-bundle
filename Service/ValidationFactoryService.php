<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle\Service;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ValidationFactoryService
{
    public function __construct(
        protected Security $security,
        protected ParameterBagInterface $parameterBag,
    )
    {
    }

    public function getConstraints(string $validatorClass)
    {
        return (new $validatorClass($this->security, $this->parameterBag))->getConstraints();
    }
}
