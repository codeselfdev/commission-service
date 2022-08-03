<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Factory;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Enums\UserType;
use Commission\Calculation\Operations\OperationInterface;
use Commission\Calculation\Operations\Strategy\PrivateStrategy;
use Commission\Calculation\Operations\Strategy\BusinessStrategy;
use Commission\Calculation\Operations\Strategy\UserTypeStrategyInterface;

class UserTypeStrategyFactory
{
    /**
     * Factory to create user type wise strategy
     *
     * @param string $type
     * @param ConfigInterface $config
     * @param OperationInterface $operation
     * @return UserTypeStrategyInterface
     */
    public static function create(
        string $type,
        ConfigInterface $config,
        OperationInterface $operation
    ): UserTypeStrategyInterface {
        if ($type === (UserType::private)->val()) {
            return new PrivateStrategy($operation, $config);
        }

        return new BusinessStrategy($operation, $config);
    }
}
