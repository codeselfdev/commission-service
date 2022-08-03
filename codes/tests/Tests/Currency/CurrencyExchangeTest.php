<?php

declare(strict_types=1);

namespace Commission\Calculation\Tests\Currency;

use Commission\Calculation\Currency\CurrencyExchange;
use Commission\Calculation\Currency\CurrencyExchangeInterface;
use PHPUnit\Framework\TestCase;

final class CurrencyExchangeTest extends TestCase
{
    private CurrencyExchangeInterface $currencyExchange;

    /**
     * @throws ExchangeRatesLoadingException
     */
    public function setUp(): void
    {
        $this->currencyExchange = CurrencyExchange::mockCurrencyExchangeLoader();
        parent::setUp();
    }

    /**
     * Test cases for get exchange rates
     *
     * @return void
     */
    public function testGetExchangeRate(): void
    {
        $this->assertEquals(130.869977, $this->currencyExchange->getExchangeRate("JPY"));
        $this->assertEquals(1.129031, $this->currencyExchange->getExchangeRate("USD"));
    }

    /**
     * Test case for conversation of foreign currency to base currency
     *
     * @return void
     */
    public function testGetAmountInBasePriceRate(): void
    {
        $this->assertEquals(1, $this->currencyExchange->getAmountInBasePrice(130.869977, "JPY"));
        $this->assertEquals(1, $this->currencyExchange->getAmountInBasePrice(1.129031, "USD"));
    }

    /**
     * Test case for conversation of Base currency to foreign currency with formatted output
     *
     * @return void
     */
    public function testGetAmountFromBaseCurrencyToForeignCurrency(): void
    {
        $this->assertEquals(131, $this->currencyExchange->getAmountFromBaseCurrencyToForeignCurrency(1, "JPY"));
        $this->assertEquals(1.13, $this->currencyExchange->getAmountFromBaseCurrencyToForeignCurrency(1, "USD"));
    }
}