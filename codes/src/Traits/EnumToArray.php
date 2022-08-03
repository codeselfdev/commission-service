<?php

namespace Commission\Calculation\Traits;

trait EnumToArray
{

  /**
   * Returning enum value by names
   *
   * @return array
   */
  public static function names(): array
  {
    return array_column(self::cases(), 'name');
  }

  /**
   * Returning enum values only
   *
   * @return array
   */
  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }

  /**
   * Returning all enum case's value in a array
   *
   * @return array
   */
  public static function array(): array
  {
    return array_combine(self::values(), self::names());
  }

}