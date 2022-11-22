<?php
namespace App\Service;

use App\Components\PersonNameConverterComponent;
use App\Strategy\Context;
use App\Strategy\OrderName;
use App\Strategy\OrderPhone;
use App\Decorators\UppercaseWritePersonDecorator;
use App\Entity\Person;
use App\Repository\DbPersonRepository;
use App\Repository\FilePersonRepository;
use App\Repository\PersonRepositoryInterface;
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

        $nameConverterComponent = new PersonNameConverterComponent($person);
        $uppercaseDecorator = new UppercaseWritePersonDecorator($nameConverterComponent);

        $person->setName($uppercaseDecorator->doAction());

        $repository->savePerson($person);
    }

    public function findAllUsers(PersonRepositoryInterface $repository): array
    {
        $data = $repository->readPeople();

        $strategy = new OrderPhone();
        $context = new Context($strategy);
        $context->setData($data);

        return $context->doOrdering();
    }

    public function findUser(FindUserRequest $data, PersonRepositoryInterface $repository): ?Person
    {
        return $repository->readPerson($data->name);
    }
}

