<?php
namespace App\Controller;

use App\Repository\DbPersonRepository;
use App\Repository\FilePersonRepository;
use App\Request\FindUserRequest;
use App\Request\UserRequest;
use App\Service\UsersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/users', name: 'users_')]
class UsersController extends AbstractController
{
    #[Route(path: '/make/db', name: 'make_db', methods: ['POST'])]
    public function makeUserInDb(
        UsersService $service,
        UserRequest $request,
        DbPersonRepository $repository,
    ): Response
    {
        $service->makeUser($request, $repository);

        return $this->json(['status' => 'ok']);
    }

    #[Route(path: '/make/file', name: 'make_file', methods: ['POST'])]
    public function makeUserInFile(
        UsersService $service,
        UserRequest $request,
        FilePersonRepository $repository,
    ): Response
    {
        $service->makeUser($request, $repository);

        return $this->json(['status' => 'ok']);
    }

    #[Route(path: '/all/db', name: 'all_db', methods: ['GET'])]
    public function getAllUsersInDb(
        UsersService $service,
        DbPersonRepository $repository,
    ): Response
    {
        $users = $service->findAllUsers($repository);

        return $this->json(['users' => $users]);
    }

    #[Route(path: '/all/file', name: 'all_file', methods: ['GET'])]
    public function getAllUsersInFile(
        UsersService $service,
        FilePersonRepository $repository,
    ): Response
    {
        $users = $service->findAllUsers($repository);

        return $this->json(['users' => $users]);
    }

    #[Route(path: '/find/db', name: 'find_db', methods: ['POST'])]
    public function findUserInDb(
        UsersService $service,
        FindUserRequest $request,
        DbPersonRepository $repository,
    ): Response
    {
        $user = $service->findUser($request, $repository);

        return $this->json(['result' => $user]);
    }

    #[Route(path: '/find/file', name: 'find_file', methods: ['POST'])]
    public function findUserInFile(
        UsersService $service,
        FindUserRequest $request,
        FilePersonRepository $repository,
    ): Response
    {
        $user = $service->findUser($request, $repository);

        return $this->json(['result' => $user]);
    }
}
