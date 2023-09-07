<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RateRepository::class)]
class Rate
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name: "id", type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::FLOAT)]
    private float $energy;

    #[ORM\Column(type: Types::FLOAT)]
    private float $time;

    #[ORM\Column(type: Types::FLOAT)]
    private float $transaction;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEnergy(): float
    {
        return $this->energy;
    }

    public function setEnergy(float $energy): void
    {
        $this->energy = $energy;
    }

    public function getTime(): float
    {
        return $this->time;
    }

    public function setTime(float $time): void
    {
        $this->time = $time;
    }

    public function getTransaction(): float
    {
        return $this->transaction;
    }

    public function setTransaction(float $transaction): void
    {
        $this->transaction = $transaction;
    }
}
