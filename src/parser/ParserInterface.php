<?php

namespace App\Parser;

use Symfony\Component\Console\Output\OutputInterface;

interface ParserInterface
{
    public function parse(OutputInterface $output);
}
