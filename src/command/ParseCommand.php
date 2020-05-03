<?php

namespace App\Command;

use App\Command\Exception\ParserNotFoundException;
use App\Parser\Music\MuztorgParser;
use App\Parser\ParserInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseCommand extends Command
{
    protected static $defaultName = 'app:parse';
    private MuztorgParser $muztorgParser;
    private float $timer;

    public function __construct(MuztorgParser $muztorgParser)
    {
        $this->muztorgParser = $muztorgParser;
        parent::__construct();
    }

    protected function configure()
    {
        // TODO: сделать команду для вывод списка всез парсеров
        $this
            ->setDescription('Starts a parser.')
            ->setHelp('This command starts a parser. i.e. php parser.php app:parse muztorg')
            ->addArgument('parser', InputArgument::REQUIRED, 'The name. You can list all parser by app:parse:list');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parserName = $input->getArgument('parser');
        try {
            $this->startTimer();
            $parser = $this->getParser($parserName);
            $output->writeln("<info>Start parsing $parserName</info>");
            $parser->parse($output);
        } catch (ParserNotFoundException $e) {
            $output->writeln("<error>Parser $parserName not found</error>");
        }
        $time = $this->getTimerMins();
        $output->writeln("<info>Done $time mins</info>");

        return 0;
    }

    private function getParser(string $name): ParserInterface
    {
        // TODO: Первый грубый варинат. Нужно в дальнейшем выбирать все классы имплементирующие ParserInterface
        switch ($name) {
            case 'muztorg':
                return $this->muztorgParser;
            default:
                throw new ParserNotFoundException();
        }
    }

    private function startTimer(): void
    {
        $this->timer = microtime(true);
    }

    private function getTimerMins(): int
    {
        return round((microtime(true) - $this->timer) / 60);
    }
}
