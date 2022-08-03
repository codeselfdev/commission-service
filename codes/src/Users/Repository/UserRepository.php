<?php

declare(strict_types=1);

namespace Commission\Calculation\Users\Repository;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Users\User;
use Commission\Calculation\Users\UserInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Saving all user to in memory
     *
     * @var UserInterface[]
     */
    protected array $users = [];

    /**
     * Searching user from repo by user id
     *
     * @param integer $id
     * @return UserInterface|null
     */
    public function getUserByID(int $id): ?UserInterface
    {
        if(isset($this->users[$id]))
        {
            return $this->users[$id];
        }

        return null;
    }

    /**
     *  Find or create new user to repo and back with user instance
     *
     * @param integer $id
     * @param string $clientType
     * @param ConfigInterface $config
     * @return UserInterface
     */
    public function findOrNewUser(int $id, string $clientType, ConfigInterface $config): UserInterface
    {
        $user = new User($id, $clientType, $config);

        if (!isset($this->users[$id]))
        {
            $this->users[$id] = $user;
        }

        return $this->users[$id];
    }
}
