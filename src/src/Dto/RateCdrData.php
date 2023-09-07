<?php

declare(strict_types=1);

namespace App\Dto;

final class RateCdrData
{

    public function __construct(private array $rate, private array $cdr)
    {

    }

    public function getRate(): array
    {
        return $this->rate;
    }

    public function getCdr(): array
    {
        return $this->cdr;
    }
}
