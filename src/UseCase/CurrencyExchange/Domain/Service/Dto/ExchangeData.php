<?php

namespace App\UseCase\CurrencyExchange\Domain\Service\Dto;

use App\UseCase\CurrencyExchange\Domain\Entity\Currency;

readonly class ExchangeData
{
  private Currency $from;
  private Currency $to;
  private float $amount;

    public function __construct(Currency $from, Currency $to, float $amount)
    {
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
    }

    public function getFrom(): Currency
    {
        return $this->from;
    }

    public function getTo(): Currency
    {
        return $this->to;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

}