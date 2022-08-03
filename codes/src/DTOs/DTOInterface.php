<?php

declare(strict_types=1);

namespace Commission\Calculation\DTOs;

interface DTOInterface
{
    /**
     * To validate a DTO
     *
     * @return boolean
     */
    public function validate(): bool;
}
