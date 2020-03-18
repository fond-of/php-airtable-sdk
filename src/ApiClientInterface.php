<?php

namespace FondOf\Airtable;

interface ApiClientInterface
{
    /**
     * Return all records for a table in the specified base
     * @param string $base
     * @param string $table
     * @return string
     */
    public function listRecords(string $base, string $table): string;

    /**
     * Return a specific record by id from the table
     * @param string $base
     * @param string $table
     * @param string $id
     * @return string
     */
    public function listRecord(string $base, string $table, string $id): string;

    /**
     * Create a new record in the given table
     * @param string        $base
     * @param string        $table
     * @param array<string> $fields
     * @return string
     */
    public function createRecord(string $base, string $table, array $fields): string;

    /**
     * Set max number of records to return
     * @param int $limit
     * @return void
     */
    public function setLimit(int $limit): void;
}
