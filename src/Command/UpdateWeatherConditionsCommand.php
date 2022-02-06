<?php

namespace App\Command;

use App\Service\UpdateService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(
    name: 'app:update-weather-conditions',
    description: 'Add a short description for your command',
)]
class UpdateWeatherConditionsCommand extends Command
{
    private UpdateService $updateService;
    private LoggerInterface $logger;

    public function __construct(UpdateService $updateService, LoggerInterface $logger)
    {
        parent::__construct();

        $this->logger = $logger;
        $this->updateService = $updateService;
    }

    protected function configure(): void
    {
        $this->addArgument('stationId', InputArgument::REQUIRED, 'Argument description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->updateService->update($input->getArgument('stationId'));
        } catch (Throwable $exception) {
            $this->logger->info(
                'Weather condition update: failed',
                [
                    'exception' => get_class($exception),
                    'exceptionMessage' => $exception->getMessage(),
                    'trace' => $exception->getTrace(),
                ]
            );
        }

        return Command::SUCCESS;
    }
}
