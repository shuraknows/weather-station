<?php
declare(strict_types=1);

namespace App\Dto;

final class WeatherConditionDto
{
    private float $temperature;
    private float $humidity;
    private float $windSpeed;

    public function __construct(float $temperature, float $humidity, float $windSpeed)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->windSpeed = $windSpeed;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getHumidity(): float
    {
        return $this->humidity;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }
}