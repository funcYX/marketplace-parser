<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;

$application = new Application();

/** @var ContainerBuilder $container */
$container = include __DIR__.'/src/config/DI.php';

$application->add($container->get('parse_command'));

$application->run();
