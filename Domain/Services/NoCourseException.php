<?php

namespace Domain\Services;

/**
 * Class NoCourseException
 * if we can't convert a value of Money to another Currency because we have no actual CurrencyCourse
 *
 * @package Domain\Services
 */
class NoCourseException extends \Exception
{
    /**
     * @param bool $condition
     * @param string|null $message
     * @throws NoCourseException
     */
    public static function throwIf(bool $condition, ?string $message = null): void
    {
        if ($condition) {
            throw new NoCourseException($message);
        }
    }
}
