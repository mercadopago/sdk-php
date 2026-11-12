<?php

namespace MercadoPago\Tests\Client\Unit\Store;

use MercadoPago\Client\Store\StoreClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * Store Client unit tests.
 */
final class StoreClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->create(123456789, $this->createRequest());

        $this->assertSame(201, $store->getResponse()->getStatusCode());
        $this->assertSame(2711281835, $store->id);
        $this->assertSame("Official Store", $store->name);
        $this->assertSame("2023-09-13T16:23:15.000-04:00", $store->date_created);
        $this->assertSame("STORE-123", $store->external_id);
        $this->assertSame(123456789, $store->user_id);
        $this->assertSame("08:00", $store->business_hours->monday[0]->open);
        $this->assertSame("12:00", $store->business_hours->monday[0]->close);
        $this->assertSame("18:00", $store->business_hours->tuesday[0]->close);
        $this->assertSame("Av. das Nacoes Unidas, 3000", $store->location->address_line);
        $this->assertSame("Floor 2", $store->location->reference);
        $this->assertSame("Osasco", $store->location->city->name);
        $this->assertSame("Sao Paulo", $store->location->state->name);
        $this->assertSame("06233-000", $store->location->zip_code);
        $this->assertSame("Brasil", $store->location->country_name);
        $this->assertSame("Near the main avenue", $store->location->comments);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->get(2711281835);

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(2711281835, $store->id);
        $this->assertSame("Official Store", $store->name);
        $this->assertSame("STORE-123", $store->external_id);
        $this->assertSame(123456789, $store->user_id);
        $this->assertSame("Av. das Nacoes Unidas, 3000", $store->location->address_line);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $search_request = new MPSearchRequest(10, 0, []);
        $search_result = $client->search(123456789, $search_request);

        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(1, count($search_result->elements));
        $this->assertSame(2711281835, $search_result->elements[0]->id);
        $this->assertSame("Official Store", $search_result->elements[0]->name);
        $this->assertSame("STORE-123", $search_result->elements[0]->external_id);
        $this->assertSame(1, $search_result->next_offset);
        $this->assertSame(1, $search_result->total);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->update(123456789, 2711281835, $this->updateRequest());

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(2711281835, $store->id);
        $this->assertSame("Official Store", $store->name);
        $this->assertSame("STORE-123", $store->external_id);
    }

    public function testDeleteSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $result = $client->delete(123456789, 2711281835);

        $this->assertSame(200, $result->getResponse()->getStatusCode());
        $this->assertSame(2711281835, $result->id);
    }

    private function createRequest(): array
    {
        $request = [
            "name" => "Official Store",
            "business_hours" => [
                "monday" => [
                    ["open" => "08:00", "close" => "12:00"],
                    ["open" => "14:00", "close" => "18:00"],
                ],
                "tuesday" => [
                    ["open" => "08:00", "close" => "18:00"],
                ],
            ],
            "location" => [
                "address_line" => "Av. das Nacoes Unidas, 3000",
                "reference" => "Floor 2",
                "city" => [
                    "id" => "TUxBQ09TQVMyMTVa",
                    "name" => "Osasco",
                ],
                "state" => [
                    "id" => "TUxBUFNBTzI1MzVa",
                    "name" => "Sao Paulo",
                ],
                "zip_code" => "06233-000",
                "country_name" => "Brasil",
                "latitude" => -23.533773,
                "longitude" => -46.792833,
                "comments" => "Near the main avenue",
            ],
            "external_id" => "STORE-123",
        ];
        return $request;
    }

    private function updateRequest(): array
    {
        $request = [
            "name" => "Official Store",
        ];
        return $request;
    }
}
