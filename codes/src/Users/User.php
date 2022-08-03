<?php

declare(strict_types=1);

namespace Commission\Calculation\Users;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Operations\OperationInterface;

class User implements UserInterface
{
    /**
     * Total weekly transaction amount before reaching free quota policy.
     */
    private float $weeklyTransactedAmount = 0.0;

    /**
     * remaining weekly transaction quota with default value 0.
     */
    private int $weeklyTransactedQuota = 0;

    /**
     * User's operation history.
     */
    private array $operations = [];

    /**
     * User's last transactioned operation.
     */
    private ?OperationInterface $previousOperation = null;

    /**
     * construction with dependant.
     *
     * @param int                  $id
     * @param string               $userType
     * @param ConfigInterface|null $config
     */
    public function __construct(
        private int $id,
        private string $userType,
        private ?ConfigInterface $config
    ) {
        $this->weeklyTransactedQuota = $this->config->getWithdrawPrivateFreeOfChargeQuota();
    }

    /**
     * Function for getting user id.
     *
     * @return int $id
     */
    public function getID(): int
    {
        return $this->id;
    }

    /**
     * Function for getting user type.
     *
     * @return string $userType
     */
    public function getUserType(): string
    {
        return $this->userType;
    }

    /**
     * Function for getting weekly operation sum.
     *
     * @return float $weeklyTransactedAmount
     */
    public function getWeeklyTransactionSum(): float
    {
        return $this->weeklyTransactedAmount;
    }

    /**
     * Function add operation to a weekly operation array.
     */
    public function addTransaction(OperationInterface $operation): void
    {
        $this->operations[] = $operation;
        $this->setLastOperation();
    }

    /**
     * Set last transactioned operation to user.
     */
    public function setLastOperation(): void
    {
        if (empty($this->operations)) {
            $this->previousOperation = null;
        } else {
            $this->previousOperation = $this->operations[count($this->operations) - 1];
        }
    }

    /**
     * Getting user's last operation.
     */
    public function getLastOperation(): ?OperationInterface
    {
        return $this->previousOperation;
    }

    /**
     * Getting remains weeekly transactioned quota.
     */
    public function getWeeklyTransactionQuota(): int
    {
        return $this->weeklyTransactedQuota;
    }

    /**
     * Summing operation value to weekly transactioned amount.
     */
    public function addWeeklyTransactionAmount(float $weeklyTransactedAmount): void
    {
        $this->weeklyTransactedAmount += $weeklyTransactedAmount;
    }

    /**
     * Setting weekly transactioned amount.
     */
    public function setWeeklyTransactionAmount(float $weeklyTransactedAmount): void
    {
        $this->weeklyTransactedAmount = $weeklyTransactedAmount;
    }

    /**
     * Setting remains weeekly transactioned quota.
     */
    public function setWeeklyTransactionQuota(int $weeklyTransactedQuota): void
    {
        $this->weeklyTransactedQuota = $weeklyTransactedQuota;
    }

    /**
     * Reducing remains weeekly transactioned quota by 1.
     */
    public function removeWeeklyTransactionQuota(): void
    {
        --$this->weeklyTransactedQuota;
    }

    /**
     * Resetting weekly transactioned amount to 0.0.
     */
    public function resetWeeklyTransactionAmount(): void
    {
        $this->weeklyTransactedAmount = 0.0;
    }

    /**
     * Resetin all remains weeekly transactioned quota to 0.
     */
    public function resetWeeklyTransactionQuota(): void
    {
        $this->weeklyTransactedQuota = 0;
    }
}
