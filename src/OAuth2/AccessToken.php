<?php

declare(strict_types = 1);

namespace Evgeeen\OAuth2;

use DateTimeImmutable;

class AccessToken
{
    protected string $token;

    protected string $tokenType;

    protected DateTimeImmutable $expires;

    public function __construct(string $token, string $tokenType, DateTimeImmutable $expires)
    {
        $this->token = $token;
        $this->tokenType = $tokenType;
        $this->expires = $expires;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function isExpired(): bool
    {
        return $this->expires->getTimestamp() < time();
    }
}