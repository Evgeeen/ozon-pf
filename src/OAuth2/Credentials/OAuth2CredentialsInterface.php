<?php

declare(strict_types = 1);

namespace Evgeeen\OAuth2\Credentials;

interface OAuth2CredentialsInterface
{
    public function getGrantType(): string;

    public function getRequestBody(): array;
}