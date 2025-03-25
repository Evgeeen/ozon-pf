<?php

declare(strict_types = 1);

namespace Evgeeen\OAuth2\Credentials;

class ClientCredentials implements OAuth2CredentialsInterface
{
    private const GRANT_TYPE = 'client_credentials';

    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
        private readonly string $scope = "",
        private readonly string $audience = ""
    ) {

    }

    public function getGrantType(): string
    {
        return self::GRANT_TYPE;
    }

    public function getRequestBody(): array
    {
        return  [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope' => $this->scope,
            'audience' => $this->audience,
            'grant_type' => self::GRANT_TYPE
        ];
    }
}