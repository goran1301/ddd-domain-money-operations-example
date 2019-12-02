<?php

namespace App\Tests\Domain\Services;

use Domain\Repositories\CurrenciesCollectionInterface;
use Domain\ValueObjects\Currency;

class CurrenciesCollection implements CurrenciesCollectionInterface
{

    private $currencies = [];

    public function __construct()
    {
        $this->currencies['USD'] = new Currency('USD', 2);
        $this->currencies['RUB'] = new Currency('RUB', 2);
    }

    public function getCurrency(string $isoCode): ?Currency
    {
        return $this->currencies[$isoCode] ?? null;
    }

    /**
     * @return Currency[]
     */
    public function getAll(): iterable
    {
        return $this->currencies;
    }
}
