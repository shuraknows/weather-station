<?php
declare(strict_types=1);

namespace App\Repository;

use App\Provider\WeatherStationReportProvider;
use IteratorAggregate;
use RuntimeException;

final class WeatherStationReportProviderRepository
{
    private array $providers;

    public function __construct(IteratorAggregate $providers)
    {
        /** @var WeatherStationReportProvider $provider */
        foreach ($providers->getIterator() as $provider) {
            $this->providers[$provider->stationId()] = $provider;
        }
    }

    public function getByStationId(int $stationId): WeatherStationReportProvider
    {
        if (!isset($this->providers[$stationId])) {
            throw new RuntimeException(sprintf('Data provider for station %d is not configured', $stationId));
        }

        return $this->providers[$stationId];
    }
}
