<?php

use App\Command\ParseCommand;
use App\Http\HttpClient;
use App\Parser\Music\MuztorgParser;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

$containerBuilder = new ContainerBuilder();

$containerBuilder->register('http_client', HttpClient::class)
    ->addArgument(new \GuzzleHttp\Client());

// Parsers
$containerBuilder->register('muztorg_parser', MuztorgParser::class)
    ->addArgument(new Reference('http_client'));

// Command
$containerBuilder->register('parse_command', ParseCommand::class)
    ->addArgument(new Reference('muztorg_parser'));

return $containerBuilder;
