<?php

namespace Commission\Calculation\Enums;

use Commission\Calculation\Traits\EnumToArray;

enum ClientType {

    use EnumToArray;

    case private;
    case business;
}