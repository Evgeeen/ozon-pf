<?php

declare(strict_types = 1);

namespace Evgeeen\Models;

use Evgeeen\Models\Dto\AbstractDtoCollection;

class Reports extends AbstractDtoCollection
{
    protected function type(): string
    {
        return Report::class;
    }
}