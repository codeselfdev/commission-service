<?php

declare(strict_types=1);

namespace Commission\Calculation\Enums;

enum UserType
{
    /*
     * To avail a function which return all enum cases
     */

    case private;
    case business;
    /**
     * To get value from enum.
     */
    public function val(): string
    {
        return match ($this) {
            UserType::private => 'private',
            UserType::business => 'business',
        };
    }
}
