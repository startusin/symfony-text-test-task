<?php
namespace App\Service;

use App\Entity\Person;
use App\Repository\DbPersonRepository;
use App\Repository\FilePersonRepository;
use App\Repository\PersonRepositoryInterface;
use App\Repository\UserRepository;
use App\Request\FindUserRequest;
use App\Request\UserRequest;

class UsersService
{
    public function __construct(
        protected DbPersonRepository $dbRepository,
        protected FilePersonRepository $fileRepository,
    ) {}

    public function makeUser(UserRequest $data, PersonRepositoryInterface $repository): void
    {
        $person = new Person();
        $person->setName($data->name);
        $person->setSurname($data->surname);
        $person->setPhone($data->phone);

        $repository->savePerson($person);
    }

    public function findAllUsers(PersonRepositoryInterface $repository): array
    {
        return $repository->readPeople();
    }

    public function findUser(FindUserRequest $data, PersonRepositoryInterface $repository): ?Person
    {
        return $repository->readPerson($data->name);
    }
}

