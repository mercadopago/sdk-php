<?php

namespace MercadoPago\Tests\Client\Unit\Store;

use MercadoPago\Client\Store\StoreClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * StoreClient unit tests.
 */
final class StoreClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->create(1160535239, ["name" => "Test Store"]);

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(1706996, $store->id);
        $this->assertSame("Test Store", $store->name);
        $this->assertSame("MLB", $store->business_hours->monday->open);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->get(1706996);

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(1706996, $store->id);
        $this->assertSame("Test Store", $store->name);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $search_result = $client->search(1160535239, new MPSearchRequest(10, 0));

        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(1, $search_result->paging->total);
        $this->assertSame(1, count($search_result->results));
        $this->assertSame(1706996, $search_result->results[0]->id);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_update.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->update(1706996, ["name" => "Updated Store"]);

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(1706996, $store->id);
        $this->assertSame("Updated Store", $store->name);
    }

    public function testDeleteSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_delete.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->delete(1706996);

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(1706996, $store->id);
    }
}
