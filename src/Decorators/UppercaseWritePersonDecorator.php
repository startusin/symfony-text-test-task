<?php

namespace App\Decorators;

class UppercaseWritePersonDecorator extends MainDecorator
{
    public function doAction(): string
    {
        return strtoupper(parent::doAction());
    }
}
