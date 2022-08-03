<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Strategy;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Enums\UserType;
use Commission\Calculation\Operations\OperationInterface;

final class BusinessStrategy implements UserTypeStrategyInterface
{
    /**
     * Constructing business strategy.
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
     * Get chargable value.
     */
    public function getFee(): float
    {
        return $this->operation->getAmount();
    }

    /**
     * Calculate commission fee.
     */
    public function calculate(): float
    {
        return ($this->config->getWithdrawBusinessCommission() * $this->getFee()) / 100;
    }

    /**
     * Get user's type.
     */
    public function getType(): string
    {
        return (UserType::business)->val();
    }
}
