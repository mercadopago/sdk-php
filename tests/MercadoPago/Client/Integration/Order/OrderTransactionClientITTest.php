<?php

namespace MercadoPago\Tests\Client\Integration\Order;

use MercadoPago\Client\Order\OrderClient;
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

    public function testUpdateSuccess(): void
    {
        try {
            $order_client = new OrderClient();
            $order_transaction_client = new OrderTransactionClient();
            $create_order_request = $this->createOrderRequest();
            $update_transaction_request = [
                "amount" => "299.90",
            ];

            $order = $order_client->create($create_order_request);
            sleep(3);
            $transaction = $order_transaction_client->update($order->id, $order->transactions->payments[0]->id, $update_transaction_request);

            $this->assertSame($order->transactions->payments[0]->id, $transaction->id);
            $this->assertSame("299.90", $transaction->amount);
        } catch (MPApiException $e) {
            $apiResponse = $e->getApiResponse();
            $statusCode = $apiResponse->getStatusCode();
            $responseBody = json_encode($apiResponse->getContent());
            $this->fail("API Exception: " . $statusCode . " - " . $responseBody);
        } catch (\Exception $e) {
            $this->fail("Exception: " . $e->getMessage());
        }
    }

    private function createOrderRequest(): array
    {
        $request = [
            "type" => "online",
            "processing_mode" => "manual",
            "total_amount" => "100.00",
            "external_reference" => "ext_ref_1234",
            "transactions" => [
                "payments" => [
                    [
                        "amount" => "100.00",
                        "payment_method" => [
                            "id" => "pix",
                            "type" => "bank_transfer"
                        ],
                    ],
                ]
            ],
            "payer" => [
                "email" => "test_1731350184@testuser.com",
            ]
        ];
        return $request;
    }
}
