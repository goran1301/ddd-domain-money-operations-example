<?php

namespace App\Tests\Domain\ValueObjects;

use Domain\ValueObjects\Currency;
use Domain\ValueObjects\CurrencyConvertException;
use Domain\ValueObjects\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testCreate()
    {
        $money = new Money('0', new Currency('USD', 2));
        $this->assertEquals('0.00', (string)$money, 'incorrect creation');
    }

    /**
     * @covers \Domain\ValueObjects\Money::add
     */
    public function testAdd()
    {
        $usdCurrency = new Currency('USD', 2);
        $rubCurrency = new Currency('RUB', 2);
        $money = new Money('2', $usdCurrency);
        $additionalMoney = new Money('3', $usdCurrency);
        $summ = $money->add($additionalMoney);
        $this->assertEquals('5.00', (string)$summ, 'incorrect summ');

        $throwed = false;
        try {
            $money->add($rubCurrency->makeMoney('10'));
        } catch (CurrencyConvertException $exception) {
            $throwed = true;
        }

        $this->assertTrue($throwed, 'an add operation between different currencies');
    }

    /**
     * @covers \Domain\ValueObjects\Money::multiply
     */
    public function testMultiply()
    {
        $usdCurrency = new Currency('USD', 2);
        $money = new Money('2', $usdCurrency);
        $result = $money->multiply('2');
        $this->assertEquals('4.00', (string)$result, 'incorrect multiplication');
    }
}
