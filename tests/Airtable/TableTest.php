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
            'listRecords' => Expected::once('foo')
        ]);
        $table = new Table($client);

        $response = $table->getRecords();

        $this->assertEquals('foo', $response);
    }

    function test_get_record()
    {
        $client = $this->make(ApiClient::class, [
            'listRecord' => Expected::once('bar')
        ]);
        $table = new Table($client);

        $response = $table->getRecord('1');

        $this->assertEquals('bar', $response);
    }

    function test_write_record()
    {
        $client = $this->make(ApiClient::class, [
            'createRecord' => Expected::once('bar')
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

    function test_set_limit()
    {
        $client = $this->make(ApiClient::class, [
            'setLimit' => Expected::once('bar')
        ]);
        $table = new Table($client);

        $table->limit(100);
    }

    function test_set_exceed_limit()
    {
        $client = $this->make(ApiClient::class);
        $table = new Table($client);

        try {
            $table->limit(101);
        } catch (\Exception $exception) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $exception);
        }

    }

}