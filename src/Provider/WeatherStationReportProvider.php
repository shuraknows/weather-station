<?php
declare(strict_types=1);

namespace App\Provider;

use App\Transformer\DataTransformerInterface;
use App\Decoder\DecoderInterface;
use App\Dto\ReportRowDto;
use App\Source\SourceInterface;

final class WeatherStationReportProvider
{
    private int $stationId;
    private SourceInterface $source;
    private DecoderInterface $decoder;
    private DataTransformerInterface $transformer;

    public function __construct(
        int $stationId,
        SourceInterface $source,
        DecoderInterface $decoder,
        DataTransformerInterface $transformer
    ) {
        $this->stationId = $stationId;
        $this->source = $source;
        $this->decoder = $decoder;
        $this->transformer = $transformer;
    }

    public function stationId(): int
    {
        return $this->stationId;
    }

    /**
     * @return ReportRowDto[]
     */
    public function getWeatherStationReport(): array
    {
        $rawData = $this->source->getData();

        return $this->transformer->transform($this->decoder->decode($rawData));
    }
}
