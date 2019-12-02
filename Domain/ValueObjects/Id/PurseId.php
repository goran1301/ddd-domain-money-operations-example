<?php

namespace Domain\ValueObjects\Id;

/**
 * Class PurseId
 * Identity value object for purse
 *
 * @package Domain\ValueObjects\Id
 */
class PurseId
{
    /**
     * @var string|null basic id value in DB engine
     */
    private $value;

    /**
     * PurseId constructor.
     *
     * @param string|int|null $id basic id value in DB engine
     */
    public function __construct($id = null)
    {
        $this->value = $id;
    }

    /**
     * @return PurseId new empty id
     */
    public static function makeNew()
    {
        return new self();
    }

    /**
     * true if id is empty
     *
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->value === null;
    }

    /**
     * To string magic method.
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * Compare identities if they are not empty,
     * If empty - false
     *
     * @param PurseId $id another identity
     * @return bool
     */
    public function equals(self $id)
    {
        if ($this->isNew()) {
            return false;
        }
        return $this->value === $id->value;
    }
}
