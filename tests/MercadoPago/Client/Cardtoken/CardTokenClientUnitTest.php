<?php

namespace MercadoPago\Client\Cardtoken;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * PaymentClient unit tests.
 */
final class CardTokenClientUnitTest extends TestCase
{
    public function testCreateSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Cardtoken/card_token_get.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 200);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new CardTokenClient();
        $cardToken = $client->create($this->createRequest());
        $this->assertEquals(200, $cardToken->getResponse()->getStatusCode());
        $this->assertEquals("60aca73f30e817f", $cardToken->id);
        $this->assertEquals("2023-08-15T12:51:56.624-04:00", $cardToken->date_created);
        $this->assertEquals("active", $cardToken->status);
        $this->assertEquals(3, $cardToken->security_code_length);
        $this->assertEquals(16, $cardToken->card_number_length);
        $this->assertEquals("123456", $cardToken->first_six_digits);
    }

    public function testGetSuccess(): void
    {
        $filepath = '../../../Resources/Mocks/Response/Cardtoken/card_token_get.json';
        $mockHttpRequest = $this->mockHttpRequest($filepath, 200);

        $httpClient = new MPDefaultHttpClient($mockHttpRequest);
        MercadoPagoConfig::setHttpClient($httpClient);

        $client = new CardTokenClient();
        $id = "60aca73f30e817f";
        $payment = $client->get($id);
        $this->assertEquals(200, $payment->getResponse()->getStatusCode());
        $this->assertEquals($id, $payment->id);
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
    private function createRequest(): array
    {
        $request = [
            "card_id" => "9067121741",
            "security_code" => "123"
        ];
        return $request;
    }
}
