<?php

declare(strict_types=1);

namespace App\Helper;

class DateHelper
{
    public static function getMinutesBetweenDates(string $dateStart, string $dateStop): float
    {
        $start = strtotime($dateStart);
        $end   = strtotime($dateStop);

        return floor(($end - $start) / 60);
    }
}