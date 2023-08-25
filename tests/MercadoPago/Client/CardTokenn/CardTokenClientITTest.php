<?php

namespace MercadoPago\Client\CardToken;

use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use PHPUnit\Framework\TestCase;

/**
 * CardTokenClient integration tests.
 */
final class CardTokenClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        $client = new CardTokenClient();
        $card_token = $client->create($this->createRequest());
        $this->assertNotNull($card_token->id);
    }

    public function testCreateWithInvalidAccessTokenFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CardTokenClient();
        $request = $this->createRequest();
        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->create($request, $request_options);
    }

    public function testGetSuccess(): void
    {
        $client = new CardTokenClient();
        $card_token = $client->get("60aca73f30e817fcf074cebc616897ba");
        $this->assertNotNull($card_token->id);
    }

    public function testGetWithInvalidAccessTokenFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new CardTokenClient();
        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get("123", $request_options);
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
