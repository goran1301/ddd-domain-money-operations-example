<?php

namespace App\Repository;

use Domain\Repositories\CurrenciesCollectionInterface;
use Domain\ValueObjects\Currency;

/**
 * Class DemoCurrenciesCollection
 * Provides all currencies in the system
 *
 * @package App\Repository
 */
class DemoCurrenciesCollection implements CurrenciesCollectionInterface
{
    /**
     * @var array all currencies in the system
     */
    private $currencies = [];

    /**
     * DemoCurrenciesCollection constructor.
     */
    public function __construct()
    {
        $this->currencies['USD'] = new Currency('USD', 2);
        $this->currencies['RUB'] = new Currency('RUB', 2);
    }

    /**
     * Get particular Currency object by ISO code.
     * Return Currency if exists or null.
     *
     * @param string $isoCode ISO code
     * @return Currency|null
     */
    public function getCurrency(string $isoCode): ?Currency
    {
        return $this->currencies[$isoCode] ?? null;
    }

    /**
     * All currencies in the system
     *
     * @return Currency[]
     */
    public function getAll(): iterable
    {
        return $this->currencies;
    }
}
