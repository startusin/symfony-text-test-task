<?php

namespace App\Repository;

use App\Entity\Person;

interface PersonRepositoryInterface
{
    public function savePerson(Person $person): void;

    public function readPeople(): array;

    public function readPerson(string $name): ?Person;
}
