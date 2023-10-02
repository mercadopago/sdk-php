<?php

namespace MercadoPago\Tests\Client\Integration\PaymentMethod;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\PaymentMethod\PaymentMethodClient;
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
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testGetSuccess(): void
    {
        $client = new PaymentMethodClient();
        $payment_method = $client->list();
        $this->assertNotNull($payment_method);
        $this->assertSame(200, $payment_method->getResponse()->getStatusCode());
        $this->assertNotNull($payment_method->data[0]->id);
    }

    public function testGetWithInvalidAccessTokenFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PaymentMethodClient();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->list($request_options);
    }
}
