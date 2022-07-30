<?php

declare(strict_types=1);

namespace Commission\Calculation\DTOs;

interface DTOInterface
{
    public function validate(): bool;
}
