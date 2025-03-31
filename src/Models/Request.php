<?php

declare(strict_types = 1);

namespace Evgeeen\Models;

use Evgeeen\Models\Dto\AbstractDto;

class Request extends AbstractDto
{
    public function __construct(
        public readonly array $campaigns,
        public readonly string $from,
        public readonly string $to,
        public readonly string $dateFrom,
        public readonly string $dateTo,
        public readonly string $groupBy,
    ) {
    }
}