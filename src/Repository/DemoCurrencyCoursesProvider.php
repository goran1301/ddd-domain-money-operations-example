<?php

namespace App\Repository;

use Domain\Repositories\CurrenciesCollectionInterface;
use Domain\Repositories\CurrencyCoursesProviderInterface;
use Domain\ValueObjects\Currency;
use Domain\ValueObjects\CurrencyCourse;

/**
 * Class DemoCurrencyCoursesProvider
 * Provides current courses info for external service or database.
 *
 * @package App\Repository
 */
class DemoCurrencyCoursesProvider implements CurrencyCoursesProviderInterface
{
    /**
     * @var CurrencyCourse[]
     */
    private $courses = [];

    /**
     * DemoCurrencyCoursesProvider constructor.
     * @param CurrenciesCollectionInterface $currenciesCollection
     */
    public function __construct(CurrenciesCollectionInterface $currenciesCollection)
    {
        $this->courses[] = new CurrencyCourse(
            $currenciesCollection->getCurrency('RUB'),
            $currenciesCollection->getCurrency('USD'),
            '0.016'
        );
        $this->courses[] = new CurrencyCourse(
            $currenciesCollection->getCurrency('USD'),
            $currenciesCollection->getCurrency('RUB'),
            '62.5'
        );
    }

    /**
     * Particular course of $buy Currency in $sell Currency.
     * Returns null if no course for this currencies.
     *
     * @param Currency $sell selling currency
     * @param Currency $buy buying currency
     * @return CurrencyCourse|null
     */
    public function getCourse(Currency $sell, Currency $buy): ?CurrencyCourse
    {
        foreach ($this->courses as $course) {
            if ($course->isThisCourseFor($sell, $buy)) {
                return $course;
            }
        }
        return null;
    }
}
