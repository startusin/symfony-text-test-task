<?php

namespace App\Decorators;

class LowerCaseReadPersonDecorator extends MainDecorator
{
    public function doAction(): string
    {
        return strtolower(parent::doAction());
    }
}
