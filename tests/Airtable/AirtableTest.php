<?php


namespace FondOf\Airtable;

use Codeception\Test\Unit;
use FondOf\Airtable\Exception\MissingConfigException;
use Exception;

class AirtableTest extends Unit
{
    function test_create_api_client(): void
    {
        $config = [
            'apiKey' => 'foobar'
        ];

        $airtable = new Airtable($config);
        $client =  $airtable->createApiClient();

        $this->assertInstanceOf(ApiClient::class, $client);
    }

    function test_missing_api_key(): void
    {
        $airtable = new Airtable();
        try {
            $airtable->createApiClient();
        } catch (Exception $exception) {
            $this->assertInstanceOf(MissingConfigException::class, $exception);
        }

    }
}