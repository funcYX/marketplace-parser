<?php

namespace App\Http;

use GuzzleHttp\Client;

class HttpClient implements HttpClientInterface
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $url): string
    {
        $page = $this->client->get($url);

        return $page->getBody()->getContents();
    }
}
