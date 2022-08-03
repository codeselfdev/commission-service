<?php

declare(strict_types=1);

namespace Commission\Calculation\Users;

use Commission\Calculation\Operations\OperationInterface;

interface UserInterface
{
    /**
     * For getting user id.
     */
    public function getID(): int;

    /**
     * get user type.
     */
    public function getUserType(): string;

    /**
     * Adding operation to a user operation list.
     */
    public function addTransaction(OperationInterface $operation): void;

    /**
     * get remaining weekly transaction quota which is free (sum bellow 1000 EURO).
     */
    public function getWeeklyTransactionQuota(): int;

    /**
     * get previous free total weekly transaction (total <= free amount) if exceeded 1000 then exceeded amount will be charged.
     */
    public function getWeeklyTransactionSum(): float;

    /**
     * Get user's last operation.
     */
    public function getLastOperation(): ?OperationInterface;

    /**
     * Summing weekly transaction amount.
     */
    public function addWeeklyTransactionAmount(float $weeklyTransactedAmount): void;

    /**
     * Setting weekly transaction amount.
     */
    public function setWeeklyTransactionAmount(float $weeklyTransactedAmount): void;

    /**
     * Setting remaining weekly transaction quota.
     */
    public function setWeeklyTransactionQuota(int $weeklyTransactedQuota): void;

    /**
     * Setting remaining weekly transaction quota. Quota will be reduced by 1 after every transaction.
     */
    public function removeWeeklyTransactionQuota(): void;

    /**
     * Resetting remaing Quota to 0.
     */
    public function resetWeeklyTransactionQuota(): void;
}
