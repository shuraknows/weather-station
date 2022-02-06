<?php
declare(strict_types=1);

namespace App\Source;

interface SourceInterface
{
    public function getData(): string;
}
