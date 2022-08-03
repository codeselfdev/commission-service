<?php

namespace Commission\Calculation\DTOs;

use ReflectionClass;
use ReflectionProperty;

abstract class AbstractDTO implements DTOInterface
{
    /**
     * To reftect all property for set/get whoever use DTO
     *
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
            $property = $reflectionProperty->getName();
            $this->{$property} = $parameters[$property];
        }
    }

    /**
     * Convert the object into Array
     *
     * @return array
     */
    public function toArray(): array
    {
        return (array) $this;
    }
}