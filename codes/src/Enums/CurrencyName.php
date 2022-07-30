<?php

namespace Commission\Calculation\Enums;

use Commission\Calculation\Traits\EnumToArray;

enum CurrencyName  {

    use EnumToArray;

    case EUR;
    case USD;
    case JPY;
}