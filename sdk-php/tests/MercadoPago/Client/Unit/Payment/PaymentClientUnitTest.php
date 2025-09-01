<?php

namespace MercadoPago\Tests\Client\Unit\Payment;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * Payment Client unit tests.
 */
final class PaymentClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Payment/payment_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 201);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentClient();
        $payment = $client->create($this->createRequest());
        $this->assertSame(201, $payment->getResponse()->getStatusCode());
        $this->assertSame(17014025134, $payment->id);
        $this->assertSame("2022-01-10T10:10:10.000-00:00", $payment->date_created);
        $this->assertSame("approved", $payment->status);
        $this->assertSame("128185910", $payment->payer->id);
        $this->assertSame("19119119100", $payment->payer->identification->number);
        $this->assertSame("order_1631894348", $payment->metadata->order_number);
        $this->assertSame("mercadopago_fee", $payment->fee_details[0]->type);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Payment/payment_base.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentClient();
        $payment_id = 17014025134;
        $payment = $client->get($payment_id);
        $this->assertSame(200, $payment->getResponse()->getStatusCode());
        $this->assertSame(17014025134, $payment->id);
    }

    public function testCancelSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Payment/payment_cancelled.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentClient();
        $payment_id = 17014025134;
        $payment = $client->cancel($payment_id);
        $this->assertSame(200, $payment->getResponse()->getStatusCode());
        $this->assertSame(17014025134, $payment->id);
        $this->assertSame("cancelled", $payment->status);
    }

    public function testCaptureSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Payment/payment_captured.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentClient();
        $payment_id = 17014025134;
        $payment = $client->capture($payment_id, 5);
        $this->assertSame(200, $payment->getResponse()->getStatusCode());
        $this->assertSame(17014025134, $payment->id);
        $this->assertTrue($payment->captured);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Payment/payment_search.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentClient();
        $search_request = new \MercadoPago\Net\MPSearchRequest(5, 0, []);
        $search_result = $client->search($search_request);
        $this->assertSame(200, $search_result->getResponse()->getStatusCode());
        $this->assertSame(5, $search_result->paging->limit);
        $this->assertSame(0, $search_result->paging->offset);
        $this->assertSame(102, $search_result->paging->total);
        $this->assertSame(5, count($search_result->results));
        $this->assertSame(1241012238, $search_result->results[0]->id);
    }

    private function createRequest(): array
    {
        $request = [
            "transaction_amount" => 100,
            "description" => "description",
            "payment_method_id" => "pix",
            "payer" => [
                "email" => "test_user_24634097@testuser.com",
            ]
        ];
        return $request;
    }
}
