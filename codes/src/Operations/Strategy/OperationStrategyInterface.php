<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Strategy;

interface OperationStrategyInterface
{
    /**
     * Amount to be charge.
     */
    public function getAmountForCharge(): float;

    /**
     * Get commission fee from user's strategy.
     */
    public function getCommissionFee(): float;

    /**
     * get user type.
     */
    public function getType(): string;
}
