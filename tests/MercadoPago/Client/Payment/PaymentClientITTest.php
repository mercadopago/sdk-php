<?php

namespace MercadoPago\Client\Payment;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;
use PHPUnit\Framework\TestCase;

/**
 * PaymentClient integration tests.
 */
final class PaymentClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        $client = new PaymentClient();
        $payment = $client->create($this->createRequest());
        $this->assertNotNull($payment->id);
    }

    public function testGetSuccess(): void
    {
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $payment = $client->get($created_payment->id);
        $this->assertNotNull($payment->id);
    }

    public function testCancelSuccess(): void
    {
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $payment = $client->cancel($created_payment->id);
        $this->assertNotNull($payment->id);
        $this->assertEquals("cancelled", $payment->status);
    }

    public function testSearchSuccess(): void
    {
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $search_request = new MPSearchRequest(1, 0, ["id" => $created_payment->id]);
        $search_result = $client->search($search_request);
        $this->assertNotNull($search_result->paging);
        $this->assertNotNull($search_result->results);
        $this->assertEquals(1, count($search_result->results));
        $this->assertEquals($created_payment->id, $search_result->results[0]["id"]);
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
