<?php

declare(strict_types=1);

namespace Commission\Calculation\Configs;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class Config implements ConfigInterface
{
    private const DEPOSIT = 'deposit';
    private const WITHDRAW = 'withdraw';
    private const COMMISSION = 'commission';
    private const PRIVATE = 'private';
    private const BUSINESS = 'business';
    private const FREE_OF_CHARGE = 'free_of_charge';
    private const AMOUNT = 'amount';
    private const DEFAULT = 'default';
    private const CURRENCY = 'currency';
    private const PRECISION = 'precision';
    private const QUOTA = 'quota';

    /**
     * where configs value from yml file.
     */
    private array $params;

    /**
     * Constructing config object from a yaml.
     */
    public function __construct()
    {
        $locator = new FileLocator(dirname(__DIR__, 2).'/config');
        $this->params = Yaml::parseFile($locator->locate('config.yaml'));
    }

    /**
     * Create config instance from yaml.
     */
    public static function create(): ConfigInterface
    {
        return new Config(new FileLocator());
    }

    /**
     * Get deposit commission rate.
     */
    public function getDepositCommission(): float
    {
        return $this->params[self::DEPOSIT][self::COMMISSION];
    }

    /**
     * Get commission rate for private user withdraw.
     */
    public function getWithdrawPrivateCommission(): float
    {
        return $this->params[self::WITHDRAW][self::PRIVATE][self::COMMISSION];
    }

    /**
     * Get free weekly transaction amount.
     */
    public function getWithdrawPrivateFreeOfChargeAmount(): float
    {
        return $this->params[self::WITHDRAW][self::PRIVATE][self::FREE_OF_CHARGE][self::AMOUNT];
    }

    /**
     * Get default currency.
     */
    public function getDefaultCurrency(): string
    {
        return $this->params[self::DEFAULT][self::CURRENCY];
    }

    /**
     * Get default precision value.
     */
    public function getDefaultPrecision(): int
    {
        return $this->params[self::DEFAULT][self::PRECISION];
    }

    /**
     * Get weekly private user withdraw operation quota.
     */
    public function getWithdrawPrivateFreeOfChargeQuota(): int
    {
        return $this->params[self::WITHDRAW][self::PRIVATE][self::FREE_OF_CHARGE][self::QUOTA];
    }

    /**
     * Get bussiness withdraw operation commission rate.
     */
    public function getWithdrawBusinessCommission(): float
    {
        return $this->params[self::WITHDRAW][self::BUSINESS][self::COMMISSION];
    }
}
