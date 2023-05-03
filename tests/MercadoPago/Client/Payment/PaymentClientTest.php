<?php

namespace MercadoPago\Client\Payment;

use MercadoPago\MercadoPagoConfig;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

final class PaymentClientTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        $client = new PaymentClient();
        $payment = $client->create($this->createRequest());
        assertNotNull($payment->id);
    }

    public function testGetSuccess(): void
    {
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $payment = $client->get($created_payment->id);
        assertNotNull($payment->id);
    }

    public function testCancelPayment(): void
    {
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $payment = $client->cancel($created_payment->id);
        assertNotNull($payment->id);
        assertEquals("cancelled", $payment->status);
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