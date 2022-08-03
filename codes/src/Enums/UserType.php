<?php

namespace Commission\Calculation\Enums;

use Commission\Calculation\Traits\EnumToArray;

enum UserType
{
    /**
     * To avail a function which return all enum cases
     */
    use EnumToArray;

    case private;
    case business;

    /**
     * To get value from enum
     *
     * @return string
     */
    public function val(): string
    {
        return match($this)
        {
            UserType::private => 'private',
            UserType::business => 'business',
        };
    }
}