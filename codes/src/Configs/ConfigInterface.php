<?php

declare(strict_types=1);

namespace Commission\Calculation\Configs;

interface ConfigInterface
{
    /**
     * Get deposit commission rate
     *
     * @return float
     */
    public function getDepositCommission(): float;

    /**
     * Get commission rate for private user withdraw
     *
     * @return float
     */
    public function getWithdrawPrivateCommission(): float;

    /**
     * Get free weekly transaction amount
     *
     * @return float
     */
    public function getWithdrawPrivateFreeOfChargeAmount(): float;

    /**
     * Get default currency
     *
     * @return string
     */
    public function getDefaultCurrency(): string;

    /**
     * Get default precision value
     *
     * @return integer
     */
    public function getDefaultPrecision(): int;

    /**
     * Get weekly private user withdraw operation quota
     *
     * @return integer
     */
    public function getWithdrawPrivateFreeOfChargeQuota(): int;

    /**
     * Get bussiness withdraw operation commission rate
     *
     * @return float
     */
    public function getWithdrawBusinessCommission(): float;
}
