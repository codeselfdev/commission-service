<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations;

use Commission\Calculation\Operations\Strategy\OperationStrategyInterface;
use Commission\Calculation\Users\UserInterface;

class Operation implements OperationInterface
{
    /**
     * Previouc operation of this operation's user.
     */
    private ?OperationInterface $previous;

    /**
     * Constructing operation.
     *
     * @param string        $date
     * @param string        $type
     * @param float         $amount
     * @param UserInterface $user
     */
    public function __construct(
        private string $date,
        private string $type,
        private float $amount,
        private UserInterface $user,
    ) {
        $this->previous = $this->user->getLastOperation();
    }

    /**
     * Get date of operation.
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Get user instance of this operation.
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * get operation type.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get previous operation of user.
     */
    public function getPrevious(): ?OperationInterface
    {
        return $this->previous;
    }

    /**
     * Get operation value.
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Operation value to be charged from strategy wise policy.
     */
    public function getAmountForCharge(): float
    {
        return $this->strategy->getAmountForCharge();
    }

    /**
     * Get commission fee from strategy wise policy.
     */
    public function getCommissionFees(): float
    {
        return $this->strategy->getCommissionFee();
    }

    /**
     * Setting strategy of this operation.
     */
    public function setStrategy(OperationStrategyInterface $strategy): self
    {
        $this->strategy = $strategy;

        return $this;
    }
}
