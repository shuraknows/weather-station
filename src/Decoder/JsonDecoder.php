<?php
declare(strict_types=1);

namespace App\Decoder;

final class JsonDecoder implements DecoderInterface
{
    public function decode(string $data): array
    {
        return json_decode($data);
    }
}
