<?php


namespace FondOf\Airtable\unit;

use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use FondOf\Airtable\ApiClient;
use FondOf\Airtable\Service\HttpGuzzle;
use FondOf\Airtable\Table;

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

}