<?php

namespace Domain\Repositories;

use Domain\ValueObjects\Currency;
use Domain\ValueObjects\CurrencyCourse;

/**
 * Interface CurrencyCoursesProviderInterface
 * Provides current courses info for external service or database.
 *
 * @package Domain\Repositories
 */
interface CurrencyCoursesProviderInterface
{
    /**
     * Particular course of $buy Currency in $sell Currency.
     * Returns null if no course for this currencies.
     *
     * @param Currency $sell selling currency
     * @param Currency $buy buying currency
     * @return CurrencyCourse|null
     */
    public function getCourse(Currency $sell, Currency $buy): ?CurrencyCourse;
}
