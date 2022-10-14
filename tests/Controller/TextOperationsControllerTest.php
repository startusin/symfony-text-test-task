<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TextOperationsControllerTest extends WebTestCase
{
    public function testMainPageExists(): void
    {
        $client = static::createClient();
        $client->request('GET', '/text/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Type word to analyze:');
    }

    public function testAnalyzeEmpty(): void
    {
        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/text/');

        $this->assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
