<?php

declare(strict_types=1);

namespace Commission\Calculation\Currency;

use Symfony\Contracts\HttpClient\HttpClientInterface;

interface CurrencyExchangeInterface
{
    /**
     * Set HTTP client to call a url
     *
     * @param HttpClientInterface $client
     * @return HttpClientInterface
     */
    public function setHttpClient(HttpClientInterface $client): HttpClientInterface;

    /**
     * Get exchange rate by currency
     *
     * @param string $currency
     * @return float
     */
    public function getExchangeRate(string $currency): float;

    /**
     * Convert one foreign currency to base currency
     *
     * @param float $amount
     * @param string $currency
     * @return string
     */
    public function getAmountInBasePrice(float $amount, string $currency): string;

    /**
     * Convert base currency to foreign currency
     *
     * @param float $amount
     * @param string $currency
     * @return string
     */
    public function getAmountFromBaseCurrencyToForeignCurrency(float $amount, string $currency): string;

    /**
     * Get exchange rate api url
     *
     * @return string
     */
    public function getUrl(): string;
}