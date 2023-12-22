<?php

namespace App\UseCase\CurrencyExchange\Domain\Exception;

use App\UseCase\CurrencyExchange\Domain\Entity\Currency;

final class MissingExchangeRateException extends DomainException
{
    public static function withCurrencies(Currency $fromCurrency, Currency $toCurrency): self
    {
        return new self(
            sprintf(
                'From currency %s to currency %s.',
                $fromCurrency->value,
                $toCurrency->value,
            )
        );
    }

}