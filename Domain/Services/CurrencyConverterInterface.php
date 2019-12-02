<?php

namespace Domain\Services;

use Domain\ValueObjects\Currency;
use Domain\ValueObjects\Money;

/**
 * Interface CurrencyConverterInterface.
 * Converts a value of $sellingCurrency to $buyingCurrency via last actual CurrencyCourse.
 *
 * @package Domain\Services
 */
interface CurrencyConverterInterface
{
    /**
     * Converts a value of $sellingCurrency to $buyingCurrency via last actual CurrencyCourse.
     *
     * @param Money $sellingCurrency a value selling currency
     * @param Currency $buyingCurrency buying currency
     * @throws NoCourseException
     * @return Money
     */
    public function convert(Money $sellingCurrency, Currency $buyingCurrency): Money;
}
