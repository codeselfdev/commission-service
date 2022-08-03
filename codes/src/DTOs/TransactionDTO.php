<?php

declare(strict_types=1);

namespace Commission\Calculation\DTOs;

use Commission\Calculation\Enums\CurrencyName;
use Commission\Calculation\Enums\OperationType;
use Commission\Calculation\Enums\UserType;
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
     * operation currency, one of EUR, USD, JPY.
     *
     * @param string    $date
     * @param int       $user_id
     * @param string    $client_type
     * @param string    $operation_type
     * @param int|float $amount
     * @param string    $currency
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
     * Enum case array to value array.
     */
    private function sanitizeEnumValue(mixed $v): string
    {
        return $v->val();
    }

    /**
     * Applying validation rules for this DTO.
     *
     * @throws InputValidationException
     */
    public function validate(): bool
    {
        $validator = Validation::createValidator();

        $constraints = new Assert\Collection([
            'date' => new Assert\Date(),
            'user_id' => new Assert\Type('integer'),
            'client_type' => new Assert\Choice(array_map([$this, 'sanitizeEnumValue'], UserType::cases())),
            'operation_type' => new Assert\Choice(array_map([$this, 'sanitizeEnumValue'], OperationType::cases())),
            'amount' => new Assert\Type('float'),
            'currency' => new Assert\Choice(array_map([$this, 'sanitizeEnumValue'], CurrencyName::cases())),
        ]);

        $violations = $validator->validate($this->toArray(), $constraints);

        if (0 !== count($violations)) {
            var_dump($violations);
            throw new InputValidationException();
        }

        return true;
    }
}
