<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations;

use Commission\Calculation\Users\UserInterface;

interface OperationInterface
{
    /**
     * get operation type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get operation transaction value in base currency
     *
     * @return float
     */
    public function getAmount(): float;

    /**
     * Get commission fee
     *
     * @return float
     */
    public function getCommissionFees(): float;

    /**
     * Get user instance of this operation
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * Get date of operation
     *
     * @return string
     */
    public function getDate(): string;

    /**
     * Get previous operation of user
     *
     * @return OperationInterface|null
     */
    public function getPrevious(): ?OperationInterface;
}
