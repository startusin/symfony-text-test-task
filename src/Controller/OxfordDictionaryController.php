<?php

namespace App\Controller;

use App\Service\OxfordDictionaryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/od-demo')]
class OxfordDictionaryController extends AbstractController
{
    #[Route('/', name: 'od_demo_index', methods: ['GET'])]
    public function index(Request $request, OxfordDictionaryService $odService): Response
    {
        $word = $request->query->get('word');
        $wordDefinitions = $odService->getWordDefinitions($word);

        $response = new Response();
        $response->setContent(json_encode([
            'definitions' => $wordDefinitions,
        ]));

        return $response;
    }
}
