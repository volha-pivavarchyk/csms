<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Rate;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class RateRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager, $manager->getClassMetadata(Rate::class));
    }

    public function create(float $energy, float $time, float $transaction): Rate
    {
        $em = $this->getEntityManager();

        $rate = new Rate();
        $rate->setEnergy($energy);
        $rate->setTime($time);
        $rate->setTransaction($transaction);

        $em->persist($rate);
        $em->flush();

        return $rate;
    }
}
