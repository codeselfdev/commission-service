<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Factory;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Enums\OperationType;
use Commission\Calculation\Operations\Exception\WrongOperationTypeException;
use Commission\Calculation\Operations\OperationInterface;
use Commission\Calculation\Operations\Strategy\DepositStrategy;
use Commission\Calculation\Operations\Strategy\OperationStrategyInterface;
use Commission\Calculation\Operations\Strategy\WithdrawStrategy;

class OperationStrategyFactory
{
    /**
     * Factory to create operation type wise strategy
     *
     * @param ConfigInterface $config
     * @param OperationInterface $operation
     * @return OperationStrategyInterface
     */
    public static function create(
        ConfigInterface $config,
        OperationInterface $operation
    ): OperationStrategyInterface {
        if ($operation->getType() === (OperationType::deposit)->val()) {
            return new DepositStrategy($operation, $config);
        }

        return new WithdrawStrategy($operation, $config);
    }
}
