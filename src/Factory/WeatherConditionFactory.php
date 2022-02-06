<?php
declare(strict_types=1);

namespace App\Factory;

use App\Dto\ReportRowDto;
use App\Entity\WeatherCondition;
use App\Entity\WeatherStation;
use JetBrains\PhpStorm\Pure;

final class WeatherConditionFactory
{
    #[Pure]
    public function fromReportRowDto(WeatherStation $weatherStation, ReportRowDto $reportRowDto): WeatherCondition
    {
        return new WeatherCondition(
            $weatherStation,
            $reportRowDto->getDateTime(),
            $reportRowDto->getTemperature(),
            $reportRowDto->getHumidity(),
            $reportRowDto->getRain(),
            $reportRowDto->getWindSpeed(),
            $reportRowDto->getBatteryLevel()
        );
    }
}