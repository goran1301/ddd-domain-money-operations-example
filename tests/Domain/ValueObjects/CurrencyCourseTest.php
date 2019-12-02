<?php

namespace App\Tests\Domain\ValueObjects;

use Domain\ValueObjects\Currency;
use Domain\ValueObjects\CurrencyConvertException;
use Domain\ValueObjects\CurrencyCourse;
use PHPUnit\Framework\TestCase;

class CurrencyCourseTest extends TestCase
{
    /**
     * @covers \Domain\ValueObjects\CurrencyCourse::exchange
     */
    public function testConvert()
    {
        // 1 rub = 0.016 usd
        $rub = new Currency('RUB', 2);
        $usd = new Currency('USD', 2);
        $rubUsdCourse = new CurrencyCourse($rub, $usd, '0.016');
        $thousandRoubles = $rub->makeMoney('1000');
        $dollars = $rubUsdCourse->exchange($thousandRoubles);
        $this->assertTrue($dollars->getCurrency()->equals($usd), 'incorrect currency');
        $this->assertEquals('16.00', (string)$dollars, 'incorrect value');

        $throwed = false;
        $eur = new Currency('EUR', 2);
        $fiveEuros = $eur->makeMoney('5');
        try {
            $dollars = $rubUsdCourse->exchange($fiveEuros);
        } catch (CurrencyConvertException $exception) {
            $throwed = true;
        }
        $this->assertTrue($throwed, 'wrong currency for course converted');
    }
}
