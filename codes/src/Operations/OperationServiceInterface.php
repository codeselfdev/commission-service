<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations;

use Commission\Calculation\Users\UserInterface;

interface OperationServiceInterface
{
    /**
     * Create new operation by service.
     */
    public function addNew(
        string $type,
        float $amount,
        string $date,
        UserInterface $user
    ): OperationInterface;
}
