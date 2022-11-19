<?php

namespace App\Decorators;

use App\Entity\Person;

class LowerCaseReadPersonDecorator
{
    public function __construct(private Person $user)
    { }

    public function getName(): string
    {
        return strtolower($this->user->getName());
    }
}
