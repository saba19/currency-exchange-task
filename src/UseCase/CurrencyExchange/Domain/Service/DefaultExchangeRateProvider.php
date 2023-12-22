<?php

namespace App\UseCase\CurrencyExchange\Domain\Service;

use App\UseCase\Exchange\Domain\Entity\Currency;
use App\UseCase\Exchange\Domain\Exception\MissingExchangeRateException;

class DefaultExchangeRateProvider implements ExchangeRateProvider
{

    /** @throws MissingExchangeRateException */
    public function getRate(Currency $fromCurrency, Currency $toCurrency): float
    {
        return match (true) {
            $fromCurrency === Currency::EUR && $toCurrency == Currency::GBP => 1.5678,
            $fromCurrency === Currency::GBP && $toCurrency == Currency::EUR => 1.5432,
            default => throw MissingExchangeRateException::withCurrencies($fromCurrency, $toCurrency),
        };
    }
}