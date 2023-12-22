<?php

namespace App\UseCase\CurrencyExchange\Domain\Exception;

use App\UseCase\CurrencyExchange\Domain\Entity\Currency;

final class CurrencyMismatchException extends DomainException
{
    public static function withCurrency(Currency $currency): self
    {
        return new self(
            sprintf(
                'Currency mismatch for %s.',
                $currency->value,
            )
        );
    }

}