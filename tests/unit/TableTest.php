<?php


namespace FondOf\Airtable\unit;

use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use FondOf\Airtable\ApiClient;
use FondOf\Airtable\Table;

class TableTest extends Unit
{
    function test_get_records()
    {
        $client = $this->make(ApiClient::class, [
            'getRecords' => Expected::once('foo')
        ]);
        $table = new Table($client);

        $response = $table->getRecords();

        $this->assertEquals('foo', $response);
    }

    function test_get_record()
    {
        $client = $this->make(ApiClient::class, [
            'getRecord' => Expected::once('bar')
        ]);
        $table = new Table($client);

        $response = $table->getRecord('1');

        $this->assertEquals('bar', $response);
    }

    function test_write_record()
    {
        $client = $this->make(ApiClient::class, [
            'postRecord' => Expected::once('bar')
        ]);
        $table = new Table($client);

        $fields = [
            'Name' => 'Bar',
            'Notes' => 'Foo',
            'Foobar' => 'Foobar',
            'Attachments' => [
                [
                    'url' => 'https://foobar.jpg',
                    'filename' => 'test'
                ],
            ]
        ];

        $response = $table->writeRecord($fields);

        $this->assertEquals('bar', $response);
    }

}