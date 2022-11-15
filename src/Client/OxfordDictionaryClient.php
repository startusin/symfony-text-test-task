<?php
namespace App\Client;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class OxfordDictionaryClient extends GuzzleClient
{
    public LoggerInterface $logger;
    public array $env;

    public function __construct(
        LoggerInterface $logger,
        array $env,
        array $config,
    ) {
        $this->logger = $logger;
        $this->env = $env;

        parent::__construct($config);
    }

    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        $request = parent::request($method, $this->env['api_url'] . $uri, $options);

        $this->log('Logging OxfordDictionaryClient ...', [
            'url' => $this->env['api_url'] . $uri,
            'method' => $method,
            'options' => $options,
            'response' => [
                'headers' => $request->getHeaders(),
            ],
        ]);

        return $request;
    }

    protected function log(string $text, array $metaData): void
    {
        if ($this->env['api_logging']) {
            $this->logger->info($text, $metaData);
        }
    }
}
