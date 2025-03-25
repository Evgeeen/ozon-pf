<?php

declare(strict_types = 1);

namespace Evgeeen\OAuth2;

use Evgeeen\AbstractClient;
use Evgeeen\Client;
use Evgeeen\Exceptions\RequestException;
use Evgeeen\Exceptions\RequestFailedException;
use Evgeeen\OAuth2\Credentials\OAuth2CredentialsInterface;
use GuzzleHttp\Exception\ClientException;
use Throwable;

abstract class OAuth2Client extends AbstractClient
{
    protected ?AccessToken $accessToken = null;

    abstract protected function credentials(): OAuth2CredentialsInterface;

    abstract protected function getTokenUrl(): string;

    abstract protected function createAccessToken(array $response): AccessToken;

    /**
     * @throws RequestException
     * @throws RequestFailedException
     */
    protected function configureOptions(array $options): array
    {
        $token = $this->getAccessToken();
        $options['headers']['Authorization'] = 'Bearer ' . $token->getToken();

        return $options;
    }

    /**
     * @throws RequestException
     * @throws RequestFailedException
     */
    protected function getAccessToken(): AccessToken
    {
        if (is_null($this->accessToken) || $this->accessToken->isExpired()) {
            $this->refreshToken();
        }

        return $this->accessToken;
    }

    /**
     * @throws RequestException
     * @throws RequestFailedException
     */
    protected function refreshToken(): void
    {
        try {
            $response = $this->client()
                ->post($this->getTokenUrl(), ['form_params' => $this->credentials()->getRequestBody()]);

            $this->accessToken = $this->createAccessToken(
                json_decode((string)$response->getBody(), true)
            );
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $code = $response->getStatusCode();

            throw new RequestFailedException($code, (string)$response->getBody());
        } catch (Throwable $e) {
            throw new RequestException($e->getMessage(), $e->getCode(), $e);
        }
    }
}