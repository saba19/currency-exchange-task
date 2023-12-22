<?php

namespace App\UseCase\CurrencyExchange\Domain\Entity;

use App\UseCase\CurrencyExchange\Domain\Exception\CurrencyNotSupportedException;
use App\UseCase\CurrencyExchange\Domain\Exception\InsufficientBalance;
use App\UseCase\CurrencyExchange\Domain\Service\CommissionProvider;
use App\UseCase\CurrencyExchange\Domain\Service\Dto\ExchangeData;
use App\UseCase\CurrencyExchange\Domain\Service\ExchangeRateProvider;

readonly class Client
{
    //some extra code
    private string $id;

    private readonly string $name;

    private readonly Money $gbpBalance;

    private readonly Money $eurBalance;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->id = uniqid();
        $this->eurBalance = new Money(0, Currency::EUR);
        $this->gbpBalance = new Money(0, Currency::GBP);
    }

    /**
     * @throws InsufficientBalance
     * @throws CurrencyNotSupportedException
     */
    public function sell(
        CurrencyConverter $currencyConverter,
        ExchangeRateProvider $exchangeRateChecker,
        CommissionProvider $commissionProvider,
        Money $amountToSell,
        Currency $currencyToExchange
    ):void {
        $this->assertSufficientBalance($amountToSell);
        $convertedAmount = $currencyConverter->convert(
            $exchangeRateChecker,
            $commissionProvider,
            new ExchangeData($amountToSell->getCurrency(), $currencyToExchange, $amountToSell->getValue())
        );

        $this->addToBalance(new Money($convertedAmount, $currencyToExchange));
        $this->deductBalance($amountToSell);
    }

    public function addToEuroBalance(float $amount): void
    {
        $this->eurBalance->add(new Money($amount, Currency::EUR));
    }

    public function addToGbpBalance(float $amount): void
    {
        $this->gbpBalance->add(new Money($amount, Currency::GBP));
    }

    public function buy(
        CurrencyConverter $currencyConverter,
        ExchangeRateProvider $exchangeRateChecker,
        CommissionProvider $commissionProvider,
        Money $amountToBuy,
        Currency $currencyToExchange
    ):void {
        $this->assertSufficientBalance($amountToBuy);
        $convertedAmount = $currencyConverter->convert(
            $exchangeRateChecker,
            $commissionProvider,
            new ExchangeData($currencyToExchange, $amountToBuy->getCurrency(), $amountToBuy->getValue())
        );

        $this->addToBalance(new Money($convertedAmount, $currencyToExchange));
        $this->deductBalance($amountToBuy);
    }

    private function assertSufficientBalance(Money $amountToSell): void
    {
        if ($amountToSell->getCurrency() === Currency::GBP){
            $amountToSell > $this->gbpBalance ?? throw InsufficientBalance::withCurrency(Currency::GBP);
        }
        if ($amountToSell->getCurrency() === Currency::EUR){
                $amountToSell > $this->eurBalance ?? throw InsufficientBalance::withCurrency(Currency::EUR);
        }
    }

    private function addToBalance(Money $amount): void
    {
        $currency = $amount->getCurrency();

        if ($currency === Currency::GBP){
            $this->gbpBalance->add($amount);
            return;
        }

        if ($currency === Currency::EUR){
            $this->eurBalance->add($amount);
            return;
        }

        throw CurrencyNotSupportedException::withCurrency($currency);
    }

    private function deductBalance(Money $amount): void
    {
        $currency = $amount->getCurrency();

        if ($currency === Currency::GBP){
            $this->gbpBalance->deduct($amount);
            return;
        }

        if ($currency === Currency::EUR){
            $this->eurBalance->deduct($amount);
            return;
        }

        throw CurrencyNotSupportedException::withCurrency($currency);
    }

    public function getGbpBalance(): Money
    {
        return $this->gbpBalance;
    }

    public function getEurBalance(): Money
    {
        return $this->eurBalance;
    }

}