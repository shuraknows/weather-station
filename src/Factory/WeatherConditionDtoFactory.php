<?php
declare(strict_types=1);

namespace App\Factory;

use App\Dto\WeatherConditionDto;

final class WeatherConditionDtoFactory
{
    public static function fromArray(array $data): WeatherConditionDto
    {
        return new WeatherConditionDto(
            (float) $data['temperature'],
            (float) $data['humidity'],
            (float) $data['wind_speed']
        );
    }
}