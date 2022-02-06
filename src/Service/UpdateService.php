<?php
declare(strict_types=1);

namespace App\Service;

use App\Dto\ReportRowDto;
use App\Entity\WeatherCondition;
use App\Entity\WeatherStation;
use App\Factory\WeatherConditionFactory;
use App\Repository\WeatherConditionRepository;
use App\Repository\WeatherStationReportProviderRepository;
use App\Repository\WeatherStationRepository;
use Psr\Log\LoggerInterface;
use RuntimeException;

final class UpdateService
{
    private WeatherStationRepository $weatherStationRepository;
    private WeatherStationReportProviderRepository $providerRepository;
    private WeatherConditionRepository $weatherConditionRepository;
    private WeatherConditionFactory $weatherConditionFactory;
    private LoggerInterface $logger;

    public function __construct(
        WeatherStationRepository $weatherStationRepository,
        WeatherStationReportProviderRepository $providerRepository,
        WeatherConditionRepository $weatherConditionRepository,
        WeatherConditionFactory $weatherConditionFactory,
        LoggerInterface $logger
    ) {
        $this->weatherStationRepository = $weatherStationRepository;
        $this->providerRepository = $providerRepository;
        $this->weatherConditionRepository = $weatherConditionRepository;
        $this->weatherConditionFactory = $weatherConditionFactory;
        $this->logger = $logger;
    }

    public function update(int $weatherStationId): void
    {
        $this->logger->info('Weather condition update: started', ['weather station' => $weatherStationId]);
        $weatherStation = $this->weatherStationRepository->find($weatherStationId);

        if (!$weatherStation instanceof WeatherStation) {
            throw new RuntimeException(sprintf('Weather station with id %d not found', $weatherStationId));
        }

        $reportProvider = $this->providerRepository->getByStationId($weatherStationId);

        $weatherConditions = array_map(
            fn (ReportRowDto $reportRow): WeatherCondition => $this->weatherConditionFactory->fromReportRowDto(
                $weatherStation,
                $reportRow
            ),
            $reportProvider->getWeatherStationReport()
        );

        $this->logger->info(
            'Weather condition update: got report',
            [
                'weather station' => $weatherStationId,
                'rows' => count($weatherConditions),
            ]
        );

        $this->weatherConditionRepository->add(...$weatherConditions);
        $this->weatherConditionRepository->save();
        $this->logger->info('Weather condition update: finished', ['weather station' => $weatherStationId]);
        /*
         * @todo it would be a nice to throw updateFinished event here,
         * to trigger some additional things like move/rename processed file
         */
    }
}
