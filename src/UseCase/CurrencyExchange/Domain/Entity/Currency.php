<?php

namespace App\UseCase\CurrencyExchange\Domain\Entity;

enum Currency: string
{
    case EUR = 'EUR';
    case GBP = 'GBP';

}