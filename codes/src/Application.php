<?php

declare(strict_types=1);

namespace Commission\Calculation;

use Commission\Calculation\Configs\ConfigInterface;
use Commission\Calculation\Currency\CurrencyExchange;
use Commission\Calculation\Currency\CurrencyExchangeInterface;
use Commission\Calculation\DTOs\TransactionDTO;
use Commission\Calculation\Exception\InputValidationException;
use Commission\Calculation\Exceptions\InputValidationException as ExceptionsInputValidationException;
use Commission\Calculation\Operations\OperationServiceInterface;
use Commission\Calculation\Users\Repository\UserRepositoryInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Application
{
    /**
     * Injecticting dependant objects into app.
     *
     * @param CurrencyExchangeInterface $currency
     * @param OperationServiceInterface $operationService
     * @param UserRepositoryInterface   $userRepo
     * @param ConfigInterface           $config
     */
    public function __construct(
        private CurrencyExchangeInterface $currency,
        private OperationServiceInterface $operationService,
        private UserRepositoryInterface $userRepo,
        private ConfigInterface $config,
    ) {
    }

    /**
     * Carete app which containerised all services.
     */
    public static function create(bool $fromTestEnvironment): Application
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__, 1).'/config'));
        $loader->load('services.yaml');

        if ($fromTestEnvironment) {
            $container->getDefinition(CurrencyExchange::class)
                ->setFactory([CurrencyExchange::class, 'mockCurrencyExchangeLoader']);
        }

        $container->compile();

        return $container->get(Application::class);
    }

    /**
     * calculate commission fee from a operation.
     *
     * @throws InputValidationException
     */
    public function getCommissionFees(TransactionDTO $transaction): string
    {
        $transaction->validate();
        $amountInBaseCurrency = $this->currency->getAmountInBasePrice($transaction->amount, $transaction->currency);
        $user = $this->userRepo->findOrNewUser($transaction->user_id, $transaction->client_type, $this->config);
        $operation = $this->operationService->addNew($transaction->operation_type, (float) $amountInBaseCurrency, $transaction->date, $user);

        return $this->currency->getAmountFromBaseCurrencyToForeignCurrency($operation->getCommissionFees(), $transaction->currency);
    }

    /**
     * Parse csv file content in multi line and print line by line calculate commission fee.
     *
     * @throws InputValidationException
     */
    public function parse(string $csv_path): string
    {
        $result = [];

        $content = file_get_contents(dirname(__DIR__, 1).'/'.$csv_path);
        $lines = explode(PHP_EOL, $content);

        foreach ($lines as $line) {
            $data = str_getcsv($line);

            if (!is_array($data) || (count($data) !== 6)) {
                throw new ExceptionsInputValidationException();
            }

            [$date, $userID, $userType, $type, $amount, $currency] = $data;

            $transaction = new TransactionDTO($date, (int) $userID, $userType, $type, (float) $amount, $currency);

            $result[] = $this->getCommissionFees($transaction);
        }

        return join(PHP_EOL, $result);
    }
}
