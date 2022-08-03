<?php

declare(strict_types=1);

namespace Commission\Calculation\Enums;

enum OperationType {
    /*
     * To avail a function which return all enum cases
     */

    case deposit;
    case withdraw;
    /**
     * Getting enum value as string.
     */
    public function val(): string
    {
        return match ($this) {
            OperationType::deposit => 'deposit',
            OperationType::withdraw => 'withdraw',
        };
    }
}
