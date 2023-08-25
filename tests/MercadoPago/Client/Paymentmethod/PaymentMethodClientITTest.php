<?php

namespace MercadoPago\Client\PaymentMethod;

use MercadoPago\Core\MPRequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use PHPUnit\Framework\TestCase;

/**
 * PaymentMethodClient integration tests.
 */
final class PaymentMethodClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        //MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
        MercadoPagoConfig::setAccessToken("APP_USR-4849723703374061-053108-80867bffcb4a85cda0cd797f6c40cf28-1340175910");
    }

    public function testGetSuccess(): void
    {
        $client = new PaymentMethodClient();
        $payment_method = $client->get();
        $this->assertNotNull($payment_method);
        $this->assertEquals(200, $payment_method->getResponse()->getStatusCode());
    }

    public function testGetWithInvalidAccessTokenFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PaymentMethodClient();
        $request_options = new MPRequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get($request_options);
    }
}
