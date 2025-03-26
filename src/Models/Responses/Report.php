<?php

declare(strict_types = 1);

namespace Evgeeen\Models\Responses;

use Evgeeen\Models\Dto\AbstractDto;
use Evgeeen\Models\ReportRequest;

class Report extends AbstractDto
{
    public const STATE_NOT_STARTED = 'NOT_STARTED';
    public const STATE_IN_PROGRESS = 'IN_PROGRESS';
    public const STATE_ERROR = 'ERROR';
    public const STATE_OK = 'OK';

    public function __construct(
        public readonly string $UUID,
        public readonly string $state,
        public readonly string $createdAt,
        public readonly string $updatedAt,
        public readonly ReportRequest $request,
        public readonly string $kind,
        public readonly ?string $link = null,
        public readonly ?string $error = null,
    ) {
    }
}