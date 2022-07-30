<?php

declare(strict_types=1);

namespace Commission\Calculation\Configs;

interface ConfigInterface
{
    public function getDepositCommission(): float;

    public function getWithdrawPrivateCommission(): float;

    public function getWithdrawPrivateFreeOfChargeAmount(): float;

    public function getDefaultCurrency(): string;

    public function getWithdrawPrivateFreeOfChargeQuota(): int;

    public function getWithdrawBusinessCommission(): float;
}
