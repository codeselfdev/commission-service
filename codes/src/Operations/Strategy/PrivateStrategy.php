<?php

declare(strict_types=1);

namespace Commission\Calculation\Operations\Strategy;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Enums\UserType;
use Commission\Calculation\Operations\OperationInterface;
use Commission\Calculation\Traits\DateCalc;
use Commission\Calculation\Users\UserInterface;

final class PrivateStrategy implements UserTypeStrategyInterface
{
    /*
     * using trait to avail some helper function
     */
    use DateCalc;

    /**
     * Constructing strategy by user type.
     *
     * @param OperationInterface $operation
     * @param ConfigInterface    $config
     */
    public function __construct(
        private OperationInterface $operation,
        private ConfigInterface $config
    ) {
    }

    /**
     * calculation logic for private user.
     */
    public function calculate(): float
    {
        return ($this->config->getWithdrawPrivateCommission() * $this->getFee()) / 100;
    }

    /**
     * Logic implemented here which will be chargable for commission.
     */
    public function getFee(): float
    {
        $weeklyQuotaConfig = $this->config->getWithdrawPrivateFreeOfChargeQuota();

        $user = $this->operation->getUser();

        $previousOperation = $this->operation->getPrevious();

        if ($previousOperation === null) {
            $user->setWeeklyTransactionQuota($weeklyQuotaConfig);

            return $this->amountChargedRule($user);
        }

        if (!self::isDateBetweenWeek($previousOperation?->getDate(), $this->operation->getDate())) {
            $user->setWeeklyTransactionQuota($weeklyQuotaConfig);
        }

        return $this->amountChargedRule($user);
    }

    /**
     * Get user type.
     */
    public function getType(): string
    {
        return (UserType::private)->val();
    }

    /**
     * private user's chargable amount.
     */
    private function amountChargedRule(UserInterface $user): float
    {
        $freeAmount = $this->config->getWithdrawPrivateFreeOfChargeAmount();
        $weeklySum = $user->getWeeklyTransactionSum();
        $weeklyQuotaRemain = $user->getWeeklyTransactionQuota();
        $amount = $this->operation->getAmount();

        $user->removeWeeklyTransactionQuota();

        if (($weeklyQuotaRemain > 0)
            && (($weeklySum + $amount) > $freeAmount)
            ) {
            $user->setWeeklyTransactionAmount(0.0);
            $user->resetWeeklyTransactionQuota();

            return ($weeklySum + $amount) - $freeAmount;
        } elseif (($weeklyQuotaRemain > 0) && ($weeklySum + $amount) <= $freeAmount) {
            $user->addWeeklyTransactionAmount($amount);

            return 0.0;
        } else {
            return $amount;
        }
    }
}
