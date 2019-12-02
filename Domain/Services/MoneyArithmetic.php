<?php

namespace Domain\Services;

use Domain\ValueObjects\Money;

/**
 * Class MoneyArithmetic
 * Provides calculations with money even if it's in different currencies.
 *
 * @package Domain\Services
 */
class MoneyArithmetic implements MoneyArithmeticInterface
{

    /**
     * Currencies converter
     *
     * @var CurrencyConverterInterface
     */
    protected $currencyConverter;

    /**
     * MoneyArithmetic constructor.
     * @param CurrencyConverterInterface $currencyConverter currencies converter
     */
    public function __construct(CurrencyConverterInterface $currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
    }

    /**
     * @param Money $purseValue
     * @param Money $arithmeticValue
     * @return Money
     * @throws NoCourseException
     */
    protected function getConverted(Money $purseValue, Money $arithmeticValue): Money
    {
        if ($purseValue->sameCurrency($arithmeticValue)) {
            return $arithmeticValue;
        }
        return $this->currencyConverter->convert($arithmeticValue, $purseValue->getCurrency());
    }

    /**
     * Adds $addingValue to $purse value.
     * Converts $addingValue in $purseValue currency if they are in different currencies.
     *
     * @param Money $purseValue
     * @param Money $addingValue
     * @throws NoCourseException
     * @return Money
     */
    public function add(Money $purseValue, Money $addingValue): Money
    {
        return $purseValue->add($this->getConverted($purseValue, $addingValue));
    }
}
