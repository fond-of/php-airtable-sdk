<?php

namespace FondOf\Airtable;

interface TableInterface
{
    /**
     * @param array<string> $fields
     *
     * @return string
     */
    public function writeRecord(array $fields): string;

    /**
     * @param string $id
     *
     * @return string
     */
    public function getRecord(string $id): string;

    /**
     * @return string
     */
    public function getRecords(): string;

    /**
     * @param string $base
     *
     * @return \FondOf\Airtable\TableInterface
     */
    public function base(string $base): TableInterface;

    /**
     * @param string $table
     *
     * @return \FondOf\Airtable\TableInterface
     */
    public function table(string $table): TableInterface;

    /**
     * @param int $limit
     *
     * @return \FondOf\Airtable\TableInterface
     */
    public function limit(int $limit): TableInterface;
}
