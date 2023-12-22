<?php

namespace App\Tests;

use App\UseCase\CurrencyExchange\Domain\Entity\Currency;
use App\UseCase\CurrencyExchange\Domain\Entity\CurrencyConverter;
use App\UseCase\CurrencyExchange\Domain\Service\DefaultExchangeRateProvider;
use App\UseCase\CurrencyExchange\Domain\Service\Dto\ExchangeData;
use App\UseCase\CurrencyExchange\Domain\Service\PurchaseCommissionProvider;
use App\UseCase\CurrencyExchange\Domain\Service\SalesCommissionProvider;
use PHPUnit\Framework\TestCase;

class CurrencyConverterTest extends TestCase
{
    public function testSellEuroForGbp()
    {
        $currencyConverter = new CurrencyConverter();
        $exchangeRateChecker = new DefaultExchangeRateProvider();
        $commissionProvider = new SalesCommissionProvider();
        $exchangeData = new ExchangeData(Currency::EUR, Currency::GBP, 100);
        $convertedAmountWithCommission = $currencyConverter->convert($exchangeRateChecker, $commissionProvider, $exchangeData);

        $this->assertEquals(155.2122, $convertedAmountWithCommission);
    }

    public function testBuyGbpWithEuro()
    {
        $currencyConverter = new CurrencyConverter();
        $exchangeRateChecker = new DefaultExchangeRateProvider();
        $commissionProvider = new PurchaseCommissionProvider();
        $exchangeData = new ExchangeData(Currency::EUR, Currency::GBP, 100);
        $convertedAmountWithCommission = $currencyConverter->convert($exchangeRateChecker, $commissionProvider, $exchangeData);

        $this->assertEquals(155.2122, $convertedAmountWithCommission);
    }

    public function testSellGbpForEuro()
    {
        $currencyConverter = new CurrencyConverter();
        $exchangeRateChecker = new DefaultExchangeRateProvider();
        $commissionProvider = new SalesCommissionProvider();
        $exchangeData = new ExchangeData(Currency::GBP, Currency::EUR, 100);
        $convertedAmountWithCommission = $currencyConverter->convert($exchangeRateChecker, $commissionProvider, $exchangeData);

        $this->assertEquals(152.7768, $convertedAmountWithCommission);
    }

    public function testBuyEuroWithGbp()
    {
        $currencyConverter = new CurrencyConverter();
        $exchangeRateChecker = new DefaultExchangeRateProvider();
        $commissionProvider = new PurchaseCommissionProvider();
        $exchangeData = new ExchangeData(Currency::GBP, Currency::EUR, 100);
        $convertedAmountWithCommission = $currencyConverter->convert($exchangeRateChecker, $commissionProvider, $exchangeData);

        $this->assertEquals(152.7768, $convertedAmountWithCommission);
    }

}