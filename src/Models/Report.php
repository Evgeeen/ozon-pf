<?php

declare(strict_types = 1);

namespace Evgeeen\Models;

use Evgeeen\Models\Dto\AbstractDto;

class Report extends AbstractDto
{
      public function __construct(
        public readonly Campains
      ) {
      }
}