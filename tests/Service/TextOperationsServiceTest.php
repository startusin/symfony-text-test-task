<?php
namespace App\Tests\Service;

use App\Service\TextOperationsService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TextOperationsServiceTest extends WebTestCase
{
    public function testSetText(): void
    {
        self::bootKernel();

        $phrase = 'testset';
        $container = static::getContainer();

        /* @var TextOperationsService $service */
        $service = $container->get(TextOperationsService::class);
        $service->setText($phrase);

        $this->assertEquals($phrase, $service->getText());
    }

    public function testGetCharactersCount(): void
    {
        self::bootKernel();

        $phrase = 'testphrase';
        $container = static::getContainer();

        /* @var TextOperationsService $service */
        $service = $container->get(TextOperationsService::class);
        $service->setText($phrase);

        $this->assertEquals(10, $service->getCharactersCount());
    }

    public function testGetWordsCount(): void
    {
        self::bootKernel();

        $phrase = 'test phrase';
        $container = static::getContainer();

        /* @var TextOperationsService $service */
        $service = $container->get(TextOperationsService::class);
        $service->setText($phrase);

        $this->assertEquals(2, $service->getWordsCount());
    }

    public function testGetSentencesCount(): void
    {
        self::bootKernel();

        $phrase = 'test phrase. test phrase two.';
        $container = static::getContainer();

        /* @var TextOperationsService $service */
        $service = $container->get(TextOperationsService::class);
        $service->setText($phrase);

        $this->assertEquals(2, $service->getSentencesCount());
    }

    public function testCharactersFrequency(): void
    {
        self::bootKernel();

        $phrase = 'test';
        $container = static::getContainer();

        /* @var TextOperationsService $service */
        $service = $container->get(TextOperationsService::class);
        $service->setText($phrase);

        $this->assertEquals("t:2:50% \ne:1:25% \ns:1:25% \n", $service->getCharactersFrequency());
    }

    public function testAvgWordLength(): void
    {
        self::bootKernel();

        $phrase = 'helloo test al';
        $container = static::getContainer();

        /* @var TextOperationsService $service */
        $service = $container->get(TextOperationsService::class);
        $service->setText($phrase);

        $this->assertEquals(4, $service->avgWordLength());
    }

    public function testLongestWords(): void
    {
        self::bootKernel();

        $phrase = 'test d ss dssdd dddd';
        $container = static::getContainer();

        /* @var TextOperationsService $service */
        $service = $container->get(TextOperationsService::class);
        $service->setText($phrase);

        $this->assertEquals('dssdd, test, dddd', $service->longestWords());
    }

    public function testShortestWords(): void
    {
        self::bootKernel();

        $phrase = 'tes d ss dssdd dddd';
        $container = static::getContainer();

        /* @var TextOperationsService $service */
        $service = $container->get(TextOperationsService::class);
        $service->setText($phrase);

        $this->assertEquals('d, ss, tes', $service->shortestWords());
    }

    public function testReverseText(): void
    {
        self::bootKernel();

        $phrase = 'epam';
        $container = static::getContainer();

        /* @var TextOperationsService $service */
        $service = $container->get(TextOperationsService::class);
        $service->setText($phrase);

        $this->assertEquals('mape', $service->reverseText());
    }

    public function testReverseWords(): void
    {
        self::bootKernel();

        $phrase = 'epam hello';
        $container = static::getContainer();

        /* @var TextOperationsService $service */
        $service = $container->get(TextOperationsService::class);
        $service->setText($phrase);

        $this->assertEquals('hello epam', $service->reverseWords());
    }
}
