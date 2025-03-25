<?php

declare(strict_types = 1);

namespace Evgeeen\Exceptions;

use RuntimeException;

class RequestFailedException extends RuntimeException
{
    protected int $responseCode;

    protected string $responseBody;

    public function __construct(int $code, string $body)
    {
        $this->responseCode = $code;
        $this->responseBody = $body;

        parent::__construct(sprintf('Service return is %s code', $code));
    }

    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    public function getResponseBody(): string
    {
        return $this->responseBody;
    }
}
