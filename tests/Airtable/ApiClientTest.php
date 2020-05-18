<?php


namespace FondOf\Airtable;

use Codeception\Test\Unit;
use Exception;
use FondOf\Airtable\Service\HttpGuzzle;
use FondOf\Airtable\Exception\NoWriteDataException;

class ApiClientTest extends Unit
{
    protected $client;

    protected function _before()
    {
        $service = $this->make(HttpGuzzle::class, [
            'post' => 'foo',
            'get' => 'bar'
        ]);

        $this->client = new ApiClient(
            $service,
            [
                'apiKey' => 'foobar'
            ]);

        parent::_before();
    }

    function test_list_records()
    {
        $response = $this->client->listRecords('foo', 'bar');

        $this->assertEquals('bar', $response);
    }

    function test_list_record()
    {
        $response = $this->client->listRecord('foo', 'bar', '1');

        $this->assertEquals('bar', $response);
    }

    function test_create_record()
    {
        $response = $this->client->createRecord('foo', 'bar', ['foo' => 'bar']);

        $this->assertEquals('foo', $response);
    }

    function test_create_record_empty_fields()
    {
        try {
            $this->client->createRecord('foo', 'bar', []);
        } catch (Exception $exception) {
            $this->assertInstanceOf(NoWriteDataException::class, $exception);
        }
    }

}