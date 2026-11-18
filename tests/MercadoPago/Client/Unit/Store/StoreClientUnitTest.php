<?php

namespace MercadoPago\Tests\Client\Unit\Store;

use MercadoPago\Client\Store\StoreClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * Store Client unit tests.
 */
final class StoreClientUnitTest extends BaseClient
{
    private const USER_ID = 123456789;
    private const STORE_ID = "1234567";

    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_create.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->create(self::USER_ID, $this->createRequest());
        $this->assertSame(201, $store->getResponse()->getStatusCode());
        $this->assertSame("1234567", $store->id);
        $this->assertSame("Official Store", $store->name);
        $this->assertSame("2023-09-04T09:00:57.374-04:00", $store->date_created);
        $this->assertSame("123456789", $store->user_id);
        $this->assertSame("active", $store->status);

        $this->assertSame("Casa", $store->location->address_line);
        $this->assertSame("02675031", $store->location->zip_code);
        $this->assertSame("Av. das Nações Unidas", $store->location->street_name);
        $this->assertSame("3000", $store->location->street_number);
        $this->assertSame(-23.5, $store->location->latitude);
        $this->assertSame(-46.5, $store->location->longitude);
        $this->assertSame("BR-SP-45", $store->location->city->id);
        $this->assertSame("Osasco", $store->location->city->name);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_get.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->get(self::STORE_ID);
        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame("1234567", $store->id);
        $this->assertSame("Official Store", $store->name);
        $this->assertSame("2023-09-04T09:00:57.374-04:00", $store->date_created);
        $this->assertSame("123456789", $store->user_id);
        $this->assertSame("active", $store->status);

        $this->assertSame("Casa", $store->location->address->id);
        $this->assertSame("02675031", $store->location->address->zip_code);
        $this->assertSame("Av. das Nações Unidas", $store->location->address->street_name);
        $this->assertSame("3000", $store->location->address->street_number);
        $this->assertSame("BR-SP-45", $store->location->address->city->id);
        $this->assertSame("Osasco", $store->location->address->city->name);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $stores = $client->search(self::USER_ID);
        $this->assertSame(200, $stores->getResponse()->getStatusCode());
        $this->assertSame(10, $stores->paging->limit);
        $this->assertSame(0, $stores->paging->offset);
        $this->assertSame(2, $stores->paging->total);
        $this->assertSame(2, count($stores->results));

        $this->assertSame("1234567", $stores->results[0]->id);
        $this->assertSame("Official Store", $stores->results[0]->name);
        $this->assertSame("123456789", $stores->results[0]->user_id);
        $this->assertSame("active", $stores->results[0]->status);
        $this->assertSame("Casa", $stores->results[0]->location->address->id);
        $this->assertSame("02675031", $stores->results[0]->location->address->zip_code);
        $this->assertSame("Av. das Nações Unidas", $stores->results[0]->location->address->street_name);
        $this->assertSame("3000", $stores->results[0]->location->address->street_number);
        $this->assertSame("BR-SP-45", $stores->results[0]->location->address->city->id);
        $this->assertSame("Osasco", $stores->results[0]->location->address->city->name);

        $this->assertSame("7654321", $stores->results[1]->id);
        $this->assertSame("Second Store", $stores->results[1]->name);
        $this->assertSame("123456789", $stores->results[1]->user_id);
        $this->assertSame("active", $stores->results[1]->status);
        $this->assertSame("1322811505", $stores->results[1]->location->address->id);
        $this->assertSame("02675031", $stores->results[1]->location->address->zip_code);
        $this->assertSame("Av. das Nações Unidas", $stores->results[1]->location->address->street_name);
        $this->assertSame("3000", $stores->results[1]->location->address->street_number);
        $this->assertSame("BR-SP-45", $stores->results[1]->location->address->city->id);
        $this->assertSame("Osasco", $stores->results[1]->location->address->city->name);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_update.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->update(self::STORE_ID, $this->updateRequest());
        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame("1234567", $store->id);
        $this->assertSame("Updated Store", $store->name);
        $this->assertSame("123456789", $store->user_id);
        $this->assertSame("active", $store->status);
        $this->assertSame("2023-09-04T09:00:57.374-04:00", $store->date_last_updated);
    }

    public function testDeleteSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_delete.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->delete(self::STORE_ID);
        $this->assertSame(200, $store->getResponse()->getStatusCode());
    }

    private function createRequest(): array
    {
        $request = [
            "name" => "Official Store",
            "business_hours" => [
                "monday" => [
                    "open" => "08:00",
                    "close" => "18:00",
                ],
                "tuesday" => [
                    "open" => "08:00",
                    "close" => "18:00",
                ],
            ],
            "location" => [
                "address_line" => "Av. das Nações Unidas, 3000",
                "zip_code" => "02675031",
                "street_name" => "Av. das Nações Unidas",
                "street_number" => "3000",
                "latitude" => -23.5,
                "longitude" => -46.5,
                "city" => [
                    "id" => "BR-SP-45",
                    "name" => "Osasco",
                ],
            ],
        ];
        return $request;
    }

    private function updateRequest(): array
    {
        $request = [
            "name" => "Updated Store",
            "business_hours" => [
                "monday" => [
                    "open" => "09:00",
                    "close" => "20:00",
                ],
            ],
        ];
        return $request;
    }
}
