<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations;

use Commission\Calculation\Users\UserInterface;

interface OperationInterface
{
    /**
     * get operation type.
     */
    public function getType(): string;

    /**
     * Get operation transaction value in base currency.
     */
    public function getAmount(): float;

    /**
     * Get commission fee.
     */
    public function getCommissionFees(): float;

    /**
     * Get user instance of this operation.
     */
    public function getUser(): UserInterface;

    /**
     * Get date of operation.
     */
    public function getDate(): string;

    /**
     * Get previous operation of user.
     */
    public function getPrevious(): ?OperationInterface;
}
