<?php

declare(strict_types = 1);

namespace Evgeeen\Models;

use Evgeeen\Models\Dto\AbstractDto;

class Campaign extends AbstractDto
{
    public function __construct(
        public readonly string $id,
        public readonly string $paymentType,
        public readonly string $title,
        public readonly string $state,
        public readonly string $advObjectType,
        public readonly string $fromDate,
        public readonly string $toDate,
        public readonly string $budget,
        public readonly string $dailyBudget,
        public readonly string $weeklyBudget,
        public readonly array $placement,
        public readonly string $productAutopilotStrategy,
        public readonly Autopilot $autopilot,
    ) {
    }
}