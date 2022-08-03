<?php

declare(strict_types=1);

namespace Commission\Calculation\Tests;

use Commission\Calculation\Application;
use Commission\Calculation\Currency\CurrencyExchange;
use Commission\Calculation\DTOs\TransactionDTO;
use Commission\Calculation\Exceptions\InputValidationException;
use Exception;
use ReflectionProperty;

final class ApplicationTest extends TestCase
{
    private function getInput(): array
    {
        return [
            "2014-12-31,4,private,withdraw,1200.00,EUR",
            "2015-01-01,4,private,withdraw,1000.00,EUR",
            "2016-01-05,4,private,withdraw,1000.00,EUR",
            "2016-01-05,1,private,deposit,200.00,EUR",
            "2016-01-06,2,business,withdraw,300.00,EUR",
            "2016-01-06,1,private,withdraw,30000,JPY",
            "2016-01-07,1,private,withdraw,1000.00,EUR",
            "2016-01-07,1,private,withdraw,100.00,USD",
            "2016-01-10,1,private,withdraw,100.00,EUR",
            "2016-01-10,2,business,deposit,10000.00,EUR",
            "2016-01-10,3,private,withdraw,1000.00,EUR",
            "2016-02-15,1,private,withdraw,300.00,EUR",
            "2016-02-19,5,private,withdraw,3000000,JPY"
        ];
    }

    private function getOutput(): array
    {
        return [
            "0.60",
            "3.00",
            "0.00",
            "0.06",
            "1.50",
            "0",
            "0.69",
            "0.30",
            "0.30",
            "3.00",
            "0.00",
            "0.00",
            "8608"
        ];
    }

    private function mockCurrencyService(Application $app): void
    {
        $currencyExchangeProperty = new ReflectionProperty(
            Application::class,
            'currency'
        );
        $currencyExchangeProperty->setAccessible(true);
        $currencyExchange = $currencyExchangeProperty->getValue($app);

        $this->assertEquals(CurrencyExchange::MOCK_URL, $currencyExchange->getUrl());
    }

    /**
     * @throws IncorrectInputException
     * @throws Exception
     */
    public function testApplication(): void
    {
        $app = $this->getApplication();

        $this->mockCurrencyService($app);

        $input = $this->getInput();

        foreach ($this->getOutput() as $i => $singleOutput)
        {
            $data = str_getcsv($input[$i]);
            if (!is_array($data) || (count($data) !== 6)) {
                throw new InputValidationException();
            }
            [$date, $userID, $userType, $type, $amount, $currency] = $data;
            $transaction = new TransactionDTO($date, (int)$userID, $userType, $type, (float)$amount, $currency);

            $this->assertEquals(
                $singleOutput,
                $app->getCommissionFees($transaction),
                sprintf("Input[%d]: %s", $i, $input[$i])
            );
        }
    }
}
