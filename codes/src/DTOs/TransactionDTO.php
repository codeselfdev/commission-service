<?php

namespace Commission\Calculation\DTOs;

use Commission\Calculation\Enums\UserType;
use Commission\Calculation\Enums\CurrencyName;
use Commission\Calculation\Enums\OperationType;
use Commission\Calculation\Exceptions\InputValidationException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class TransactionDTO extends AbstractDTO
{

    /**
     * operation date in format Y-m-d
     * user's identificator, number
     * user's type, one of private or business
     * operation type, one of deposit or withdraw
     * operation amount (for example 2.12 or 3)
     * operation currency, one of EUR, USD, JPY
     *
     * @param string $date
     * @param integer $user_id
     * @param string $client_type
     * @param string $operation_type
     * @param integer|float $amount
     * @param string $currency
     */
    public function __construct(
        public string $date,
        public int $user_id,
        public string $client_type,
        public string $operation_type,
        public int|float $amount,
        public string $currency)
    {
    }

    /**
     * Applying validation rules for this DTO
     *
     * @throws InputValidationException
     * @return bool
     */
    public function validate(): bool
    {
        $validator = Validation::createValidator();

        $constraints = new Assert\Collection([
            'date' => new Assert\Date(),
            'user_id' => new Assert\Type('integer'),
            'client_type' => new Assert\Choice(UserType::names()),
            'operation_type' => new Assert\Choice(OperationType::names()),
            'amount' => new Assert\Type('float'),
            'currency' => new Assert\Choice(CurrencyName::names()),
        ]);

        $violations = $validator->validate($this->toArray(), $constraints);

        if (0 !== count($violations)) {
            throw new InputValidationException();
        }

        return true;
    }

}