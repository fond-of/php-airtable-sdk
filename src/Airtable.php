<?php

namespace FondOf\Airtable;

class Airtable
{
    /**
     * @var string Package Version
     */
    protected $version = '1.0.0';

    /**
     * @var array<mixed> Configuration overwrites
     */
    protected $config;

    /**
     * @param array<mixed> $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Create a new Airtable API Client
     * @return ApiClient
     * @throws Exception\MissingConfigException
     */
    public function createApiClient()
    {
        return new ApiClient(
            new Service\HttpGuzzle(),
            $this->config
        );
    }
}
