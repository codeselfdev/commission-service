<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Strategy;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Enums\OperationType;
use Commission\Calculation\Operations\Factory\UserTypeStrategyFactory;
use Commission\Calculation\Operations\OperationInterface;

final class WithdrawStrategy implements OperationStrategyInterface
{
    /**
     * User type wise strategy (private|business)
     *
     * @var UserTypeStrategyInterface
     */
    private UserTypeStrategyInterface $strategy;

    /**
     * Constructing withdraw strategy
     *
     * @param OperationInterface $operation
     * @param ConfigInterface $config
     */
    public function __construct(
        private OperationInterface $operation,
        private ConfigInterface $config
    ) {
        $this->setClientStrategy();
    }

    /**
     * Get operation value
     *
     * @return float
     */
    public function getAmountForCharge(): float
    {
        return $this->operation->getAmount();
    }

    /**
     * create and set user type wise strategy set
     *
     * @return void
     */
    public function setClientStrategy()
    {
        $user = $this->operation->getUser();

        $this->strategy = UserTypeStrategyFactory::create(
            $user->getUserType(),
            $this->config,
            $this->operation
            );
    }

    /**
     * Get commission fee from calculation on basis of defined strtegy
     *
     * @return float
     */
    public function getCommissionFee(): float
    {
        return $this->strategy->calculate();
    }

    /**
     * get operation type
     *
     * @return string
     */
    public function getType(): string
    {
        return (OperationType::withdraw)->val();
    }
}
