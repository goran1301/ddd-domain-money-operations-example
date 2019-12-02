<?php

namespace Domain\ValueObjects;

/**
 * Class Money
 * Provides money value and basic logic with it
 *
 * @package Domain\ValueObjects
 */
class Money
{
    /**
     * @var string amount|value of money
     */
    private $amount;

    /**
     * @var Currency currency of this money
     */
    private $currency;

    /**
     * Money constructor.
     * @param string $amount amount|value of money
     * @param Currency $currency currency of this money
     */
    public function __construct(string $amount, Currency $currency)
    {
        $this->amount = bcadd($amount, '0', $currency->getDecimal());
        $this->currency = $currency;
    }

    /**
     * Currency of this money
     *
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * Checks is $this has the same amount and currency with given $money
     *
     * @param Money $money
     * @return bool
     */
    public function equals(self $money): bool
    {
        return $this->currency->equals($money->currency) && $this->amount === $money->amount;
    }

    /**
     * Check is this has the same currency with $money
     *
     * @param Money $money
     * @return bool
     */
    public function sameCurrency(self $money)
    {
        return $this->currency->equals($money->currency);
    }

    /**
     * Provide a multiplied value by $number
     *
     * @param string $number multiplier
     * @return Money new value of Money
     */
    public function multiply(string $number): self
    {
        return $this->currency->multiplyAmount($this, $number);
    }

    /**
     * Adds $money to $this
     *
     * @param Money $money adding value of Money
     * @return Money
     * @throws CurrencyConvertException if not the same currencies
     */
    public function add(Money $money): Money
    {
        return $this->currency->add($this, $money);
    }

    /**
     * @return string amount
     */
    public function __toString()
    {
        return $this->amount;
    }
}
