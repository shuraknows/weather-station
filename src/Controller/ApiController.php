<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\WeatherConditionService;
use App\Transformer\WeatherConditionDtoToArrayTransformer;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api')]
class ApiController extends AbstractController
{
    private WeatherConditionDtoToArrayTransformer $transformer;
    private WeatherConditionService $weatherConditionService;

    public function __construct(
        WeatherConditionDtoToArrayTransformer $transformer,
        WeatherConditionService $weatherConditionService
    ) {
        $this->transformer = $transformer;
        $this->weatherConditionService = $weatherConditionService;
    }

    #[Route('/weather-condition/station/{stationId}/{dateTime}', name: 'api.weather-condition.station', methods: ['GET'])]
    public function weatherConditionForStation(int $stationId, string $dateTime): Response
    {
        //@todo nice to have some validation here and error handling

        return $this->json(
            [
                'success' => true,
                'data' => $this->transformer->transform(
                    $this->weatherConditionService->weatherConditionForStation($stationId, new DateTimeImmutable($dateTime))
                ),
            ]
        );
    }

    #[Route('/weather-condition/average/{dateTime}', name: 'api.weather-condition.average', methods: ['GET'])]
    public function averageTemperature(string $dateTime): Response
    {
        //@todo nice to have some validation here and error handling

        return $this->json(
            [
                'success' => true,
                'data' => $this->transformer->transform(
                    $this->weatherConditionService->averageWeatherConditionAtDate(new DateTimeImmutable($dateTime))
                ),
            ]
        );
    }

    #[Route('/weather-condition/last-available-datetime', name: 'api.last-available-datetime', methods: ['GET'])]
    public function lastAvailableDateTime(): Response
    {
        //@todo nice to have some validation here and error handling

        return $this->json(
            [
                'success' => true,
                'data' => [
                    'datetime' => $this->weatherConditionService->lastAvailableDateTime()->format('Y-m-d H:i:s')
                ]
            ]
        );
    }
}
