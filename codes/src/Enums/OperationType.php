<?php

namespace Commission\Calculation\Enums;

use Commission\Calculation\Traits\EnumToArray;

enum OperationType {

    use EnumToArray;

    case deposit;
    case withdraw;
}