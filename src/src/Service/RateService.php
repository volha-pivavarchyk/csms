<?php

declare(strict_types=1);

namespace App\Service;

use App\Helper\CalculationHelper;
use App\Repository\ChargeRecordRepository;
use App\Repository\InvoiceRepository;
use App\Repository\RateRepository;

class RateService
{
    public function __construct(
        private RateRepository $rateRepository,
        private ChargeRecordRepository $chargeRecordRepository,
        private InvoiceRepository $invoiceRepository
    ) {
    }

    /**
     * @param array<string, float> $rate
     * @param array<string, int|string> $chargeRecord
     *
     * @return  array<string, float|array<string, float>>
     */
    public function applyRate(array $rate, array $chargeRecord): array
    {
        $rateEntity = $this->rateRepository->create(
            $rate['energy'],
            $rate['time'],
            $rate['transaction']
        );

        $chargeRecordEntity = $this->chargeRecordRepository->create(
            $chargeRecord['meterStart'],
            $chargeRecord['timestampStart'],
            $chargeRecord['meterStop'],
            $chargeRecord['timestampStop']
        );

        $energy      = CalculationHelper::calculateEnergy($chargeRecord['meterStart'], $chargeRecord['meterStop'], $rate['energy']);
        $time        = CalculationHelper::calculateTime($chargeRecord['timestampStart'], $chargeRecord['timestampStop'], $rate['time']);
        $transaction = $rate['transaction'];

        $total       = round($energy + $time + $transaction, 2);

        $this->invoiceRepository->create(
            $total,
            $rateEntity,
            $chargeRecordEntity
        );

        return [
            'overall'    => $total,
            'components' => [
                'energy'      => $energy,
                'time'        => $time,
                'transaction' => $transaction,
            ],
        ];
    }
}