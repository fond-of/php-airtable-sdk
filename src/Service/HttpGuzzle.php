<?php

namespace FondOf\Airtable\Service;

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
     * @return bool|string
     */
    public function get(string $url)
    {
        $response = $this->client->get($url, [
            'headers' => $this->headers
        ]);

        if ($response->getStatusCode() !== 200) {
            return false;
        }

        return $response->getBody()->getContents();
    }

    /**
     * @param string $url
     * @param string|bool $body
     * @return bool|string
     */
    public function post(string $url, $body)
    {
        $response = $this->client->request('POST', $url, [
            'headers' => $this->headers,
            'body' => $body
        ]);

        if ($response->getStatusCode() !== 200) {
            return false;
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
