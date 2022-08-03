<?php

declare(strict_types=1);

namespace Commission\Calculation\Currency;

use Symfony\Contracts\HttpClient\HttpClientInterface;

interface CurrencyExchangeInterface
{
    /**
     * Set HTTP client to call a url.
     */
    public function setHttpClient(HttpClientInterface $client): HttpClientInterface;

    /**
     * Get exchange rate by currency.
     */
    public function getExchangeRate(string $currency): float;

    /**
     * Convert one foreign currency to base currency.
     */
    public function getAmountInBasePrice(float $amount, string $currency): string;

    /**
     * Convert base currency to foreign currency.
     */
    public function getAmountFromBaseCurrencyToForeignCurrency(float $amount, string $currency): string;

    /**
     * Get exchange rate api url.
     */
    public function getUrl(): string;
}
