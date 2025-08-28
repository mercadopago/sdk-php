<?php

namespace MercadoPago\Tests\Client\Integration\Payment;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
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

    public function testCreateWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PaymentClient();
        $request = $this->createRequest();
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->create($request, $request_options);
    }

    public function testGetSuccess(): void
    {
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $payment = $client->get($created_payment->id);
        $this->assertNotNull($payment->id);
    }

    public function testGetWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->get($created_payment->id, $request_options);
    }

    public function testCancelSuccess(): void
    {
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $payment = $client->cancel($created_payment->id);
        $this->assertNotNull($payment->id);
        $this->assertSame("cancelled", $payment->status);
    }

    public function testCancelWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->cancel($created_payment->id, $request_options);
    }

    public function testSearchSuccess(): void
    {
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $search_request = new MPSearchRequest(1, 0, ["id" => $created_payment->id]);
        $search_result = $client->search($search_request);
        $this->assertNotNull($search_result->paging);
        $this->assertSame(1, $search_result->paging->total);
        $this->assertSame(0, $search_result->paging->offset);
        $this->assertNotNull($search_result->results);
        $this->assertSame(1, count($search_result->results));
        $this->assertSame($created_payment->id, $search_result->results[0]->id);
    }

    public function testSearchWithRequestOptionsFailure(): void
    {
        $this->expectException(MPApiException::class);
        $client = new PaymentClient();
        $created_payment = $client->create($this->createRequest());
        $search_request = new MPSearchRequest(1, 0, ["id" => $created_payment->id]);
        $request_options = new RequestOptions();
        $request_options->setAccessToken("invalid_access_token");
        $client->search($search_request, $request_options);
    }

    private function createRequest(): array
    {
        $request = [
            "transaction_amount" => 100,
            "description" => "description",
            "payment_method_id" => "pix",
            "payer" => [
                "email" => "test_user_18206716@testuser.com",
            ]
        ];
        return $request;
    }
}
