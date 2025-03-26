<?php

declare(strict_types = 1);

namespace Evgeeen\Models;

use Evgeeen\Models\Dto\AbstractDto;
use Evgeeen\Models\Responses\Report;

class ReportRequest extends AbstractDto
{
      public function __construct(
          public readonly Campaigns $campaigns,
          public readonly Report $meta,
          public readonly string $name,
      ) {
      }
}