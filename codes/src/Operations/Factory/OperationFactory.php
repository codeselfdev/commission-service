<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Factory;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Operations\Operation;
use Commission\Calculation\Operations\OperationInterface;
use Commission\Calculation\Users\UserInterface;

class OperationFactory
{
    /**
     * Factory to create new operation.
     */
    public static function create(
        string $date,
        string $type,
        float $amount,
        UserInterface $user,
        ConfigInterface $config
    ): OperationInterface {
        $operation = new Operation($date, $type, $amount, $user);

        $strategy = OperationStrategyFactory::create($config, $operation);

        return $operation->setStrategy($strategy);
    }
}
