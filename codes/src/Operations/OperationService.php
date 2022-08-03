<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Operations\Factory\OperationFactory;
use Commission\Calculation\Users\UserInterface;

class OperationService implements OperationServiceInterface
{
    /**
     * Construction with dependant service.
     *
     * @param ConfigInterface $config
     */
    public function __construct(
        private ConfigInterface $config
    ) {
    }

    /**
     * Call for creating a operation
     * Attaching newly created operation to belonging user.
     */
    public function addNew(
        string $type,
        float $amount,
        string $date,
        UserInterface $user
    ): OperationInterface {
        $operation = OperationFactory::create(
            $date,
            $type,
            (float) $amount,
            $user,
            $this->config
        );

        $user->addTransaction($operation);

        return $operation;
    }
}
