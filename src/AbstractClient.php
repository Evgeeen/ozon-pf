<?php

declare(strict_types = 1);

namespace Evgeeen;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Evgeeen\Exceptions\RequestException;
use Evgeeen\Exceptions\RequestFailedException;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractClient
{
    private ?GuzzleClient $client = null;

    abstract protected function serviceUrl(): string;

    abstract protected function configureOptions(array $options): array;

    protected function sendRequest(string $method, string $source, array $options = []): ResponseInterface
    {
        try {
            $response = $this->client()->request($method, $this->buildUri($source), $this->configureOptions($options));
        } catch (ClientException $e) {
            throw new RequestFailedException($e->getCode(), (string)$e->getResponse()->getBody()->getContents());
        } catch (RequestException $e) {
            throw new RequestException($e->getMessage());
        }

        return $response;
    }

    protected function client(): GuzzleClient
    {
        return $this->client ??= new GuzzleClient();
    }

    private function buildUri(string $source): string
    {
        return sprintf("%s/%s", $this->serviceUrl(), $source);
    }

    protected function getDecodedBody($body): array
    {
        $result = json_decode((string)$body, true);

        return is_array($result) ? $result : [];
    }

    protected function prepareUri(string $uri, array $replacement): string
    {
        $placeholders = array_map(fn(string $placeholder) => "#{{$placeholder}}#", array_keys($replacement));

        return preg_replace($placeholders, array_values($replacement), $uri);
    }
}
