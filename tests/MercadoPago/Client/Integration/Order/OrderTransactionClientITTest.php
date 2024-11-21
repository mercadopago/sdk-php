<?php

namespace MercadoPago\Tests\Client\Integration\Order;

use MercadoPago\Client\Order\OrderTransactionClient;
use MercadoPago\Client\Order\Transaction\CreateTransactionRequest;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use PHPUnit\Framework\TestCase;

/**
 * OrderTransactionClient integration tests.
 */
final class OrderTransactionClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        try {
            $client = new OrderTransactionClient();
            $request = $this->createRequest();

            $transaction = $client->create("<ORDER_ID>", $request);

            $this->assertNotNull($transaction->payments[0]->id);
        } catch (MPApiException $e) {
            $apiResponse = $e->getApiResponse();
            $statusCode = $apiResponse->getStatusCode();
            $responseBody = json_encode($apiResponse->getContent());
            $this->fail("API Exception: " . $statusCode . " - " . $responseBody);
        } catch (\Exception $e) {
            $this->fail("Exception: " . $e->getMessage());
        }
    }

    private function createRequest(): CreateTransactionRequest
    {
        $request = new CreateTransactionRequest();
        $request->payments = [
            [
                "amount" => "100.00",
                "payment_method" => [
                    "id" => "pix",
                    "type" => "bank_transfer",
                ],
            ],
        ];
        return $request;
    }
}
