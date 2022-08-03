<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Strategy;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Enums\OperationType;
use Commission\Calculation\Operations\OperationInterface;

final class DepositStrategy implements OperationStrategyInterface
{
    /**
     * Constructing diposit strategy.
     *
     * @param OperationInterface $operation
     * @param ConfigInterface    $config
     */
    public function __construct(
        private OperationInterface $operation,
        private ConfigInterface $config
    ) {
    }

    /**
     * Get chargable amount.
     */
    public function getAmountForCharge(): float
    {
        return $this->operation->getAmount();
    }

    /**
     * Calculate commission fee.
     */
    public function getCommissionFee(): float
    {
        return ($this->config->getDepositCommission() * $this->getAmountForCharge()) / 100;
    }

    /**
     * Get operation type.
     */
    public function getType(): string
    {
        return (OperationType::deposit)->val();
    }
}
