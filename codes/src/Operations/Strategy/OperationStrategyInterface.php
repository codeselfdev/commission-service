<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Strategy;

interface OperationStrategyInterface
{
    /**
     * Amount to be charge
     *
     * @return float
     */
    public function getAmountForCharge(): float;

    /**
     * Get commission fee from user's strategy
     *
     * @return float
     */
    public function getCommissionFee(): float;

    /**
     * get user type
     *
     * @return string
     */
    public function getType(): string;
}
