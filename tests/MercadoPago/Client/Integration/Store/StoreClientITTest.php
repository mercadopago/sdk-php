<?php

namespace MercadoPago\Tests\Client\Integration\Store;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Store\StoreClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;
use PHPUnit\Framework\TestCase;

/**
 * StoreClient integration tests.
 */
final class StoreClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        $client = new StoreClient();
        $store = $client->create($this->userId(), $this->createRequest());
        $this->assertSame(201, $store->getResponse()->getStatusCode());
        $this->assertNotNull($store->id);
        $this->assertSame("Test store", $store->name);
    }

    public function testCreateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new StoreClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->create($this->userId(), $this->createRequest(), $request_options);
    }

    public function testGetSuccess(): void
    {
        $client = new StoreClient();
        $created_store = $client->create($this->userId(), $this->createRequest());
        $store = $client->get($this->userId(), $created_store->id);
        $this->assertNotNull($store->id);
        $this->assertSame($created_store->id, $store->id);
    }

    public function testGetWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new StoreClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get($this->userId(), "123456", $request_options);
    }

    public function testSearchSuccess(): void
    {
        $client = new StoreClient();
        $created_store = $client->create($this->userId(), $this->createRequest());
        $this->assertNotNull($created_store->id);

        sleep(3);
        $search_request = new MPSearchRequest(30, 0, []);
        $search_result = $client->search($this->userId(), $search_request);
        $this->assertNotNull($search_result->paging);
        $this->assertNotNull($search_result->results);
        $this->assertNotEmpty($search_result->results);
    }

    public function testSearchWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new StoreClient();
        $search_request = new MPSearchRequest(30, 0, []);
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->search($this->userId(), $search_request, $request_options);
    }

    public function testUpdateSuccess(): void
    {
        $client = new StoreClient();
        $created_store = $client->create($this->userId(), $this->createRequest());
        $this->assertNotNull($created_store->id);

        $updated_store = $client->update($this->userId(), $created_store->id, $this->updateRequest());
        $this->assertSame("Updated store name", $updated_store->name);
    }

    public function testUpdateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new StoreClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->update($this->userId(), "123456", $this->updateRequest(), $request_options);
    }

    public function testDeleteSuccess(): void
    {
        $client = new StoreClient();
        $created_store = $client->create($this->userId(), $this->createRequest());
        $this->assertNotNull($created_store->id);

        $deleted_store = $client->delete($this->userId(), $created_store->id);
        $this->assertNotNull($deleted_store->id);
    }

    public function testDeleteWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new StoreClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->delete($this->userId(), "123456", $request_options);
    }

    private function userId(): int
    {
        $user_client = new \MercadoPago\Client\User\UserClient();
        return $user_client->get()->id;
    }

    private function createRequest(): array
    {
        $request = [
            "name" => "Test store",
            "business_hours" => [
                "monday" => [
                    "open" => "08:00",
                    "close" => "18:00"
                ]
            ],
            "location" => [
                "address_line" => "Av. das Nações Unidas, 3003",
                "reference" => "Mercado Pago",
                "city" => [
                    "name" => "São Paulo"
                ],
                "state" => [
                    "name" => "São Paulo"
                ],
                "zip_code" => "01001000",
                "neighborhood" => [
                    "name" => "Centro"
                ],
                "latitude" => -23.5613,
                "longitude" => -46.6565
            ],
            "external_id" => "store_" . rand(100000, 200000)
        ];
        return $request;
    }

    private function updateRequest(): array
    {
        $request = [
            "name" => "Updated store name"
        ];
        return $request;
    }
}
