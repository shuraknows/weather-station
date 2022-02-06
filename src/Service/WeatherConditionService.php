<?php
declare(strict_types=1);

namespace App\Service;

use App\Dao\WeatherConditionDao;
use App\Dto\WeatherConditionDto;
use DateTimeInterface;

final class WeatherConditionService
{
    private WeatherConditionDao $conditionDao;

    public function __construct(WeatherConditionDao $conditionDao)
    {
        $this->conditionDao = $conditionDao;
    }

    public function weatherConditionForStation(int $stationId, DateTimeInterface $date): ?WeatherConditionDto
    {
        return $this->conditionDao->weatherCondition($stationId, $date);
    }

    public function averageWeatherConditionAtDate(DateTimeInterface $date): WeatherConditionDto
    {
        return $this->conditionDao->averageWeatherConditionAtDate($date);
    }

    public function lastAvailableDateTime(): ?DateTimeInterface
    {
        return $this->conditionDao->lastAvailableDateTime();
    }
}
