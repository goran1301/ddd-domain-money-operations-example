<?php

namespace Domain\Entity;

/**
 * Interface PurseOwnerInterface an entity of user purse provided for.
 *
 * @package Domain\Entity
 */
interface PurseOwnerInterface
{
    /**
     * Create new purse
     *
     * @param Purse $purse
     * @return mixed
     */
    public function createPurse(Purse $purse);

    /**
     * Get current purse
     *
     * @return Purse
     */
    public function getPurse(): Purse;
}
