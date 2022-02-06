<?php
declare(strict_types=1);

namespace App\Transformer;

use App\Converter\InchesToMillimetersConverter;
use App\Dto\ReportRowDto;

final class TypeTwoDataTransformer implements DataTransformerInterface
{
    private InchesToMillimetersConverter $inchesToMillimetersConverter;

    public function __construct(InchesToMillimetersConverter $inchesToMillimetersConverter)
    {
        $this->inchesToMillimetersConverter = $inchesToMillimetersConverter;
        //@todo implement and use other converters
    }

    public function transform(array $data): array
    {
        return array_map(fn ($dataRow): ReportRowDto => $this->transformRow($dataRow), $data);
    }

    private function transformRow(array $data): ReportRowDto
    {
        return new ReportRowDto(
            //@todo convert units of measure
            //@todo pass converted values to ReportRowDto object
        );
    }
}
