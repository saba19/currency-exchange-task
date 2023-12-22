<?php

namespace App\UseCase\CurrencyExchange\Domain\Service;

class PurchaseCommissionProvider implements CommissionProvider
{
    public function get(): float
    {
        return 0.01;
    }

}