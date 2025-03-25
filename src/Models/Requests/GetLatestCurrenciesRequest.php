<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Requests;

use Evgeeen\Models\Dto\AbstractDto;

class GetLatestCurrenciesRequest extends AbstractDto
{
    public function __construct(
        public readonly ?string $base = null,
        public readonly ?string $symbol = null,
        public readonly ?bool $prettyprint = null,
        public readonly ?bool $show_alternative = null,
    ) {
    }
}
