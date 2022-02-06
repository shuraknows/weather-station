<?php

namespace App\Entity;

use App\Repository\WeatherConditionRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherConditionRepository::class)]
#[ORM\Index(name: "datetime_idx", columns: ["date_time"])]
class WeatherCondition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: WeatherStation::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $weatherStation;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $dateTime;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2)]
    private float $temperature;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private float $humidity;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2)]
    private float $rain;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2)]
    private float $windSpeed;

    #[ORM\Column(type: 'integer')]
    private int $batteryLevel;

    public function __construct(
        WeatherStation $weatherStation,
        DateTimeInterface $dateTime,
        float $temperature,
        float $humidity,
        float $rain,
        float $windSpeed,
        int $batteryLevel
    ) {
        $this->weatherStation = $weatherStation;
        $this->dateTime = $dateTime;
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->rain = $rain;
        $this->windSpeed = $windSpeed;
        $this->batteryLevel = $batteryLevel;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeatherStation(): ?WeatherStation
    {
        return $this->weatherStation;
    }

    public function getDateTime(): ?DateTimeInterface
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
