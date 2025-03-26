<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Requests;

use DateTime;
use Evgeeen\Models\Dto\AbstractDto;

class GetCampaignStatisticRequest extends AbstractDto
{
    public const DATE_FORMAT = DateTime::RFC3339;
    public const GROUP_BY_DATE = 'DATE';
    public const GROUP_BY_WEEK = 'START_OF_WEEK';
    public const GROUP_BY_MONTH = 'START_OF_MONTH';

    public function __construct(
        public readonly array $campaigns,
        protected readonly ?string $from = null,
        protected readonly ?string $to = null,
        protected readonly ?string $dateFrom = null,
        protected readonly ?string $dateTo = null,
        protected readonly ?string $groupBy = null,
    ) {
    }
}