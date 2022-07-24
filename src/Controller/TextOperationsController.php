<?php
namespace App\Controller;

use App\Request\TextOperationsRequest;
use App\Service\TextOperationsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/text', name: 'text_')]
class TextOperationsController extends AbstractController
{
    #[Route(path: '/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('text_operations/main.html.twig');
    }

    #[Route(path: '/', name: 'analyze', methods: ['POST'])]
    public function analyze(
        TextOperationsRequest $request,
        TextOperationsService $service,
    ): Response
    {
        $service->setText($request->text);

        return $this->render(
            'text_operations/result.html.twig',
            [
                'text' => $service->getText(),
                'characters_count' => $service->getCharactersCount(),
                'words_count' => $service->getWordsCount(),
                'sentences_count' => $service->getSentencesCount(),
                'characters_frequency' => $service->getCharactersFrequency(),
                'avg_word_length' => $service->avgWordLength(),
                'longest_words' => $service->longestWords(),
                'shortest_words' => $service->shortestWords(),
                'longest_sentences' => $service->longestSentences(),
                'shortest_sentences' => $service->shortestSentences(),
                'reversed_text' => $service->reverseText(),
                'reversed_words' => $service->reverseWords(),
                'processing_time' => $service->processingTime(),
            ]
        );
    }
}
