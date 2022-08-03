<?php

declare(strict_types=1);

namespace Commission\Calculation\Traits;

use Commission\Calculation\Enums\CurrencyName;

trait Math
{
    /**
     * Rounding up a float value by 2 precision. For example, 0.023  should be rounded up to 0.03 .
     */
    public static function roundedUp(float $value, int $precision = 0): float
    {
        $tenToPrecisionPower = 10 ** $precision;

        return ceil($value * $tenToPrecisionPower) / $tenToPrecisionPower;
    }

    /**
     * getting all value by 2 decimal point.
     */
    public static function to2DecimalPoint(float $value): float
    {
        return sprintf('%.2f', $value);
    }

    /**
     * Currency formatting. As JPY have no decimal.
     */
    public static function currencyFormat(float $value, string $currency): string
    {
        if ($currency === (CurrencyName::JPY)->val()) {
            return (string) round($value);
        }

        return sprintf('%.2f', $value);
    }
}
