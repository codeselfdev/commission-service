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
     * where configs value from yml file
     *
     * @var array
     */
    private array $params;

    /**
     * Constructing config object from a yaml
     */
    public function __construct()
    {
        $locator = new FileLocator(dirname(__DIR__, 2) . '/config');
        $this->params = Yaml::parseFile($locator->locate('config.yaml'));
    }

    /**
     * Create config instance from yaml
     *
     * @return ConfigInterface
     */
    public static function create(): ConfigInterface
    {
        return new Config(new FileLocator());
    }

    /**
     * Get deposit commission rate
     *
     * @return float
     */
    public function getDepositCommission(): float
    {
        return $this->params[self::DEPOSIT][self::COMMISSION];
    }

    /**
     * Get commission rate for private user withdraw
     *
     * @return float
     */
    public function getWithdrawPrivateCommission(): float
    {
        return $this->params[self::WITHDRAW][self::PRIVATE][self::COMMISSION];
    }

    /**
     * Get free weekly transaction amount
     *
     * @return float
     */
    public function getWithdrawPrivateFreeOfChargeAmount(): float
    {
        return $this->params[self::WITHDRAW][self::PRIVATE][self::FREE_OF_CHARGE][self::AMOUNT];
    }

    /**
     * Get default currency
     *
     * @return string
     */
    public function getDefaultCurrency(): string
    {
        return $this->params[self::DEFAULT][self::CURRENCY];
    }

    /**
     * Get default precision value
     *
     * @return integer
     */
    public function getDefaultPrecision(): int
    {
        return $this->params[self::DEFAULT][self::PRECISION];
    }

    /**
     * Get weekly private user withdraw operation quota
     *
     * @return integer
     */
    public function getWithdrawPrivateFreeOfChargeQuota(): int
    {
        return $this->params[self::WITHDRAW][self::PRIVATE][self::FREE_OF_CHARGE][self::QUOTA];
    }

    /**
     * Get bussiness withdraw operation commission rate
     *
     * @return float
     */
    public function getWithdrawBusinessCommission(): float
    {
        return $this->params[self::WITHDRAW][self::BUSINESS][self::COMMISSION];
    }
}
