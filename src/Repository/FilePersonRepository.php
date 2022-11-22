<?php

namespace App\Repository;

use App\Components\PersonNameConverterComponent;
use App\Decorators\LowerCaseReadPersonDecorator;
use App\Entity\Person;

class FilePersonRepository implements PersonRepositoryInterface
{
    const FILENAME = 'people.txt';

    public function savePerson(Person $person): void
    {
        $data = $person->getName() . ',' . $person->getSurname() . ',' . $person->getPhone() . "\n";

        file_put_contents(self::FILENAME, $data, FILE_APPEND | LOCK_EX);
    }

    public function readPeople(): array
    {
        $data = file_get_contents(self::FILENAME);
        $collected = [];

        foreach (explode("\n", $data) as $line) {
            $exploded = explode(',', $line);

            $person = new Person();
            $person->setName($exploded[0]);
            $person->setSurname($exploded[1]);
            $person->setPhone($exploded[2]);

            $nameConverterComponent = new PersonNameConverterComponent($person);
            $lowercaseDecorator = new LowerCaseReadPersonDecorator($nameConverterComponent);
            $person->setName($lowercaseDecorator->doAction());

            $collected[] = $person;
        }

        return $collected;
    }

    public function readPerson(string $name): ?Person
    {
        $data = file_get_contents(self::FILENAME);

        foreach (explode("\n", $data) as $line) {
            $exploded = explode(',', $line);

            if (strtolower($exploded[0]) === strtolower($name)) {
                $person = new Person();
                $person->setName($exploded[0]);
                $person->setSurname($exploded[1]);
                $person->setPhone($exploded[2]);

                $decorator = new LowerCaseReadPersonDecorator($person);
                $person->setName($decorator->getName());

                return $person;
            }
        }

        return null;
    }
}
