<?php

namespace FondOf\Airtable\Service;

interface HttpInterface
{
    /**
     * Send a GET request
     * @param string $url
     * @return string
     */
    public function get(string $url): string;

    /**
     * Send a POST request
     * @param string $url
     * @param string $body
     * @return string
     */
    public function post(string $url, string $body): string;

    /**
     * Merge custom HTTP headers
     * @param array<mixed> $headers
     * @return HttpInterface
     */
    public function addHeaders(array $headers): HttpInterface;
}
