<?php

namespace Commission\Calculation\Traits;

use Commission\Calculation\Enums\CurrencyName;

trait Math
{

  /**
   * Rounding up a float value by 2 precision. For example, 0.023  should be rounded up to 0.03 .
   *
   * @param float $value
   * @param integer $precision
   * @return float
   */
  public static function roundedUp(float $value, int $precision = 0): float
  {
      $tenToPrecisionPower = 10 ** $precision;
      return ceil($value * $tenToPrecisionPower) / $tenToPrecisionPower;
  }

  /**
   * getting all value by 2 decimal point
   *
   * @param float $value
   * @return float
   */
  public static function to2DecimalPoint(float $value): float
  {
    return sprintf('%.2f', $value);
  }

  /**
   * Currency formatting. As JPY have no decimal.
   *
   * @param float $value
   * @param string $currency
   * @return string
   */
  public static function currencyFormat(float $value, string $currency): string
  {
    if ($currency == (CurrencyName::JPY)->val()) {
      return round($value);
    }

    return sprintf('%.2f', $value);
  }
}
