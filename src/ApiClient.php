<?php

namespace FondOf\Airtable;

use FondOf\Airtable\Exception\MissingConfigException;
use FondOf\Airtable\Service\HttpInterface;

class ApiClient implements ApiClientInterface
{
    /**
     * @var string Airtable Api
     */
    protected $apiUrl = 'https://api.airtable.com';

    /**
     * @var string Airtable API Version
     */
    protected $apiVersion = 'v0';

    /**
     * @var string Airtable base project
     */
    protected $base = '';

    /**
     * @var string Table in base project
     */
    protected $table = '';

    /**
     * @var int Max numbers of records to return
     */
    protected $limit = 10;

    /**
     * @var string Page offset if records > limit
     */
    protected $offset = '';

    /**
     * @var string Airtable API key
     */
    private $apiKey = '';

    /**
     * @var Service\HttpInterface
     */
    private $service;


    /**
     * @param HttpInterface $service
     * @param array<mixed> $config
     * @throws MissingConfigException
     */
    public function __construct(HttpInterface $service, array $config)
    {
        if (!isset($config['apiKey'])) {
            throw new MissingConfigException('Airtable API Key is missing from the Config');
        }

        foreach ($config as $key => $value) {
            if (property_exists(self::class, (string)$key)) {
                $this->{$key} = $value;
            }
        }

        $this->service = $service;
        $this->service->addHeaders(['Authorization' => 'Bearer ' . $this->apiKey]);
    }

    /**
     * @param string $base
     * @param string $table
     * @return bool|string
     */
    public function getRecords(string $base, string $table)
    {
        $params = '?maxRecords=' . $this->limit;
        return $this->service->get(sprintf('%s/%s/%s%s', $this->apiUrl(), $base, $table, $params));
    }

    /**
     * @param string $base      Airtable base id
     * @param string $table     Airtable table id
     * @param string $id        Table record id
     * @return bool|string
     */
    public function getRecord(string $base, string $table, string $id)
    {
        return $this->service->get(sprintf('%s/%s/%s/%s', $this->apiUrl(), $base, $table, $id));
    }

    /**
     * @param string        $base       Airtable base id
     * @param string        $table      Airtable table id
     * @param array<string> $fields     Array containing data for the new record
     * @return bool|string
     */
    public function postRecord(string $base, string $table, array $fields)
    {
        $body = [
            'fields' => $fields
        ];
        return $this->service->post(sprintf('%s/%s/%s', $this->apiUrl(), $base, $table), json_encode($body));
    }

    /**
     * @param int $limit    Max number of records to return
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return string
     */
    private function apiUrl(): string
    {
        return $this->apiUrl . '/' . $this->apiVersion;
    }
}
