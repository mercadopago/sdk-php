<?php

namespace MercadoPago\Tests\Client\Unit\CardToken;

use MercadoPago\Client\CardToken\CardTokenClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * CardTokenClient unit tests.
 */
final class CardTokenClientUnitTest extends BaseClient
{
    public function testCreateSuccess(): void
    {
        $file_path = '../../../../Resources/Mocks/Response/CardToken/card_token_get.json';
        $mock_http_request = $this->mockHttpRequest($file_path, 200);

        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);

        $client = new CardTokenClient();
        $card_token = $client->create($this->createRequest());
        $this->assertSame(200, $card_token->getResponse()->getStatusCode());
        $this->assertSame("60aca73f30e817f", $card_token->id);
        $this->assertSame("2023-08-15T12:51:56.624-04:00", $card_token->date_created);
        $this->assertSame("active", $card_token->status);
        $this->assertSame(3, $card_token->security_code_length);
        $this->assertSame(16, $card_token->card_number_length);
        $this->assertSame("123456", $card_token->first_six_digits);
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
