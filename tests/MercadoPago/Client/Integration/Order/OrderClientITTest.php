<?php

namespace MercadoPago\Tests\Client\Integration\Order;

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use PHPUnit\Framework\TestCase;

/**
 * OrderClient integration tests.
 */
final class OrderClientITTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        MercadoPagoConfig::setAccessToken(getenv("ACCESS_TOKEN"));
    }

    public function testCreateSuccess(): void
    {
        try {
            $client = new OrderClient();
            $request = $this->createRequest();

            $order = $client->create($request);

            $this->assertNotNull($order->id);
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
        $request = [
            "type" => "online",
            "total_amount" => "1000.00",
            "external_reference" => "ext_ref_1234",
            "transactions" => [
                "payments" => [
                    [
                        "amount" => "1000.00",
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

    public function testCaptureSuccess(): void
    {
        try {
            $client = new OrderClient();
            $request = $this->createRequestCapture();
            $request_options = new RequestOptions();
            $request_options->setCustomHeaders(["X-Sandbox: true"]);

            $order = $client->create($request, $request_options);

            $order = $client->capture($order->id, $request_options);

            $this->assertSame($order->status, "processed");
        } catch (MPApiException $e) {
            $apiResponse = $e->getApiResponse();
            $statusCode = $apiResponse->getStatusCode();
            $responseBody = json_encode($apiResponse->getContent());
            $this->fail("API Exception: " . $statusCode . " - " . $responseBody);
        } catch (\Exception $e) {
            $this->fail("Exception: " . $e->getMessage());
        }
    }

    private function createRequestCapture(): array
    {
        $request = [
            "type" => "online",
            "total_amount" => "200.00",
            "external_reference" => "ext_ref_1234",
            "type_config" => [
                "capture_mode" => "manual"
            ],
            "transactions" => [
                "payments" => [
                    [
                        "amount" => "200.00",
                        "payment_method" => [
                            "id" => "master",
                            "type" => "credit_card",
                            "token" => "<unique_credit_card_token>",
                            "installments" => 1,
                        ]
                    ]
                ]
            ],
            "payer" => [
                "email" => "test_1731350184@testuser.com",
            ]
        ];
        return $request;
    }
}
