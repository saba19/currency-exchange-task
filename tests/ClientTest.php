<?php

namespace App\Tests;

use App\UseCase\CurrencyExchange\Domain\Entity\Client;
use App\UseCase\CurrencyExchange\Domain\Entity\Currency;
use App\UseCase\CurrencyExchange\Domain\Entity\CurrencyConverter;
use App\UseCase\CurrencyExchange\Domain\Entity\Money;
use App\UseCase\CurrencyExchange\Domain\Service\DefaultExchangeRateProvider;
use App\UseCase\CurrencyExchange\Domain\Service\SalesCommissionProvider;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testClientSellEuroForGbp()
    {
        $client = new Client('Santa Claus');
        $currencyConverter = new CurrencyConverter();
        $exchangeRateChecker = new DefaultExchangeRateProvider();
        $commissionProvider = new SalesCommissionProvider();

        $client->addToEuroBalance(105.40);
        $client->sell(
            $currencyConverter,
            $exchangeRateChecker,
            $commissionProvider,
            new Money(100, Currency::EUR),
            Currency::GBP)
        ;

        $this->assertEquals(155.2122, $client->getGbpBalance()->getValue());
        $this->assertEquals(5.40, $client->getEurBalance()->getValue());
    }
    public function testClientBuyGbpWithEuro()
    {
        $client = new Client('Rudolph');
        $currencyConverter = new CurrencyConverter();
        $exchangeRateChecker = new DefaultExchangeRateProvider();
        $commissionProvider = new SalesCommissionProvider();

        $client->addToEuroBalance(115.40);
        $client->sell(
            $currencyConverter,
            $exchangeRateChecker,
            $commissionProvider,
            new Money(100, Currency::EUR),
            Currency::GBP)
        ;

        $this->assertEquals(155.2122, $client->getGbpBalance()->getValue());
        $this->assertEquals(15.40, $client->getEurBalance()->getValue());
    }

    public function testClientSellGbpForEuro()
    {
        $client = new Client('Poppy');
        $currencyConverter = new CurrencyConverter();
        $exchangeRateChecker = new DefaultExchangeRateProvider();
        $commissionProvider = new SalesCommissionProvider();

        $client->addToGbpBalance(200.40);
        $client->sell(
            $currencyConverter,
            $exchangeRateChecker,
            $commissionProvider,
            new Money(100, Currency::GBP),
            Currency::EUR)
        ;

        $this->assertEquals(152.7768, $client->getEurBalance()->getValue());
        $this->assertEquals(100.40, $client->getGbpBalance()->getValue());
    }
    public function testClientBuyEuroWithGbp()
    {
        $client = new Client('The Grinch');
        $currencyConverter = new CurrencyConverter();
        $exchangeRateChecker = new DefaultExchangeRateProvider();
        $commissionProvider = new SalesCommissionProvider();

        $client->addToGbpBalance(300.15);
        $client->sell(
            $currencyConverter,
            $exchangeRateChecker,
            $commissionProvider,
            new Money(100, Currency::GBP),
            Currency::EUR)
        ;

        $this->assertEquals(152.7768, $client->getEurBalance()->getValue());
        $this->assertEquals(200.15, $client->getGbpBalance()->getValue());
    }

}