<?php

namespace App\Tests\Domain\Services;

use Domain\Repositories\CurrenciesCollectionInterface;
use Domain\Repositories\CurrencyCoursesProviderInterface;
use Domain\ValueObjects\Currency;
use Domain\ValueObjects\CurrencyCourse;

class CurrencyCoursesProvider implements CurrencyCoursesProviderInterface
{

    /**
     * @var CurrencyCourse[]
     */
    private $courses = [];

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
