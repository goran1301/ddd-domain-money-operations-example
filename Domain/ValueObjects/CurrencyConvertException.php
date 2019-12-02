<?php

namespace Domain\ValueObjects;

/**
 * Class CurrencyConvertException
 * if we can not do arithmetic with Money because of different currencies.
 *
 * @package Domain\ValueObjects
 */
class CurrencyConvertException extends \Exception
{
    /**
     * @param bool $condition
     * @param string|null $message
     * @throws CurrencyConvertException
     */
    public static function throwIf(bool $condition, ?string $message = null): void
    {
        if ($condition) {
            throw new CurrencyConvertException();
        }
    }
}
