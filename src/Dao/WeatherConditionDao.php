<?php
declare(strict_types=1);

namespace App\Dao;

use App\Dto\WeatherConditionDto;
use App\Factory\WeatherConditionDtoFactory;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\DBAL\Connection;

final class WeatherConditionDao
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function weatherCondition(int $stationId, DateTimeInterface $date): ?WeatherConditionDto
    {
        $result = $this->connection->createQueryBuilder()
            ->select('temperature, humidity, wind_speed')
            ->from('weather_condition', 'c')
            ->where('c.weather_station_id = :stationId')
            ->andWhere('c.date_time >= :dateFrom')
            ->andWhere('c.date_time <= :dateTo')
            ->setParameter('stationId', $stationId)
            ->setParameter('dateFrom', $date->format('Y-m-d 00:00:00'))
            ->setParameter('dateTo', $date->format('Y-m-d 23:59:59'))
            ->executeQuery()
            ->fetchAssociative();

        return $result ? WeatherConditionDtoFactory::fromArray($result) : null;
    }

    public function averageWeatherConditionAtDate(DateTimeInterface $date): WeatherConditionDto
    {
        $result = $this->connection->createQueryBuilder()
            ->select('AVG(temperature) AS temperature, AVG(humidity) AS humidity, AVG(wind_speed) AS wind_speed')
            ->from('weather_condition', 'c')
            ->where('c.date_time >= :dateFrom')
            ->andWhere('c.date_time <= :dateTo')
            ->setParameter('dateFrom', $date->format('Y-m-d 00:00:00'))
            ->setParameter('dateTo', $date->format('Y-m-d 23:59:59'))
            ->executeQuery()
            ->fetchAssociative();

        return WeatherConditionDtoFactory::fromArray($result);
    }

    public function lastAvailableDateTime(): ?DateTimeInterface
    {
        $result = $this->connection->createQueryBuilder()
            ->select('MAX(date_time)')
            ->from('weather_condition', 'c')
            ->executeQuery()
            ->fetchOne();

        return $result ? new DateTimeImmutable($result) : null;
    }
}