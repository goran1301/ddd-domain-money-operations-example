<?php

namespace Domain\Services;

use Domain\ValueObjects\Currency;
use Domain\ValueObjects\CurrencyConvertException;
use Domain\ValueObjects\Money;

/**
 * Class SimpleCurrencyConverter
 * @package Domain\Services
 */
class SimpleCurrencyConverter extends CurrencyConverter
{

    /**
     * Converts a value of $sellingCurrency to $buyingCurrency via last actual CurrencyCourse.
     *
     * @param Money $sellingCurrency a value selling currency
     * @param Currency $buyingCurrency buying currency
     * @return Money
     * @throws NoCourseException if no CurrencyCourse to for exchange
     * @throws CurrencyConvertException if wrong CurrencyCourse to for exchange
     */
    public function convert(Money $sellingCurrency, Currency $buyingCurrency): Money
    {
        if ($sellingCurrency->getCurrency()->equals($buyingCurrency)) {
            return $sellingCurrency;
        }
        $course = $this->coursesProvider->getCourse($sellingCurrency->getCurrency(), $buyingCurrency);
        NoCourseException::throwIf($course === null);
        return $course->exchange($sellingCurrency);
    }
}
