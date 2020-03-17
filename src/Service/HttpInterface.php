<?php

namespace FondOf\Airtable\Service;

interface HttpInterface
{
    /**
     * Send a GET request
     * @param string $url
     * @return bool|string
     */
    public function get(string $url);

    /**
     * Send a POST request
     * @param string $url
     * @param string|bool $body
     * @return bool|string
     */
    public function post(string $url, $body);

    /**
     * Merge custom HTTP headers
     * @param array<mixed> $headers
     * @return HttpInterface
     */
    public function addHeaders(array $headers): HttpInterface;
}
