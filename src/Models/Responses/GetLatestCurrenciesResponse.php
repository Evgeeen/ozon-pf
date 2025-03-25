<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Responses;

use Evgeeen\Models\Dto\AbstractDto;
use Evgeeen\Models\RatesDictionary;

class GetLatestCurrenciesResponse extends AbstractDto
{
    public function __construct(
        public readonly string $disclaimer,
        public readonly string $license,
        public readonly int $timestamp,
        public readonly string $base,
        public readonly RatesDictionary $rates,
    ) {
    }
}
