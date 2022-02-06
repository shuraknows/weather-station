<?php
declare(strict_types=1);

namespace App\Transformer;

use App\Dto\ReportRowDto;

interface DataTransformerInterface
{
    /**
     * @return ReportRowDto[]
     */
    public function transform(array $data): array;
}
