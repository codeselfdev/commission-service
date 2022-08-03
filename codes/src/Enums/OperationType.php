<?php

namespace Commission\Calculation\Enums;

use Commission\Calculation\Traits\EnumToArray;

enum OperationType {

    /**
     * To avail a function which return all enum cases
     */
    use EnumToArray;

    case deposit;
    case withdraw;

    /**
     * Getting enum value as string
     *
     * @return string
     */
    public function val(): string
    {
        return match($this)
        {
            OperationType::deposit => 'deposit',
            OperationType::withdraw => 'withdraw',
        };
    }
}