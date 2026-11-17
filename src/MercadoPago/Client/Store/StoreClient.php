<?php

namespace MercadoPago\Client\Store;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\MercadoPagoClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPHttpClient;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Resources\Store;
use MercadoPago\Resources\StoreSearch;
use MercadoPago\Serialization\Serializer;

/**
 * StoreClient unit tests.
 */
final class StoreClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new \MercadoPago\Net\MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->create(1160535239, $this->createRequest());

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(1023456789, $store->id);
        $this->assertSame("Test Store", $store->name);
        $this->assertSame(1160535239, $store->user_id);
        $this->assertSame("STORE_001", $store->external_id);
        $this->assertSame("08:00", $store->business_hours->monday->open);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new \MercadoPago\Net\MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->get(1023456789);

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(1023456789, $store->id);
        $this->assertSame("Test Store", $store->name);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new \MercadoPago\Net\MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $search_result = $client->search(1160535239, new MPSearchRequest(10, 0));

        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(1, $search_result->paging->total);
        $this->assertSame(1, count($search_result->results));
        $this->assertSame(1023456789, $search_result->results[0]->id);
        $this->assertSame("Test Store", $search_result->results[0]->name);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_update.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new \MercadoPago\Net\MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->update(1160535239, 1023456789, $this->updateRequest());

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(1023456789, $store->id);
        $this->assertSame("Updated Store", $store->name);
        $this->assertSame("Updated Address 456", $store->location->address_line);
ecuted    }

    public function testDeleteSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_delete.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new \MercadoPago\Net\MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->delete(1160535239, 1023456789);

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(1023456789, $store->id);
    }

    private function createRequest(): array
    {
        return [
            "name" => "Test Store",
            "external_id" => "STORE_001",
            "location" => [
                "address_line" => "Test Address 123",
                "city" => "Sao Paulo",
                "state" => "SP",
                "zip_code" => "01310930",
                "latitude" => -23.561684,
                "longitude" => -46.656139,
                "reference" => "Near Paulista Ave"
            ],
            "business_hours" => [
                "monday" => [
                    "open" => "09:00",
                    "close" => "18:00"
                ]
            ]
        ];
    }

    private function updateRequest(): array
    {
        return [
            "name" => "Updated Store",
            "location" => [
                "address_line" => "Updated Address 456",
                "city" => "Sao Paulo",
                "state" => "SP",
                "zip_code" => "01310930",
                "latitude" => -23.561684,
                "longitude" => -46.656139,
                "reference" => "Near Paulista Ave"
            ],
            "business_hours" => [
                "monday" => [
                    "open" => "08:00",
                    "close" => "20:00"
                ]
            ]
        ];
    }
}
