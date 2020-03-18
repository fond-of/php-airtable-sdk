<?php

namespace FondOf\Airtable;

use InvalidArgumentException;

class Table
{
    /**
     * @var \FondOf\Airtable\ApiClientInterface
     */
    private $client;

    /**
     * @var string      Airtable base id
     */
    protected $base;

    /**
     * @var string      Airtable table id
     */
    protected $table;

    /**
     * @var string      Table records
     */
    protected $records;

    /**
     * @param \FondOf\Airtable\ApiClientInterface $client
     * @param string $base
     * @param string $table
     */
    public function __construct(ApiClientInterface $client, string $base = '', string $table = '')
    {
        $this->client = $client;
        $this->base = $base;
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getRecords(): string
    {
        $this->records = $this->client->listRecords($this->base, $this->table);
        return $this->records;
    }

    /**
     * Get a single record by id from a table
     * @param string $id    Record id
     * @return string
     */
    public function getRecord(string $id): string
    {
        return $this->client->listRecord($this->base, $this->table, $id);
    }

    /**
     * Create a new record in a table
     * @param array<string> $fields Array containing data for the new record
     * @return mixed
     */
    public function writeRecord(array $fields)
    {
        return $this->client->createRecord($this->base, $this->table, $fields);
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setBase(string $base): void
    {
        $this->base = $base;
    }

    public function getBase(): string
    {
        return $this->base;
    }

    /**
     * Fluent API to set the Airtable base
     * @param string $base     Airtable base id
     * @return $this
     */
    public function base(string $base): Table
    {
        $this->setBase($base);
        return $this;
    }

    /**
     * Fluent API to set the Airtable table
     * @param string $table    Airtable table id
     * @return $this
     */
    public function table(string $table): Table
    {
        $this->setTable($table);
        return $this;
    }

    /**
     * Fluent API to set the limit for returned records
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit): Table
    {
        if ($limit > 100) {
            throw new InvalidArgumentException(
                sprintf('Record limit can\'t must be between 1 and 100. %s given.', $limit)
            );
        }
        $this->client->setLimit($limit);
        return $this;
    }
}
