<?php
namespace App\Components;

use App\Entity\Person;

class PersonNameConverterComponent implements StringComponentInterface
{
    public function __construct(private Person $person)
    {}

    public function doAction(): string
    {
        return $this->person->getName();
    }
}
