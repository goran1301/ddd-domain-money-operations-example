<?php

namespace Domain\ValueObjects;

/**
 * Class Currency
 * Provides basic static currency info.
 *
 * @package Domain\ValueObjects
 */
class Currency
{
    /**
     * @var string ISO code
     */
    private $isoCode;

    /**
     * @var int number of decimal values allowed in currency
     */
    private $decimal;

    /**
     * @var Money provides one basic value of money of this Currency (1 USD for USD or 1 EUR for EUR, etc)
     */
    private $model;

    /**
     * Currency constructor.
     *
     * @param string $isoCode ISO code
     * @param int $decimal number of decimal values allowed in currency
     */
    public function __construct(string $isoCode, int $decimal)
    {
        $this->isoCode = $isoCode;
        $this->decimal = $decimal;
    }

    /**
     * @return int number of decimal values allowed in currency
     */
    public function getDecimal(): int
    {
        return $this->decimal;
    }

    /**
     * @return string ISO code value
     */
    public function __toString()
    {
        return $this->isoCode;
    }

    /**
     * ISO codes comparision.
     *
     * @param Currency $currency another currency
     * @return bool
     */
    public function equals(self $currency): bool
    {
        return $this->isoCode === $currency->isoCode;
    }

    /**
     * Multiplication with $amount of Money of them Currency
     *
     * @param Money $amount amount of Money of this currency
     * @param string $multiplier some number to multiply
     * @return Money
     */
    public function multiplyAmount(Money $amount, string $multiplier): Money
    {
        return new Money(bcmul($amount, $multiplier, $this->decimal), $amount->getCurrency());
    }

    /**
     * Adds $secondValue to $firstValue if they are same currency.
     *
     * @param Money $firstValue first value
     * @param Money $secondValue second value
     * @return Money
     * @throws CurrencyConvertException
     */
    public function add(Money $firstValue, Money $secondValue): Money
    {
        CurrencyConvertException::throwIf(!$firstValue->sameCurrency($secondValue));
        return new Money(bcadd($firstValue, $secondValue, $this->decimal), $this);
    }

    /**
     * Provides a new $amount of Money of this Currency
     *
     * @param string $amount
     * @return Money
     */
    public function makeMoney(string $amount): Money
    {
        return new Money($amount, $this);
    }

    /**
     * Provides a new empty amount of Money of this Currency
     *
     * @return Money
     */
    public function makeEmpty(): Money
    {
        return $this->makeMoney('0');
    }

    /**
     * Provides 1 amount of Money of this Currency
     *
     * @return Money
     */
    public function makeOne(): Money
    {
        $this->model = $this->model ?? $this->makeMoney('1');
        return $this->model;
    }
}
