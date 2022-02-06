<?php
declare(strict_types=1);

namespace App\Decoder;

interface DecoderInterface
{
    public function decode(string $data): array;
}
