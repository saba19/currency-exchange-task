<?php

namespace App\UseCase\CurrencyExchange\Domain\Service\Dto;

use App\UseCase\CurrencyExchange\Domain\Entity\Currency;

class ExchangeData
{
  private readonly Currency $from;
  private readonly Currency $to;
  private readonly float $amount;

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