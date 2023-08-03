<?php

namespace MercadoPago\Client\Payment;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * PaymentClient unit tests.
 */
final class PaymentClientUnitTest extends TestCase
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Payment/payment_base.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 201);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new PaymentClient();
        $payment = $client->create($this->createRequest());
        $this->assertEquals(201, $payment->getResponse()->getStatusCode());
        $this->assertEquals(17014025134, $payment->id);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Payment/payment_base.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 200);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new PaymentClient();
        $payment_id = 17014025134;
        $payment = $client->get($payment_id);
        $this->assertEquals(200, $payment->getResponse()->getStatusCode());
        $this->assertEquals(17014025134, $payment->id);
    }

    public function testCancelSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Payment/payment_cancelled.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 200);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new PaymentClient();
        $payment_id = 17014025134;
        $payment = $client->cancel($payment_id);
        $this->assertEquals(200, $payment->getResponse()->getStatusCode());
        $this->assertEquals(17014025134, $payment->id);
        $this->assertEquals("cancelled", $payment->status);
    }

    public function testCaptureSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Payment/payment_captured.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 200);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new PaymentClient();
        $payment_id = 17014025134;
        $payment = $client->capture($payment_id, 5);
        $this->assertEquals(200, $payment->getResponse()->getStatusCode());
        $this->assertEquals(17014025134, $payment->id);
        $this->assertTrue($payment->captured);
    }

    public function testSearchSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Payment/payment_search.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 200);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new PaymentClient();
        $search_request = new \MercadoPago\Net\MPSearchRequest(5, 0, null);
        $search_result = $client->search($search_request);
        $this->assertEquals(200, $search_result->getResponse()->getStatusCode());
        $this->assertEquals(5, $search_result->paging["limit"]);
        $this->assertNotNull(0, $search_result->paging["offset"]);
        $this->assertNotNull(102, $search_result->paging["total"]);
        $this->assertEquals(5, count($search_result->results));
        $this->assertEquals(1241012238, $search_result->results[0]["id"]);
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

    private function mockHttpRequest(string $filepath, int $status_code): \PHPUnit\Framework\MockObject\MockObject|\MercadoPago\Net\HttpRequest
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject|\MercadoPago\Net\HttpRequest $mockHttpRequest */
        $mockHttpRequest = $this->getMockBuilder(\MercadoPago\Net\HttpRequest::class)->getMock();

        $responseJson = file_get_contents(__DIR__ . $filepath);
        $mockHttpRequest->method('execute')->willReturn($responseJson);
        $mockHttpRequest->method('getInfo')->willReturn($status_code);
        return $mockHttpRequest;
    }
}
