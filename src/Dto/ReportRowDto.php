<?php
declare(strict_types=1);

namespace App\Dto;

use DateTimeInterface;

final class ReportRowDto
{
    private DateTimeInterface $dateTime;
    private float $temperature;
    private float $humidity;
    private float $rain;
    private float $windSpeed;
    private int $batteryLevel;

    public function __construct(
        DateTimeInterface $dateTime,
        float $temperature,
        float $humidity,
        float $rain,
        float $windSpeed,
        int $batteryLevel
    ) {
        $this->dateTime = $dateTime;
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->rain = $rain;
        $this->windSpeed = $windSpeed;
        $this->batteryLevel = $batteryLevel;
    }

    public function getDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getHumidity(): float
    {
        return $this->humidity;
    }

    public function getRain(): float
    {
        return $this->rain;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }

    public function getBatteryLevel(): int
    {
        return $this->batteryLevel;
    }
}
