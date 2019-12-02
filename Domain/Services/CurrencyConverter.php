<?php

namespace Domain\Services;

use Domain\Repositories\CurrencyCoursesProviderInterface;
use Domain\ValueObjects\Currency;
use Domain\ValueObjects\Money;

/**
 * Class CurrencyConverter
 * Converts a value of $sellingCurrency to $buyingCurrency via last actual CurrencyCourse.
 * Abstract implementation of CurrencyConverterInterface with CurrencyCoursesProviderInterface injected.
 *
 * @package Domain\Services
 */
abstract class CurrencyConverter implements CurrencyConverterInterface
{

    /**
     * @var CurrencyCoursesProviderInterface
     */
    protected $coursesProvider;

    /**
     * CurrencyConverter constructor.
     * @param CurrencyCoursesProviderInterface $coursesProvider
     */
    public function __construct(CurrencyCoursesProviderInterface $coursesProvider)
    {
        $this->coursesProvider = $coursesProvider;
    }

    /**
     * Converts a value of $sellingCurrency to $buyingCurrency via last actual CurrencyCourse.
     *
     * @param Money $sellingCurrency a value selling currency
     * @param Currency $buyingCurrency buying currency
     * @throws NoCourseException
     * @return Money
     */
    abstract public function convert(Money $sellingCurrency, Currency $buyingCurrency): Money;
}
