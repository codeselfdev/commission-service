<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Strategy;

interface UserTypeStrategyInterface
{
    /**
     * Calculation policy will be here.
     */
    public function calculate(): float;

    /**
     * Get operation value which is chargable by following rules.
     */
    public function getfee(): float;

    /**
     * Get strategy type.
     */
    public function getType(): string;
}
