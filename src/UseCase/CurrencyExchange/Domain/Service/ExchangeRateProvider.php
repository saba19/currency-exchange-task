<?php

namespace App\UseCase\CurrencyExchange\Domain\Service;

use App\UseCase\CurrencyExchange\Domain\Entity\Currency;

interface ExchangeRateProvider
{
    public function getRate(Currency $fromCurrency, Currency $toCurrency): float;

}