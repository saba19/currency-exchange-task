<?php

namespace App\UseCase\CurrencyExchange\Domain\Exception;

use App\UseCase\CurrencyExchange\Domain\Entity\Currency;

final class InsufficientBalance extends DomainException
{
    public static function withCurrency(Currency $currency): self
    {
        return new self(
            sprintf(
                'Insufficient balance with currency %s.',
                $currency->value,
            )
        );
    }

}