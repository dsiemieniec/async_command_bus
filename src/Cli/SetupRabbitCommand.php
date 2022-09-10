<?php

namespace App\Cli;

use App\Rabbit\RabbitManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'app:setup-rabbit',
    description: 'Declares configured queues, exchanges and bindings',
)]
class SetupRabbitCommand extends Command
{
    public function __construct(
        private RabbitManager $rabbitManager
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $this->rabbitManager->declareAll();
            $io->success('All declared');

            return Command::SUCCESS;
        } catch (Throwable $exception) {
            $io->error($exception->getMessage());
        }

        return Command::FAILURE;
    }
}
