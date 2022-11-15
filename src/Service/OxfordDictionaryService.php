<?php
namespace App\Service;

use App\Client\OxfordDictionaryClient;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class OxfordDictionaryService
{
    protected CacheInterface $cache;
    protected OxfordDictionaryClient $client;
    public array $env;

    const STUBS = [
        'test' => ['stubbed', 'jaja'],
    ];

    public function __construct(
        OxfordDictionaryClient $client,
        CacheInterface $cache,
        array $env,
    ) {
        $this->client = $client;
        $this->cache = $cache;
        $this->env = $env;
    }

    public function getWordDefinitions(string $word): array
    {
        return $this->cache->get(
            'def_' . $word,
            function (ItemInterface $item) use ($word) {
                $item->expiresAfter(3600);

                if ($this->env['offline_mode']) {
                    return self::STUBS[$word] ?? [];
                }

                try {
                    $request = $this->client->request('GET', 'words/en-gb?q=' . $word);
                    $response = $request
                        ->getBody()
                        ->getContents();
                    $response = json_decode($response);

                    return $response->results;
                } catch (GuzzleException) {
                    return [];
                }
            }
        );
    }
}
