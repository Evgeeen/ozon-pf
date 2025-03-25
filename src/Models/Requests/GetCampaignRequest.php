<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Requests;

use Evgeeen\Models\Dto\AbstractDto;

class GetCampaignRequest extends AbstractDto
{
    public function __construct(
        public readonly ?array $campaignIds = null,
        public readonly ?string $advObjectType = null,
        public readonly ?string $state = null,
    ) {
    }
}