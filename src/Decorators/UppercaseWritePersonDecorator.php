<?php

namespace App\Decorators;

use App\Entity\Person;

class UppercaseWritePersonDecorator
{
    public function __construct(private Person $user)
    { }

    public function getName(): string
    {
        return strtoupper($this->user->getName());
    }
}
