<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\IpUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/foundation-demo')]
class FoundationDemoController extends AbstractController
{
    #[Route('/', name: 'foundation_demo_index', methods: ['GET'])]
    public function index(): Response
    {
        $ipv4 = '123.234.235.236';

        $response = new Response();
        $response->headers->setCookie(Cookie::create('test-sf', 'bar'));
        $response->setStatusCode(Response::HTTP_ACCEPTED);
        $response->setContent(json_encode([
            'data' => 123,
            'ip' => [
                'original' => $ipv4,
                'anonymous' => IpUtils::anonymize($ipv4),
            ],
        ]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
