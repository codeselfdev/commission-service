<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations;

use Commission\Calculation\Operations\Strategy\OperationStrategyInterface;
use Commission\Calculation\Users\UserInterface;

class Operation implements OperationInterface
{
    /**
     * Previouc operation of this operation's user
     *
     * @var OperationInterface|null
     */
    private ?OperationInterface $previous;

    /**
     * Constructing operation
     *
     * @param string $date
     * @param string $type
     * @param float $amount
     * @param UserInterface $user
     */
    function __construct(
        private string $date,
        private string $type,
        private float $amount,
        private UserInterface $user,
    ) {
        $this->previous = $this->user->getLastOperation();
    }

    /**
     * Get date of operation
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Get user instance of this operation
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * get operation type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get previous operation of user
     *
     * @return OperationInterface|null
     */
    public function getPrevious(): ?OperationInterface
    {
        return $this->previous;
    }

    /**
     * Get operation value
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Operation value to be charged from strategy wise policy
     *
     * @return float
     */
    public function getAmountForCharge(): float
    {
        return $this->strategy->getAmountForCharge();
    }

    /**
     * Get commission fee from strategy wise policy
     *
     * @return float
     */
    public function getCommissionFees(): float
    {
        return $this->strategy->getCommissionFee();
    }

    /**
     * Setting strategy of this operation
     *
     * @param OperationStrategyInterface $strategy
     * @return self
     */
    public function setStrategy(OperationStrategyInterface $strategy): self
    {
        $this->strategy = $strategy;

        return $this;
    }

}
