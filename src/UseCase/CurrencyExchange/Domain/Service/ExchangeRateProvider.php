<?php

namespace App\UseCase\CurrencyExchange\Domain\Service;

use App\UseCase\Exchange\Domain\Entity\Currency;

interface ExchangeRateProvider
{
    public function getRate(Currency $fromCurrency, Currency $toCurrency): float;

}