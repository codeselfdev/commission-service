<?php

namespace Commission\Calculation\Enums;

use Commission\Calculation\Traits\EnumToArray;

enum CurrencyName  {

    /**
     * To avail a function which return all enum cases
     */
    use EnumToArray;

    case EUR;
    case USD;
    case JPY;

    /**
     * Getting enum value as string
     *
     * @return string
     */
    public function val(): string
    {
        return match($this)
        {
            CurrencyName::EUR => 'EUR',
            CurrencyName::USD => 'USD',
            CurrencyName::JPY => 'JPY',
        };
    }
}