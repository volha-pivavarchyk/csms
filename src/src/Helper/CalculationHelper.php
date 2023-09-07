<?php

declare(strict_types=1);

namespace App\Helper;

class CalculationHelper
{
    public static function calculateEnergy(int $meterStart, int $meterStop, float $rate): float
    {
        $kWt   = ($meterStop - $meterStart) / 1000;
        $price = $kWt * $rate;

        return round($price, 3);
    }

    public static function calculateTime(string $timestampStart, string $timestampStop, float $rate): float
    {
        $price = (DateHelper::getMinutesBetweenDates($timestampStart, $timestampStop) / 60) * $rate;

        return round($price, 3);
    }
}