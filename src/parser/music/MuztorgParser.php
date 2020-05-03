<?php

namespace App\Parser\Music;

use App\Http\HttpClientInterface;
use App\Parser\ParserInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MuztorgParser implements ParserInterface
{
    private const HOST = 'https://www.muztorg.ru/';

    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function parse(OutputInterface $output)
    {
    }
}
