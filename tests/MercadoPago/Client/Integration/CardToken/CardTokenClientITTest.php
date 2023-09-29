<?php

namespace MercadoPago\Tests\Client\Integration\CardToken;

use MercadoPago\Client\CardToken\CardTokenClient;
use MercadoPago\Client\Common\RequestOptions;
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
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->create($request, $request_options);
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
