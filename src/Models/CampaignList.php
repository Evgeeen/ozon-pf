<?php

declare(strict_types=1);

namespace Evgeeen\Models;

use Evgeeen\Models\Dto\AbstractDtoCollection;

class CampaignList extends AbstractDtoCollection
{
    protected function type(): string
    {
        return CampaignItem::class;
    }
}