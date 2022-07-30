<?php

declare(strict_types=1);

namespace Commission\Calculation;

use Commission\Calculation\DTOs\TransactionDTO;
use Commission\Calculation\Exception\InputValidationException;
use Commission\Calculation\Exceptions\InputValidationException as ExceptionsInputValidationException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Application
{
    public function __construct(
    ) {
    }

    /**
     *
     * @throws Exception
     */
    public static function create(): Application
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__, 1). '/config'));
        $loader->load('services.yaml');

        $container->compile();

        return $container->get(Application::class);
    }

    /**
     * @throws InputValidationException
     */
    public function getCommissionFees(TransactionDTO $transaction): string
    {
        $transaction->validate();
        // $user = $this->userService->findOrAddNew($userID, $userType);
        // $precision = $this->currencyService->getPrecision($amount);
        // $currency = $this->currencyService->findOrAddNew($currency, $precision);

        // $operation = $this->operationService->addNew($date, $type, $amount, $currency, $user);
        // return $this->currencyService->format($operation->getCurrency(), $operation->getFee());

        return '9';
    }

    /**
     * @throws InputValidationException
     */
    public function parse(string $csv_path): string
    {
        $result = [];

        $content = file_get_contents(dirname(__DIR__, 1). "/".$csv_path);
        $lines = explode(PHP_EOL, $content);

        foreach ($lines as $line) {
            $data = str_getcsv($line);

            if (!is_array($data) || (count($data) !== 6)) {
                throw new ExceptionsInputValidationException();
            }

            [$date, $userID, $userType, $type, $amount, $currency] = $data;

            $transaction = new TransactionDTO($date, (int)$userID, $userType, $type, (float)$amount, $currency);

            $result[] = $this->getCommissionFees($transaction);
        }

        return join(PHP_EOL, $result);
    }
}
