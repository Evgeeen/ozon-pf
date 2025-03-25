<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Responses;

use Evgeeen\Models\Campaign;
use Evgeeen\Models\Dto\AbstractDtoCollection;

class GetCampaignResponse extends AbstractDtoCollection
{
    protected function type(): string
    {
        return Campaign::class;
    }
}