<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ChargeRecord;
use App\Entity\Invoice;
use App\Entity\Rate;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class InvoiceRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager, $manager->getClassMetadata(Invoice::class));
    }

    public function create(float $total, Rate $rate, ChargeRecord $chargeRecord): Invoice
    {
        $em = $this->getEntityManager();

        $invoice = new Invoice();
        $invoice->setTotal($total);
        $invoice->setRate($rate);
        $invoice->setChargeRecord($chargeRecord);

        $em->persist($invoice);
        $em->flush();

        return $invoice;
    }
}
