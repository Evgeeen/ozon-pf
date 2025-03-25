<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Dto;

use ArrayAccess;
use IteratorAggregate;
use Traversable;

abstract class AbstractDtoCollection implements DtoInterface, IteratorAggregate
{
    private array $items;

    abstract protected function type(): string;

    public static function fromPrimitives(array $items): static
    {
        $collection = new static();

        /** @var DtoInterface $classType */
        $classType = $collection->type();

        foreach ($items as $item) {
            $collection->items[] = $classType::fromPrimitives($item);
        }

        return $collection;
    }

    public function jsonSerialize(): mixed
    {
        return array_map(function (AbstractDto $item) {
            return $item->jsonSerialize();
        }, $this->items);
    }

    public function getIterator(): Traversable
    {
        foreach ($this->items as $key => $item) {
            yield $key => $item;
        }
    }
}