<?php
declare(strict_types=1);

namespace App\Converter;

final class InchesToMillimetersConverter
{
    private const MILLIMETERS_IN_INCH = 25.4;

    public function convert(float $inches): float
    {
        return $inches * self::MILLIMETERS_IN_INCH;
    }

    public function reverseConvert(float $millimeters): float
    {
        return $millimeters / self::MILLIMETERS_IN_INCH;
    }
}