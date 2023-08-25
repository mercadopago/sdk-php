<?php

namespace MercadoPago\Client\PaymentMethod;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * PaymentMethodClient unit tests.
 */
final class PaymentMethodClientUnitTest extends TestCase
{
    public function testGetSuccess(): void
    {
        $file_path = '../../../Resources/Mocks/Response/PaymentMethod/payment_method_get.json';
        $mock_http_request = $this->mockHttpRequest($file_path, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new PaymentMethodClient();
        $payment_method_result = $client->get();
        $this->assertNotNull($payment_method_result->data);
        $this->assertEquals(200, $payment_method_result->getResponse()->getStatusCode());
        $this->assertCount(2, $payment_method_result->getResponse()->getContent());
        $this->assertCount(2, $payment_method_result->data);
        $this->assertCount(1, $payment_method_result->data[0]["settings"]);
        $this->assertCount(1, $payment_method_result->data[1]["settings"]);
        $this->assertCount(0, $payment_method_result->data[0]["financial_institutions"]);
        $this->assertCount(0, $payment_method_result->data[1]["financial_institutions"]);
    }

    private function mockHttpRequest(string $file_path, int $status_code): \PHPUnit\Framework\MockObject\MockObject|\MercadoPago\Net\HttpRequest
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject|\MercadoPago\Net\HttpRequest $mockHttpRequest */
        $mock_http_request = $this->getMockBuilder(\MercadoPago\Net\HttpRequest::class)->getMock();

        $response_json = file_get_contents(__DIR__ . $file_path);
        $mock_http_request->method('execute')->willReturn($response_json);
        $mock_http_request->method('getInfo')->willReturn($status_code);
        return $mock_http_request;
    }
}
