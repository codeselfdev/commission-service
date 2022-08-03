<?php

declare(strict_types=1);

namespace Commission\Calculation\Configs;

interface ConfigInterface
{
    /**
     * Get deposit commission rate.
     */
    public function getDepositCommission(): float;

    /**
     * Get commission rate for private user withdraw.
     */
    public function getWithdrawPrivateCommission(): float;

    /**
     * Get free weekly transaction amount.
     */
    public function getWithdrawPrivateFreeOfChargeAmount(): float;

    /**
     * Get default currency.
     */
    public function getDefaultCurrency(): string;

    /**
     * Get default precision value.
     */
    public function getDefaultPrecision(): int;

    /**
     * Get weekly private user withdraw operation quota.
     */
    public function getWithdrawPrivateFreeOfChargeQuota(): int;

    /**
     * Get bussiness withdraw operation commission rate.
     */
    public function getWithdrawBusinessCommission(): float;
}
