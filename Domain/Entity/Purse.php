<?php

namespace Domain\Entity;

use Domain\ValueObjects\Currency;
use Domain\ValueObjects\Id\PurseId;
use Domain\ValueObjects\Money;

/**
 * Class Purse
 * Used to store purse of owner with balance and provide it
 * @package Domain\Entity
 */
class Purse
{

    /**
     * An identity
     *
     * @var PurseId
     */
    private $id;

    /**
     * Money's amount on the balance
     *
     * @var Money
     */
    private $balance;

    /**
     * @var PurseOwnerInterface
     */
    private $owner;

    /**
     * @var \DateTime
     */
    private $lastUpdate;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * Purse constructor.
     *
     * @param PurseOwnerInterface $owner an owner of purse.
     * @param PurseId $id unique Id.
     * @param Money $money start balance
     * @throws \Exception
     */
    public function __construct(PurseOwnerInterface $owner, PurseId $id, Money $money)
    {
        $this->id = $id;
        $this->owner = $owner;
        $this->balance = $money;
        $this->created = new \DateTime();
        $this->lastUpdate = $this->created;
    }

    /**
     * @return Money current balance value.
     */
    public function getBalance(): Money
    {
        return $this->balance;
    }

    /**
     * New purse for $owner with $money at balance
     *
     * @param PurseOwnerInterface $owner owner entity
     * @param Money $money balance value
     * @return static
     * @throws \Exception
     */
    public static function createNew(PurseOwnerInterface $owner, Money $money): self
    {
        return new self($owner, PurseId::makeNew(), $money);
    }

    /**
     * New empty purse of $currency for $owner
     * @param PurseOwnerInterface $owner owner entity
     * @param Currency $currency currency of purse
     * @return static
     * @throws \Exception
     */
    public static function createNewEmpty(PurseOwnerInterface $owner, Currency $currency): self
    {
        return self::createNew($owner, new Money('0', $currency));
    }
}
