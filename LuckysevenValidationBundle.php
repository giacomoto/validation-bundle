<?php

namespace Luckyseven\Bundle\LuckysevenValidationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LuckysevenValidationBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
