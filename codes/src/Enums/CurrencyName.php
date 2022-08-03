<?php

declare(strict_types=1);

namespace Commission\Calculation\Enums;

enum CurrencyName  {
    /*
     * To avail a function which return all enum cases
     */

    case EUR;
    case USD;
    case JPY;
    /**
     * Getting enum value as string.
     */
    public function val(): string
    {
        return match ($this) {
            CurrencyName::EUR => 'EUR',
            CurrencyName::USD => 'USD',
            CurrencyName::JPY => 'JPY',
        };
    }
}
