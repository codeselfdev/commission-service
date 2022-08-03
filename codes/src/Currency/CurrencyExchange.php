<?php

declare(strict_types=1);

namespace Commission\Calculation\Currency;

use Commission\Calculation\Currency\Exceptions\CurrencyExchangeException;
use Commission\Calculation\Enums\CurrencyName;
use Commission\Calculation\Traits\Math;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class CurrencyExchange implements CurrencyExchangeInterface
{
    /**
     * To avail some currency formatting function
     */
    use Math;

    /**
     * Store all rates in a array
     *
     * @var array
     */
    private array $rates;

    /**
     * url constant
     */
    const URL = 'https://developers.paysera.com/tasks/api/currency-exchange-rates';

    /**
     * Mock url constant
     */
    const MOCK_URL = 'https://mock.paysera.com/tasks/api/currency-exchange-rates';

    /**
     * Constructor for currency exchange service
     *
     * @param HttpClientInterface|null $client
     */
    public function __construct(
        private ?HttpClientInterface $client,
        private string $url = self::URL
    ) {}


    /**
     * Creating mock random response for exchange rate api
     *
     * @throws Exception
     * @return CurrencyExchangeInterface
     */
    public static function mockCurrencyExchangeLoader(): CurrencyExchangeInterface
    {
        $response1 = new MockResponse(
            <<<END
            {
                "base":"EUR",
                "date":"2021-12-22",
                "rates":{
                    "JPY":130.869977,
                    "USD":1.129031,
                    "EUR":1
                }
            }
            END
        );

        $client = new MockHttpClient([$response1]);
        return new CurrencyExchange($client, self::MOCK_URL);
    }

    /**
     * Set http client
     *
     * @param HttpClientInterface $client
     * @return HttpClientInterface
     */
    public function setHttpClient(HttpClientInterface $client): HttpClientInterface
    {
        $this->client = $client;

        return $this->client;
    }

    /**
     * Get HTTP client
     *
     * @return HttpClientInterface
     */
    private function getClient(): HttpClientInterface
    {
        if (!isset($this->client)) {
            $this->client = HttpClient::create();
        }

        return $this->client;
    }

    /**
     * Get exchange rate api url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Get exchange rate of a currency
     *
     * @param string $currency
     * @return float
     */
    public function getExchangeRate(string $currency): float
    {
        if (empty($this->rates))
        {
            $this->callExchangeRateApi();
        }

        return isset($this->rates[$currency]) ? $this->rates[$currency]: 1;

    }

    /**
     * Convert a foreign currency value to base currency
     *
     * @param float $amount
     * @param string $currency
     * @return string
     */
    public function getAmountInBasePrice(float $amount, string $currency): string
    {
        $convertedValue =  $amount / $this->getExchangeRate($currency);

        return self::currencyFormat($convertedValue, $currency);
    }

    /**
     * Convert base currency value to a foreign currency
     *
     * @param float $amount
     * @param string $currency
     * @return string
     */
    public function getAmountFromBaseCurrencyToForeignCurrency(float $amount, string $currency): string
    {
        $convertedValue = $amount * $this->getExchangeRate($currency);
        return self::currencyFormat(self::roundedUp($convertedValue, 2), $currency);
    }

    /**
     * call paysara API to get exchange rates
     *
     * @return array
     */
    private function callExchangeRateApi(): array
    {
        try {
            $response = $this->getClient()->request(
                "GET",
                $this->getUrl(),
                [
                    'max_duration' => 5,
                    'no_proxy' => 'https://developers.paysera.com',
                ]
            );

            $content = json_decode($response->getContent());

        } catch (Throwable $e) {
            throw new CurrencyExchangeException(
                sprintf('Exchange rate api error: "%s".', $e->getMessage())
            );
        }

        foreach(CurrencyName::names() as $symbol)
        {
            $this->rates[$symbol] = get_object_vars($content->rates)[$symbol];
        }

        return $this->rates;
    }
}