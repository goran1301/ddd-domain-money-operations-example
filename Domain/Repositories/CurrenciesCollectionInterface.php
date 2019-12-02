<?php

namespace Domain\Repositories;

use Domain\ValueObjects\Currency;

/**
 * Interface CurrenciesCollectionInterface
 * Provides all currencies in the system
 *
 * @package Domain\Repositories
 */
interface CurrenciesCollectionInterface
{
    /**
     * Get particular Currency object by ISO code.
     * Return Currency if exists or null.
     *
     * @param string $isoCode ISO code
     * @return Currency|null
     */
    public function getCurrency(string $isoCode): ?Currency;

    /**
     * all currencies in the system
     *
     * @return Currency[]
     */
    public function getAll(): iterable;
}
