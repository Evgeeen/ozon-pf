<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Dto;

use JsonSerializable;

interface DtoInterface extends JsonSerializable
{
    public static function fromPrimitives(array $items): static;
}
