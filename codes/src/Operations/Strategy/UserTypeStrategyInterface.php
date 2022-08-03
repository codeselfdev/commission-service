<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Strategy;

interface UserTypeStrategyInterface
{
    /**
     * Calculation policy will be here
     *
     * @return float
     */
    public function calculate(): float;

    /**
     * Get operation value which is chargable by following rules
     *
     * @return float
     */
    public function getfee(): float;

    /**
     * Get strategy type
     *
     * @return string
     */
    public function getType(): string;
}
