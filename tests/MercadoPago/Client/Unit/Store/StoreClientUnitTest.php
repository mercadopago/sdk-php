<?php

namespace MercadoPago\Tests\Client\Unit\Store;

use MercadoPago\Client\Store\StoreClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\HttpMethod;
use MercadoPago\Net\MPSearchRequest;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * StoreClient unit tests.
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
        $store = $client->create(123456, $this->createRequest());

        $this->assertSame(201, $store->getResponse()->getStatusCode());
        $this->assertSame(123456, $store->id);
        $this->assertSame("Test Store", $store->name);
        $this->assertSame("1234", $store->external_id);
        $this->assertSame("active", $store->status);
        $this->assertSame("Test Address 123", $store->location->address_line);
        $this->assertSame("01001000", $store->location->zip_code);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->get(123456, 1234);

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(123456, $store->id);
        $this->assertSame("Test Store", $store->name);
        $this->assertSame("1234", $store->external_id);
        $this->assertSame("active", $store->status);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $search_request = new MPSearchRequest(5, 0, ["external_id" => "1234"]);
        $search_result = $client->search(123456, $search_request);

        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(1, count($search_result->results));
        $this->assertSame(123456, $search_result->results[0]->id);
        $this->assertSame("Test Store", $search_result->results[0]->name);
        $this->assertSame(1, $search_result->paging->total);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->update(123456, 1234, $this->updateRequest());

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(123456, $store->id);
        $this->assertSame("Test Store", $store->name);
    }

    public function testDeleteSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $store = $client->delete(123456, 1234);

        $this->assertSame(200, $store->getResponse()->getStatusCode());
        $this->assertSame(123456, $store->id);
    }

    public function testCreateFailure(): void
    {
        $this->expectException(MPApiException::class);
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 400);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $client->create(123456, $this->createRequest());
    }

    public function testCreateSendsPostToStoresPath(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);
        $mock_http_request->expects($this->once())->method('setOptionArray')
            ->with($this->callback(function (array $options): bool {
                return strpos($options[CURLOPT_URL], '/stores') !== false
                    && $options[CURLOPT_CUSTOMREQUEST] === HttpMethod::POST;
            }));

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $client->create(123456, $this->createRequest());
    }

    public function testGetSendsGetToStorePath(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $mock_http_request->expects($this->once())->method('setOptionArray')
            ->with($this->callback(function (array $options): bool {
                return strpos($options[CURLOPT_URL], '/stores/1234') !== false
                    && $options[CURLOPT_CUSTOMREQUEST] === HttpMethod::GET;
            }));

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $client->get(123456, 1234);
    }

    public function testSearchSendsGetToStoresPath(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $mock_http_request->expects($this->once())->method('setOptionArray')
            ->with($this->callback(function (array $options): bool {
                return strpos($options[CURLOPT_URL], '/stores') !== false
                    && $options[CURLOPT_CUSTOMREQUEST] === HttpMethod::GET;
            }));

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $client->search(123456, new MPSearchRequest(5, 0, ["external_id" => "1234"]));
    }

    public function testUpdateSendsPutToStorePath(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $mock_http_request->expects($this->once())->method('setOptionArray')
            ->with($this->callback(function (array $options): bool {
                return strpos($options[CURLOPT_URL], '/stores/1234') !== false
                    && $options[CURLOPT_CUSTOMREQUEST] === HttpMethod::PUT;
            }));

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $client->update(123456, 1234, $this->updateRequest());
    }

    public function testDeleteSendsDeleteToStorePath(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $mock_http_request->expects($this->once())->method('setOptionArray')
            ->with($this->callback(function (array $options): bool {
                return strpos($options[CURLOPT_URL], '/stores/1234') !== false
                    && $options[CURLOPT_CUSTOMREQUEST] === HttpMethod::DELETE;
            }));

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $client->delete(123456, 1234);
    }

    public function testGetFailure(): void
    {
        $this->expectException(MPApiException::class);
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 404);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $client->get(123456, 1234);
    }

    public function testSearchFailure(): void
    {
        $this->expectException(MPApiException::class);
        $filepath = '../../../../Resources/Mocks/Response/Store/store_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 400);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $client->search(123456, new MPSearchRequest(5, 0, ["external_id" => "1234"]));
    }

    public function testUpdateFailure(): void
    {
        $this->expectException(MPApiException::class);
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 400);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $client->update(123456, 1234, $this->updateRequest());
    }

    public function testDeleteFailure(): void
    {
        $this->expectException(MPApiException::class);
        $filepath = '../../../../Resources/Mocks/Response/Store/store_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 400);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new StoreClient();
        $client->delete(123456, 1234);
    }

    private function createRequest(): array
    {
        $request = [
            "name" => "Test Store",
            "external_id" => "1234",
            "location" => [
                "address_line" => "Test Address 123",
                "zip_code" => "01001000",
            ]
        ];
        return $request;
    }

    private function updateRequest(): array
    {
        $request = [
            "name" => "Test Store"
        ];
        return $request;
    }
}
