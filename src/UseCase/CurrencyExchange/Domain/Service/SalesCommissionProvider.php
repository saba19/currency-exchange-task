<?php

namespace App\UseCase\CurrencyExchange\Domain\Service;

class SalesCommissionProvider implements CommissionProvider
{
    public function get(): float
    {
        return 0.01;
    }

}