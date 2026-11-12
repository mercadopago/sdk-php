<?php

namespace MercadoPago\Tests\Client\Unit\Store;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Store\StoreClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;
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

        $http_client = new \MercadoPago\Net\MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->create(123456789, $this->createRequest());
        $this->assertSame(201, $store->getResponse()->getStatusCode());
        $this->assertSame("1234567", $store->id);
        $this->assertSame("123456789", $store->user_id);
        $this->assertSame("Loja principal", $store->name);
        $this->assertSame("2023-09-04T09:00:57.374-04:00", $store->date_created);
        $this->assertSame("1234567", $store->external_id);
        $this->assertSame(-23.5966, $store->location->latitude);
        $this->assertSame(-46.6849, $store->location->longitude);
    }

    public function testCreateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new StoreClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->create(123456789, $this->createRequest(), $request_options);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new \MercadoPago\Net\MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->get("1234567");
        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame("1234567", $store->id);
        $this->assertSame("123456789", $store->user_id);
        $this->assertSame("Loja principal", $store->name);
        $this->assertSame("2023-09-04T09:00:57.374-04:00", $store->date_created);
        $this->assertSame("1234567", $store->external_id);
        $this->assertSame(-23.5966, $store->location->latitude);
        $this->assertSame(-46.6849, $store->location->longitude);
    }

    public function testGetWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new StoreClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get("1234567", $request_options);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new \MercadoPago\Net\MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $search_request = new MPSearchRequest(10, 0, ["external_id" => "1234567"]);
        $search_result = $client->search(123456789, $search_request);

        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(10, $search_result->paging->limit);
        $this->assertSame(0, $search_result->paging->offset);
        $this->assertSame(2, $search_result->paging->total);
        $this->assertSame(2, count($search_result->results));
        $this->assertSame("1234567", $search_result->results[0]->id);
        $this->assertSame("Loja principal", $search_result->results[0]->name);
        $this->assertSame(7654321, $search_result->results[1]->id);
        $this->assertSame("Store Two", $search_result->results[1]->name);
    }

    public function testSearchWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new StoreClient();
        $search_request = new MPSearchRequest(10, 0, []);
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->search(123456789, $search_request, $request_options);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new \MercadoPago\Net\MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->update(123456789, "1234567", $this->updateRequest());
        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame("1234567", $store->id);
        $this->assertSame("Loja atualizada", $store->name);
    }

    public function testUpdateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new StoreClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->update(123456789, "1234567", $this->updateRequest(), $request_options);
    }

    public function testDeleteSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new \MercadoPago\Net\MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->delete(123456789, "1234567");
        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame("1234567", $store->id);
    }

    public function testDeleteWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new StoreClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->delete(123456789, "1234567", $request_options);
    }

    private function createRequest(): array
    {
        $request = [
            "name" => "Loja principal",
            "business_hours" => [
                "monday" => [
                    "open" => "08:00",
                    "close" => "18:00",
                ],
            ],
            "location" => [
                "address_line" => "Av. das Nações Unidas, 3000",
                "city_name" => "Osasco",
                "state_name" => "São Paulo",
                "zip_code" => "06233-000",
                "latitude" => -23.5505,
                "longitude" => -46.6333,
            ],
        ];
        return $request;
    }

    private function updateRequest(): array
    {
        $request = [
            "name" => "Loja atualizada",
        ];
        return $request;
    }
}
