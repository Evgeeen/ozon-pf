<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Responses;

use Evgeeen\Models\Dto\AbstractDto;

class GetCampaignStatisticResponse extends AbstractDto
{
    public function __construct(
        public string $UUID,
        public bool $vendor
    ) {
    }
}