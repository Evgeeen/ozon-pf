<?php

declare(strict_types=1);

namespace Evgeeen\Models;

use Evgeeen\Models\Dto\AbstractDto;

class CampaignItem extends AbstractDto
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
    ) {
    }
}