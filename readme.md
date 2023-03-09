# Luckyseven Validation Bundle
Luckyseven Validation Bundle uses Symfony's Validation bundle and Rolleworks PasswordStrenghValidator Bundle

## Update composer.json and register the repositories
```
{
    ...
    "repositories": [
        {"type": "git", "url":  "https://github.com/giacomoto/validation-bundle.git"}
    ],
    ...
    "extra": {
        "symfony": {
            ...
            "endpoint": [
                "https://api.github.com/repos/giacomoto/validation-recipes/contents/index.json",
                "flex://defaults"
            ]
        }
    }
}
```

## Make the repository trusted
```bash
git config --global --add safe.directory /var/www/html/vendor/luckyseven/validation
```

## Install
```
composer require symfony/orm-pack
composer require symfony/security-bundle

composer require luckyseven/validation:dev-main
composer recipes:install luckyseven/validation --force -v
```

## Usage
Create a Validator Constraints ex: ```Validation/CreateUserConstraint.php```
```php
<?php

namespace App\Validation\User;

use Luckyseven\Bundle\LuckysevenValidationBundle\Class\BaseConstraint;
use Luckyseven\Bundle\LuckysevenValidationBundle\Trait\EmailConstraintTrait;
use Luckyseven\Bundle\LuckysevenValidationBundle\Trait\PasswordConstraintTrait;
use Luckyseven\Bundle\LuckysevenValidationBundle\Trait\StringConstraintTrait;
use Symfony\Component\Validator\Constraints\Collection;

class CreateUserConstraint extends BaseConstraint
{
    use EmailConstraintTrait;
    use StringConstraintTrait;
    use PasswordConstraintTrait;

    public function getConstraints(): Collection
    {
        return new Collection([
            'email' => new Optional([
                ...$this->isTypeEmail(),
                ...$this->isUnique(User::class, 'email'),
            ]),
            'username' => [
                ...$this->isTypeString(),
                ...$this->isUnique(User::class, 'username'),
            ],
            'password' => $this->isTypePassword(),
            'lastName' => $this->isTypeString(),
            'firstName' => $this->isTypeString(),
        ]);
    }
}
```
Ex: ```Valiation?UpdateEmailContraint.php```
```php
<?php

namespace App\Validation\Auth;

use App\Entity\User;
use Luckyseven\Bundle\LuckysevenValidationBundle\Class\BaseConstraint;
use Luckyseven\Bundle\LuckysevenValidationBundle\Trait\TEmailConstraints;
use Luckyseven\Bundle\LuckysevenValidationBundle\Trait\TUniqueConstraints;
use Symfony\Component\Validator\Constraints\Collection;

class UpdateEmailConstraint extends BaseConstraint
{
    use TEmailConstraints;
    use TUniqueConstraints;

    public function getConstraints(): Collection
    {
        // access Security Bundle
        $user = $this->security->getUser();

        return new Collection([
            'email' => [
                ...$this->isTypeEmail(),
                ...$this->isUnique(User::class, 'email', [
                    // entity is the User array found all by email
                    "callback" => static fn($entity) => $entity->getId() != $user->getUserIdentifier()
                ])
            ]]);
    }
}
```
validate the Request body against the previously created validator.<br>
Ex: ```Controller/AuthController.php```
```php
<?php

namespace App\Controller;

use App\Validation\User\CreateUserConstraint;
use Luckyseven\Bundle\LuckysevenValidationBundle\Exception\ValidationException;
use Luckyseven\Bundle\LuckysevenValidationBundle\Service\ValidationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends AbstractController
{
    ...

    public function register(
        Request                     $request,
        ValidationService           $validationService,
    ): JsonResponse
    {
        $body = $request->toArray();

        if ($errors = $validationService->getErrors($body, CreateUserConstraint::class)) {
            // throw error
        }

        // create user
        ...
    }
}
```
