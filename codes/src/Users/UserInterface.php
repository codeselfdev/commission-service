<?php

declare(strict_types=1);

namespace Commission\Calculation\Users;

use Commission\Calculation\Operations\OperationInterface;

interface UserInterface
{
    /**
     * For getting user id
     *
     * @return integer
     */
    public function getID(): int;

    /**
     * get user type
     *
     * @return string
     */
    public function getUserType(): string;

    /**
     * Adding operation to a user operation list
     *
     * @param OperationInterface $operation
     * @return void
     */
    public function addTransaction(OperationInterface $operation): void;

    /**
     * get remaining weekly transaction quota which is free (sum bellow 1000 EURO)
     *
     * @return integer
     */
    public function getWeeklyTransactionQuota(): int;

    /**
     * get previous free total weekly transaction (total <= free amount) if exceeded 1000 then exceeded amount will be charged
     *
     * @return float
     */
    public function getWeeklyTransactionSum(): float;

    /**
     * Get user's last operation
     *
     * @return OperationInterface|null
     */
    public function getLastOperation(): ?OperationInterface;

    /**
     * Summing weekly transaction amount
     *
     * @param float $weeklyTransactedAmount
     * @return void
     */
    public function addWeeklyTransactionAmount(float $weeklyTransactedAmount): void;

    /**
     * Setting weekly transaction amount
     *
     * @param float $weeklyTransactedAmount
     * @return void
     */
    public function setWeeklyTransactionAmount(float $weeklyTransactedAmount): void;

    /**
     * Setting remaining weekly transaction quota.
     *
     * @param integer $weeklyTransactedQuota
     * @return void
     */
    public function setWeeklyTransactionQuota(int $weeklyTransactedQuota): void;

    /**
     * Setting remaining weekly transaction quota. Quota will be reduced by 1 after every transaction.
     *
     * @return void
     */
    public function removeWeeklyTransactionQuota(): void;

    /**
     * Resetting remaing Quota to 0
     *
     * @return void
     */
    public function resetWeeklyTransactionQuota(): void;
}
