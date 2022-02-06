<?php
declare(strict_types=1);

namespace App\Transformer;

use App\Dto\WeatherConditionDto;
use JetBrains\PhpStorm\Pure;

final class WeatherConditionDtoToArrayTransformer
{
    #[Pure]
    public function transform(?WeatherConditionDto $dto): ?array
    {
        if (null === $dto) {
            return null;
        }

        return [
            'temperature' => $dto->getTemperature(),
            'humidity' => $dto->getHumidity(),
            'wind_speed' => $dto->getWindSpeed(),
        ];
    }
}