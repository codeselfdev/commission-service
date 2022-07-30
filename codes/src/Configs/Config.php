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
    private const QUOTA = 'quota';

    private array $params;


    public function __construct()
    {
        $locator = new FileLocator(dirname(__DIR__, 2) . '/config');
        $this->params = Yaml::parseFile($locator->locate('config.yaml'));
    }

    public static function create(): ConfigInterface
    {
        return new Config(new FileLocator());
    }

    public function getDepositCommission(): float
    {
        return $this->params[self::DEPOSIT][self::COMMISSION];
    }

    public function getWithdrawPrivateCommission(): float
    {
        return $this->params[self::WITHDRAW][self::PRIVATE][self::COMMISSION];
    }

    public function getWithdrawPrivateFreeOfChargeAmount(): float
    {
        return $this->params[self::WITHDRAW][self::PRIVATE][self::FREE_OF_CHARGE][self::AMOUNT];
    }

    public function getDefaultCurrency(): string
    {
        return $this->params[self::DEFAULT][self::CURRENCY];
    }

    public function getWithdrawPrivateFreeOfChargeQuota(): int
    {
        return $this->params[self::WITHDRAW][self::PRIVATE][self::FREE_OF_CHARGE][self::QUOTA];
    }

    public function getWithdrawBusinessCommission(): float
    {
        return $this->params[self::WITHDRAW][self::BUSINESS][self::COMMISSION];
    }
}
