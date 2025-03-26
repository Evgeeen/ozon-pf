<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Responses;

use Evgeeen\Models\Dto\AbstractDto;
use Evgeeen\Models\Reports;

class GetReportsListResponse extends AbstractDto
{
    public function __construct(
        public readonly Reports $items,
        public readonly int $total,
    ) {
    }
}