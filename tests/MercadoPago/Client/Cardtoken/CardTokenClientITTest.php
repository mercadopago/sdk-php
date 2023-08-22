<?php

namespace MercadoPago\Client\Cardtoken;

use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use PHPUnit\Framework\TestCase;

/**
 * CardTokenClient integration tests.
 */
final class CardTokenClientITTest extends TestCase
{
    protected function setUp(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        $client = new CardTokenClient();
        $card_token = $client->create($this->createRequest());
        $this->assertNotNull($card_token->id);
    }

    public function testCreateWithAccessTokenFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CardTokenClient();
        $request = $this->createRequest();
        MercadoPagoConfig::setAccessToken("invalid_access_token");
        $client->create($request);
    }

    public function testGetSuccess(): void
    {
        $client = new CardTokenClient();
        $card_token = $client->get("60aca73f30e817fcf074cebc616897ba");
        $this->assertNotNull($card_token->id);
    }

    public function testGetWithAccessTokenFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CardTokenClient();
        MercadoPagoConfig::setAccessToken("invalid_access_token");
        $client->get("123");
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
