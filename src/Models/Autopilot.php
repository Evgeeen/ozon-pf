<?php

declare(strict_types = 1);

namespace Evgeeen\Models;

use Evgeeen\Models\Dto\AbstractDto;

class Autopilot extends AbstractDto
{
    public function __construct(
        public readonly string $categoryId,
        public readonly string $skuAddMode,
        public readonly string $createdAt,
        public readonly string $updatedAt,
        public readonly string $productCampaignMode,
    ) {
    }
}