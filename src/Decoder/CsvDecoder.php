<?php
declare(strict_types=1);

namespace App\Decoder;

final class CsvDecoder implements DecoderInterface
{
    public function decode(string $data): array
    {
        $lines = explode( "\n", $data);
        $headers = str_getcsv(array_shift($lines));
        $decodedData = [];

        foreach ($lines as $line) {
            $row = [];

            foreach (str_getcsv($line) as $key => $field)
            {
                $row[$headers[$key]] = $field;
            }

            $row = array_filter($row);
            $decodedData[] = $row;
        }

        return $decodedData;
    }
}
