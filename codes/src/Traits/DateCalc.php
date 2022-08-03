<?php

declare(strict_types=1);

namespace Commission\Calculation\Traits;

trait DateCalc
{
    /**
     * Get day no of a week.
     */
    public function getDayNo(string $date): int
    {
        return (int) date('w', strtotime($date)) - 1;
    }

    /**
     * Get previous monday from a date.
     */
    public function getWeekStartDate(string $date): string
    {
        $day = $this->getDayNo($date);

        return date('Y-m-d', strtotime('-'.$day.' days', strtotime($date)));
    }

    /**
     * Get Nearest sunday from a date.
     */
    public function getWeekEndDate(string $date): string
    {
        $day = $this->getDayNo($date);

        return date('Y-m-d', strtotime('+'.(6 - $day).' days', strtotime($date)));
    }

    /**
     * Check if a date belongs to a same week or not.
     */
    public function isDateBetweenWeek(string $previousDate, string $date): bool
    {
        if (($date >= $this->getWeekStartDate($previousDate)) && ($date <= $this->getWeekEndDate($previousDate))) {
            return true;
        }

        return false;
    }
}
