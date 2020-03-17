<?php

namespace FondOf\Airtable;

interface ApiClientInterface
{
    /**
     * Return all records for a table in the specified base
     * @param string $base
     * @param string $table
     * @return bool|string
     */
    public function getRecords(string $base, string $table);

    /**
     * Return a specific record by id from the table
     * @param string $base
     * @param string $table
     * @param string $id
     * @return mixed
     */
    public function getRecord(string $base, string $table, string $id);

    /**
     * Create a new record in the given table
     * @param string        $base
     * @param string        $table
     * @param array<string> $fields
     * @return mixed
     */
    public function postRecord(string $base, string $table, array $fields);

    /**
     * Set max number of records to return
     * @param int $limit
     * @return void
     */
    public function setLimit(int $limit): void;
}
