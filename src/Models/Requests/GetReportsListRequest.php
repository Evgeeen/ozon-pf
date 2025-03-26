<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Requests;

use Evgeeen\Models\Dto\AbstractDto;

class GetReportsListRequest extends AbstractDto
{
    public function __construct(
        public readonly int $page = 0,
        public readonly int $pageSize = 100,
    ) {
    }
}