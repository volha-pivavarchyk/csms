<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ChargeRecord;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ChargeRecordRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager, $manager->getClassMetadata(ChargeRecord::class));
    }

    public function create(int $meterStart, string $timestampStart, int $meterStop, string $timestampStop): ChargeRecord
    {
        $em = $this->getEntityManager();

        $chargeRecord = new ChargeRecord();
        $chargeRecord->setMeterStart($meterStart);
        $chargeRecord->setTimestampStart(new DateTimeImmutable($timestampStart));
        $chargeRecord->setMeterStop($meterStop);
        $chargeRecord->setTimestampStop(new DateTimeImmutable($timestampStop));

        $em->persist($chargeRecord);
        $em->flush();

        return $chargeRecord;
    }
}
