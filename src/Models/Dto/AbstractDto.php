<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Dto;

use ReflectionClass;
use ReflectionProperty;

abstract class AbstractDto implements DtoInterface
{
    private array $reflectionMap = [];

    public static function fromPrimitives(array $items): static
    {
        $instance = (new ReflectionClass(static::class))->newInstanceWithoutConstructor();
        $instance->hydrate($items);

        return $instance;
    }

    public function jsonSerialize(): mixed
    {
        $this->initProperty();

        $array = [];

        foreach ($this as $propertyName => $value) {
            $property = $this->getProperty($propertyName);

            if (is_null($property) || is_null($value) ) {
                continue;
            }

            if ($property->isInitialized($this)) {
                $array[$property->getName()] = $this->isSubClassOfDTO($value)
                    ? $value->jsonSerialize()
                    : $value;
            }
        }

        return $array;
    }

    private function hydrate(array $values): void
    {
        foreach ($values as $name => $value) {
            $this->initProperty();
            $property = $this->getProperty($name);

            if (empty($property)) {
                continue;
            }

            /** @var DtoInterface|string $propertyType */
            $propertyType = (string)str_replace("?", "", $property->getType()->getName());

            if ($this->isSubClassOfDTO($value) || $this->isNotSubClassOfDTO($propertyType)) {
                $property->setValue($this, $value);
            } elseif ($this->isCollection($value)) {

            } else {
                $property->setValue($this, is_null($value) ? null : $propertyType::fromPrimitives($value));
            }
        }
    }

    private function isNotSubClassOfDTO(mixed $value): bool
    {
        return !$this->isDto($value) && !$this->isDictionary($value);
    }

    private function isSubClassOfDTO(mixed $value): bool
    {
        return $this->isDto($value) || $this->isDictionary($value);
    }

    private function isDictionary(mixed $value): bool
    {
        return is_subclass_of($value, AbstractDtoDictionary::class);
    }

    private function isDto(mixed $value): bool
    {
        return is_subclass_of($value, self::class);
    }

    private function isCollection(mixed $value): bool
    {
        return is_subclass_of($value, AbstractDtoCollection::class);
    }

    private function initProperty(): void
    {
        $reflectionClass = new ReflectionClass($this);

        foreach ($reflectionClass->getProperties() as $property) {
            $this->reflectionMap[$property->getName()] = $property;
        }
    }

    private function getProperty(string $name): ?ReflectionProperty
    {
        if (isset($this->reflectionMap[$name])) {
            return $this->reflectionMap[$name];
        }

        return null;
    }
}
