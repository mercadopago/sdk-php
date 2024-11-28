<?php

namespace MercadoPago\Tests\Client\Integration\Order;

use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Client\Order\OrderTransactionClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use PHPUnit\Framework\TestCase;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\CardToken\CardTokenClient;

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

    private function createRequest(): array
    {
        return [
            "payments" => [
                [
                    "amount" => "100.00",
                    "payment_method" => [
                        "id" => "pix",
                        "type" => "bank_transfer",
                    ],
                ],
            ],
        ];
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
        return [
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
    }

    public function testDeleteTransactionSucess(): void
    {
        try {
            $client = new OrderClient();
            $request = $this->createOrderBuilderMode();
            $request_options = new RequestOptions();
            $request_options->setCustomHeaders(["X-Sandbox: true"]);
            $order = $client->create($request, $request_options);
            $order_id = $order->id;
            $transaction_id = $order->transactions->payments[0]->id;
            $this->assertNotNull($order_id);
            $this->assertNotNull($transaction_id);

            $client_transaction = new OrderTransactionClient();
            $transaction_delete = $client_transaction->delete($order_id, $transaction_id, $request_options);
            $this->assertEquals(204, $transaction_delete->getStatusCode());
        } catch (MPApiException $e) {
            $apiResponse = $e->getApiResponse();
            $statusCode = $apiResponse->getStatusCode();
            $responseBody = json_encode($apiResponse->getContent());
            $this->fail("API Exception: " . $statusCode . " - " . $responseBody);

        } catch (\Exception $e) {
            $this->fail("Exception: " . $e->getMessage());
        }
    }

    private function createOrderBuilderMode(): array
    {
        $client_token = new CardTokenClient();
        $card_token = $client_token->create($this->createCardTokenRequest());
        $this->assertNotNull($card_token->id);

        return [
            "type" => "online",
            "processing_mode" => "manual",
            "total_amount" => "200.00",
            "external_reference" => "ext_ref_1234",
            "transactions" => [
                "payments" => [
                    [
                        "amount" => "200.00",
                        "payment_method" => [
                            "id" => "master",
                            "type" => "credit_card",
                            "token" => $card_token->id,
                            "installments" => 1,
                        ]
                    ]
                ]
            ],
            "payer" => [
                "email" => "test_1731350184@testuser.com",
            ]
        ];
    }

    private function createCardTokenRequest(): array
    {
        return [
            "card_number" => "5031433215406351",
            "expiration_year" => "2025",
            "expiration_month" => "12",
            "security_code" => "123",
            "cardholder" => [
                "name" => "APRO",
                "identification" => [
                    "type" => "CPF",
                    "number" => "19119119100",
                ],
            ]
        ];
    }
}
