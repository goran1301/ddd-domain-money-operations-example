<?php

namespace App\Tests\Domain\Services;

use Domain\Services\MoneyArithmetic;
use Domain\Services\SimpleCurrencyConverter;
use PHPUnit\Framework\TestCase;

class MoneyArithmeticTest extends TestCase
{
    /**
     * @covers \Domain\Services\MoneyArithmetic::add
     * @throws \Domain\Services\NoCourseException
     */
    public function testAdd()
    {
        $currenciesCollection = new CurrenciesCollection();
        $currencyCoursesProvider = new CurrencyCoursesProvider($currenciesCollection);
        $converter = new SimpleCurrencyConverter($currencyCoursesProvider);
        $moneyArithmetic = new MoneyArithmetic($converter);
        $thousandRoubles = $currenciesCollection->getCurrency('RUB')->makeMoney('1000');
        $oneDollar = $currenciesCollection->getCurrency('USD')->makeOne();
        $summ = $moneyArithmetic->add($oneDollar, $thousandRoubles);
        $this->assertEquals('17.00', $summ);
    }
}
