<?php

declare(strict_types=1);

namespace Commission\Calculation\Users\Repository;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Users\UserInterface;

interface UserRepositoryInterface
{
    /**
     * Searching user from repo by user id.
     */
    public function getUserByID(int $id): ?UserInterface;

    /**
     * Find or create new user to repo.
     */
    public function findOrNewUser(int $id, string $clientType, ConfigInterface $config): UserInterface;
}
