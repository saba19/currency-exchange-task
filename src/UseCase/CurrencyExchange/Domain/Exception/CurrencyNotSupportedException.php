<?php

namespace App\UseCase\CurrencyExchange\Domain\Exception;

use App\UseCase\CurrencyExchange\Domain\Entity\Currency;

final class CurrencyNotSupportedException extends DomainException
{
    public static function withCurrency(Currency $currency): self
    {
        return new self(
            sprintf(
                'Currency %s is not supported.',
                $currency->value,
            )
        );
    }

}