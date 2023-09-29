<?php

namespace MercadoPago\Tests\Client\Unit\MerchantOrder;

use MercadoPago\Client\MerchantOrder\MerchantOrderClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * Merchant Order Client unit tests.
 */
final class MerchantOrderClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/MerchantOrder/merchant_order_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new MerchantOrderClient();
        $merchant_order = $client->create($this->createRequest());

        $this->assertSame(201, $merchant_order->getResponse()->getStatusCode());
        $this->assertSame(11223344550, $merchant_order->id);
        $this->assertSame("opened", $merchant_order->status);
        $this->assertSame("123456789-ceb44a1c-6d7c-4996-99c6-24060542ed9f", $merchant_order->preference_id);
        $this->assertSame("2023-09-12T13:55:01.933-04:00", $merchant_order->date_created);
        $this->assertSame("2023-09-12T13:55:01.933-04:00", $merchant_order->last_updated);
        $this->assertSame("MP-MKT-5887075667929427", $merchant_order->marketplace);
        $this->assertSame("test_reference", $merchant_order->external_reference);
        $this->assertSame(123456789, $merchant_order->collector->id);
        $this->assertSame("MLB_SELLER", $merchant_order->collector->nickname);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/MerchantOrder/merchant_order_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new MerchantOrderClient();
        $merchant_order_id = 11223344550;
        $merchant_order = $client->get($merchant_order_id);

        $this->assertSame(200, $merchant_order->getResponse()->getStatusCode());
        $this->assertSame(11223344550, $merchant_order->id);
        $this->assertSame("opened", $merchant_order->status);
        $this->assertSame("123456789-ceb44a1c-6d7c-4996-99c6-24060542ed9f", $merchant_order->preference_id);
        $this->assertSame("2023-09-12T13:55:01.933-04:00", $merchant_order->date_created);
        $this->assertSame("2023-09-12T13:55:01.933-04:00", $merchant_order->last_updated);
        $this->assertSame("MP-MKT-5887075667929427", $merchant_order->marketplace);
        $this->assertSame("test_reference", $merchant_order->external_reference);
        $this->assertSame(123456789, $merchant_order->collector->id);
        $this->assertSame("MLB_SELLER", $merchant_order->collector->nickname);
    }

    public function testUpdateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/MerchantOrder/merchant_order_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new MerchantOrderClient();
        $merchant_order_id = 11223344550;
        $merchant_order = $client->update($merchant_order_id, $this->updateRequest());

        $this->assertSame(200, $merchant_order->getResponse()->getStatusCode());
        $this->assertSame(11223344550, $merchant_order->id);
        $this->assertSame("opened", $merchant_order->status);
        $this->assertSame("123456789-ceb44a1c-6d7c-4996-99c6-24060542ed9f", $merchant_order->preference_id);
        $this->assertSame("2023-09-12T13:55:01.933-04:00", $merchant_order->date_created);
        $this->assertSame("2023-09-12T13:55:01.933-04:00", $merchant_order->last_updated);
        $this->assertSame("MP-MKT-5887075667929427", $merchant_order->marketplace);
        $this->assertSame("test_reference", $merchant_order->external_reference);
        $this->assertSame(123456789, $merchant_order->collector->id);
        $this->assertSame("MLB_SELLER", $merchant_order->collector->nickname);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/MerchantOrder/merchant_order_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new MerchantOrderClient();
        $preference_id = "123456789-ceb44a1c-6d7c-4996-99c6-24060542ed9f";
        $search_request = new \MercadoPago\Net\MPSearchRequest(5, 0, ["preference_id" => $preference_id]);
        $search_result = $client->search($search_request);

        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(1, count($search_result->elements));
        $this->assertSame("123456789-ceb44a1c-6d7c-4996-99c6-24060542ed9f", $search_result->elements[0]->preference_id);
        $this->assertSame(1, $search_result->next_offset);
        $this->assertSame(1, $search_result->total);
    }

    private function createRequest(): array
    {
        $request = [
            "external_reference" => "test_reference",
            "preference_id" => "123456789-ceb44a1c-6d7c-4996-99c6-24060542ed9f",
        ];
        return $request;
    }

    private function updateRequest(): array
    {
        $request = [
            "notification_url" => "https://www.test.com"
        ];
        return $request;
    }
}
