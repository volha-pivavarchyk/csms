<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name: "id", type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::FLOAT)]
    private float $total;

    #[ManyToOne(targetEntity: Rate::class)]
    #[JoinColumn(name: 'rate_id', referencedColumnName: 'id')]
    private Rate $rate;

    #[ManyToOne(targetEntity: ChargeRecord::class)]
    #[JoinColumn(name: 'charge_record_id', referencedColumnName: 'id')]
    private ChargeRecord $chargeRecord;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function getRate(): Rate
    {
        return $this->rate;
    }

    public function setRate(Rate $rate): void
    {
        $this->rate = $rate;
    }

    public function getChargeRecord(): ChargeRecord
    {
        return $this->chargeRecord;
    }

    public function setChargeRecord(ChargeRecord $chargeRecord): void
    {
        $this->chargeRecord = $chargeRecord;
    }
}
