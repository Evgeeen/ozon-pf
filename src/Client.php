<?php

declare(strict_types = 1);

namespace Evgeeen;

use Evgeeen\OAuth2\AccessToken;
use Evgeeen\OAuth2\Credentials\ClientCredentials;
use Evgeeen\OAuth2\Credentials\OAuth2CredentialsInterface;
use Evgeeen\OAuth2\OAuth2Client;
use DateTimeImmutable;

class Client extends OAuth2Client
{
    protected const SERVICE_URL = "https://api-performance.ozon.ru";
    protected const TOKEN_URL = "https://api-performance.ozon.ru/api/client/token";

    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret
    ) {
    }

    protected function serviceUrl(): string
    {
        return self::SERVICE_URL;
    }

    protected function credentials(): OAuth2CredentialsInterface
    {
        return new ClientCredentials($this->clientId, $this->clientSecret);
    }

    protected function createAccessToken(array $response): AccessToken
    {
        return new AccessToken(
            $response['access_token'],
            $response['token_type'],
            new DateTimeImmutable(),
        );
    }

    protected function getTokenUrl(): string
    {
        return self::TOKEN_URL;
    }
}