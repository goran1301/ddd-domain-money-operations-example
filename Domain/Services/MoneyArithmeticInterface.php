<?php

namespace Domain\Services;

use Domain\ValueObjects\Money;

/**
 * Interface MoneyArithmeticInterface
 * Provides calculations with money even if it's in different currencies.
 *
 * @package Domain\Services
 */
interface MoneyArithmeticInterface
{
    /**
     * Adds $addingValue to $purse value.
     * Converts $addingValue in $purseValue currency if they are in different currencies.
     *
     * @param Money $purseValue
     * @param Money $addingValue
     * @throws NoCourseException
     * @return Money
     */
    public function add(Money $purseValue, Money $addingValue): Money;
}
