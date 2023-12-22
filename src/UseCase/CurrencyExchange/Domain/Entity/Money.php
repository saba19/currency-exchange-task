<?php

namespace App\UseCase\CurrencyExchange\Domain\Entity;

use App\UseCase\CurrencyExchange\Domain\Exception\CurrencyMismatchException;

class Money
{
    private float $value;

    private Currency $currency;

    public function __construct(float $value, Currency $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    /** @throws CurrencyMismatchException */
    public function add(Money $money): void
    {
        $this->assertCurrencyIsCompatible($money->currency);

        $this->value += $money->value;
    }

    public function deduct(Money $money): void
    {
        $this->assertCurrencyIsCompatible($money->currency);

        $this->value -= $money->value;
    }

    /** @throws CurrencyMismatchException */
    private function assertCurrencyIsCompatible(Currency $currency)
    {
        if (false === ($currency === $this->currency)){
            throw CurrencyMismatchException::withCurrency($currency);
        }
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getValue(): float
    {
        return  round($this->value,4);
    }

}