<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Factory;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Users\UserInterface;
use Commission\Calculation\Operations\OperationInterface;
use Commission\Calculation\Operations\Operation;

class OperationFactory
{
    /**
     * Factory to create new operation
     *
     * @param string $date
     * @param string $type
     * @param float $amount
     * @param UserInterface $user
     * @param ConfigInterface $config
     * @return OperationInterface
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
