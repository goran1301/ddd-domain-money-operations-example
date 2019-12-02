<?php

namespace Domain\ValueObjects;

/**
 * Class CurrencyCourse
 * Course of two currencies, allow to exchange selling to buying
 *
 * @package Domain\ValueObjects
 */
class CurrencyCourse
{
    /**
     * @var Currency currency which we have to sale
     */
    private $sellCurrency;

    /**
     * @var Currency currency which we have to buy
     */
    private $buyCurrency;

    /**
     * @var string course we need to multiply selling money to convert to buying currency
     */
    private $course;

    /**
     * CurrencyCourse constructor.
     * @param Currency $sellCurrency currency which we have to sale
     * @param Currency $buyCurrency currency which we have to buy
     * @param string $course course we need to multiply selling money to convert to buying currency
     */
    public function __construct(Currency $sellCurrency, Currency $buyCurrency, string $course)
    {
        $this->sellCurrency = $sellCurrency;
        $this->buyCurrency = $buyCurrency;
        $this->course = $course;
    }

    /**
     * @param Money $selling amount of money of sellingCurrency
     * @return Money
     * @throws CurrencyConvertException if $selling currency is different with $sellingCurrency
     */
    public function exchange(Money $selling): Money
    {
        CurrencyConvertException::throwIf(!$this->sellCurrency->makeOne()->sameCurrency($selling));
        return $this->buyCurrency->makeMoney($selling->multiply($this->course));
    }

    /**
     * Check is this currencyCourse actually for exchange $sell Currency to $buy Currency
     *
     * @param Currency $sell
     * @param Currency $buy
     * @return bool
     */
    public function isThisCourseFor(Currency $sell, Currency $buy): bool
    {
        return $this->sellCurrency->equals($sell) && $this->buyCurrency->equals($buy);
    }

    /**
     * course value
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->course;
    }
}
