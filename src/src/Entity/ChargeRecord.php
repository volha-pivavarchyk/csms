<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ChargeRecordRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChargeRecordRepository::class)]
class ChargeRecord
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name: "id", type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::INTEGER)]
    private int $meterStart;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeImmutable $timestampStart;

    #[ORM\Column(type: Types::INTEGER)]
    private int $meterStop;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeImmutable $timestampStop;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getMeterStart(): float
    {
        return $this->meterStart;
    }

    public function setMeterStart(int $meterStart): void
    {
        $this->meterStart = $meterStart;
    }

    public function getTimestampStart(): DateTimeImmutable
    {
        return $this->timestampStart;
    }

    public function setTimestampStart(DateTimeImmutable $timestampStart): void
    {
        $this->timestampStart = $timestampStart;
    }

    public function getMeterStop(): float
    {
        return $this->meterStop;
    }

    public function setMeterStop(int $meterStop): void
    {
        $this->meterStop = $meterStop;
    }

    public function getTimestampStop(): DateTimeImmutable
    {
        return $this->timestampStop;
    }

    public function setTimestampStop(DateTimeImmutable $timestampStop): void
    {
        $this->timestampStop = $timestampStop;
    }
}
