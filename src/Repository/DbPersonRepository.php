<?php

namespace App\Repository;

use App\Components\PersonNameConverterComponent;
use App\Decorators\LowerCaseReadPersonDecorator;
use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DbPersonRepository extends ServiceEntityRepository implements PersonRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    public function savePerson(Person $person): void
    {
        $this->getEntityManager()->persist($person);
        $this->getEntityManager()->flush();
    }

    public function readPeople(): array
    {
        return $this->findAll();
    }

    public function readPerson(string $name): ?Person
    {
        $query = $this->createQueryBuilder('p');

        if ($name) {
            $query
                ->where('p.name LIKE :name')
                ->setParameter(':name', '%' . $name . '%');
        }

        $person = $query->getQuery()->getResult();

        $nameConverterComponent = new PersonNameConverterComponent($person);
        $lowercaseDecorator = new LowerCaseReadPersonDecorator($nameConverterComponent);
        $person->setName($lowercaseDecorator->doAction());

        return $person;
    }
}
