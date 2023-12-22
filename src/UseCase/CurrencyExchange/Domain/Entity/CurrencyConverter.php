<?php

namespace App\UseCase\CurrencyExchange\Domain\Entity;

use App\UseCase\Exchange\Domain\Service\CommissionProvider;
use App\UseCase\Exchange\Domain\Service\Dto\ExchangeData;
use App\UseCase\Exchange\Domain\Service\ExchangeRateProvider;

class CurrencyConverter
{
    public function convert(
        ExchangeRateProvider $exchangeRateChecker,
        CommissionProvider $commissionProvider,
        ExchangeData $exchangeData,
    ): float{
        $rate = $exchangeRateChecker->getRate($exchangeData->getFrom(), $exchangeData->getTo());
        $amount = $exchangeData->getAmount() * $rate;
        $amountDeductedByCommission = $amount - ($amount * $commissionProvider->get());

        return round($amountDeductedByCommission,4);
    }


}