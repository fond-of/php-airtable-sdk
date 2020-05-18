<?php

namespace FondOf\Airtable\Service;

use FondOf\Airtable\Exception\ApiRequestException;
use GuzzleHttp\Client;

class HttpGuzzle implements HttpInterface
{
    /**
     * @var Client $client
     */
    private $client;

    /**
     * @var array<mixed>
     */
    protected $headers = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];

    /**
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * @param string $url
     * @return string
     * @throws \FondOf\Airtable\Exception\ApiRequestException
     */
    public function get(string $url): string
    {
        $response = $this->client->get($url, [
            'headers' => $this->headers
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new ApiRequestException($response->getReasonPhrase(), $response->getStatusCode());
        }

        return $response->getBody()->getContents();
    }

    /**
     * @param string $url
     * @param string $body
     * @return string
     * @throws \FondOf\Airtable\Exception\ApiRequestException
     */
    public function post(string $url, string $body): string
    {
        $response = $this->client->request('POST', $url, [
            'headers' => $this->headers,
            'body' => $body
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new ApiRequestException($response->getReasonPhrase(), $response->getStatusCode());
        }

        return $response->getBody()->getContents();
    }

    /**
     * @param array<mixed> $headers
     * @return HttpInterface
     */
    public function addHeaders(array $headers): HttpInterface
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }
}
