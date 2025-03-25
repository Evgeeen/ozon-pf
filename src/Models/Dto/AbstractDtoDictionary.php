<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Dto;

abstract class AbstractDtoDictionary implements DtoInterface
{
    protected array $items = [];

    abstract public function type(): string;

    /** @return AbstractDto[] */
    public function items(): array
    {
        return $this->items;
    }

    public static function fromPrimitives(array $items): static
    {
        $dictionary = new static();
        $dictionary->items = $dictionary->createItems($items);

        return $dictionary;
    }

    public function jsonSerialize(): mixed
    {
        return array_map(function (AbstractDto $item) {
            return $item->jsonSerialize();
        }, $this->items);
    }

    private function createItems(array $items): array
    {
        /** @var DtoInterface $itemClass */
        $itemClass = $this->type();
        $objects = [];

        foreach ($items as $key => $value) {
            $objects[] = new $itemClass($key, $value);
        }

        return $objects;
    }
}
