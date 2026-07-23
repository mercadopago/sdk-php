<?php

namespace MercadoPago\Tests\Client\Unit\Order;

use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Client\Order\Request\OrderAutomaticPaymentsRequest;
use MercadoPago\Client\Order\Request\OrderCreateRequest;
use MercadoPago\Client\Order\Request\OrderInvoicePeriodRequest;
use MercadoPago\Client\Order\Request\OrderPayerRequest;
use MercadoPago\Client\Order\Request\OrderPaymentMethodRequest;
use MercadoPago\Client\Order\Request\OrderPaymentRequest;
use MercadoPago\Client\Order\Request\OrderStoredCredentialRequest;
use MercadoPago\Client\Order\Request\OrderSubscriptionDataRequest;
use MercadoPago\Client\Order\Request\OrderSubscriptionSequenceRequest;
use MercadoPago\Client\Order\Request\OrderTransactionRequest;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPDefaultHttpClient;
use MercadoPago\Tests\Client\Unit\Base\BaseClient;

/**
 * Tests for the typed OrderCreateRequest and the dual-acceptance create() path.
 *
 * Covers:
 * - E2E-1: existing array path still works.
 * - E2E-2: array vs typed object produce identical JSON.
 * - E2E-3: typed AP flow (automatic_payments + stored_credential + subscription_data).
 * - E2E-4: null omission — empty optional fields are absent from the JSON.
 */
final class OrderCreateRequestUnitTest extends BaseClient
{
    /** The array form of the base order used across equivalence tests. */
    private function baseArray(): array
    {
        return [
            "type" => "online",
            "total_amount" => "1000.00",
            "external_reference" => "ext_ref_1234",
            "transactions" => [
                "payments" => [
                    [
                        "amount" => "1000.00",
                        "payment_method" => [
                            "id" => "master",
                            "type" => "credit_card",
                            "token" => "{{card_token}}",
                            "installments" => 1,
                        ],
                    ],
                ],
            ],
            "payer" => [
                "email" => "test_1731350184@testuser.com",
            ],
        ];
    }

    /** The typed equivalent of {@see self::baseArray()}. */
    private function baseTyped(): OrderCreateRequest
    {
        return new OrderCreateRequest(
            type: "online",
            external_reference: "ext_ref_1234",
            total_amount: "1000.00",
            transactions: new OrderTransactionRequest(
                payments: [
                    new OrderPaymentRequest(
                        amount: "1000.00",
                        payment_method: new OrderPaymentMethodRequest(
                            id: "master",
                            type: "credit_card",
                            token: "{{card_token}}",
                            installments: 1,
                        ),
                    ),
                ],
            ),
            payer: new OrderPayerRequest(
                email: "test_1731350184@testuser.com",
            ),
        );
    }

    /** E2E-1: the existing array path still works end-to-end. */
    public function testCreateWithArrayStillWorks(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/order.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);
        $client = new OrderClient();

        $order = $client->create($this->baseArray());

        $this->assertSame(200, $order->getResponse()->getStatusCode());
        $this->assertSame("01HRYFWNYRE1MR1E60MW3X0T2P", $order->id);
        $this->assertSame("online", $order->type);
    }

    /** E2E-1 (typed): the typed object path also works end-to-end. */
    public function testCreateWithTypedObjectWorks(): void
    {
        $filepath = '../../../../Resources/Mocks/Response/Order/order.json';
        $mock_http_request = $this->mockHttpRequest($filepath, 200);
        $http_client = new MPDefaultHttpClient($mock_http_request);
        MercadoPagoConfig::setHttpClient($http_client);
        $client = new OrderClient();

        $order = $client->create($this->baseTyped());

        $this->assertSame(200, $order->getResponse()->getStatusCode());
        $this->assertSame("01HRYFWNYRE1MR1E60MW3X0T2P", $order->id);
        $this->assertSame("online", $order->type);
    }

    /** Recursively sort array keys so equality ignores key insertion order. */
    private function normalize(array $data): array
    {
        ksort($data);
        foreach ($data as &$value) {
            if (is_array($value)) {
                $value = $this->normalize($value);
            }
        }
        return $data;
    }

    /**
     * E2E-2: array and typed object produce identical JSON.
     *
     * The dynamic array and the typed toArray() carry the same keys and values;
     * key insertion order is not significant to the API, so both are normalized
     * (recursive ksort) before comparing their JSON encodings.
     */
    public function testArrayAndTypedProduceIdenticalJson(): void
    {
        $array_json = json_encode($this->normalize($this->baseArray()));
        $typed_json = json_encode($this->normalize($this->baseTyped()->toArray()));

        $this->assertSame($array_json, $typed_json);
    }

    /** E2E-3: typed AP flow serializes with correct snake_case keys and nesting. */
    public function testTypedAutomaticPaymentsFlow(): void
    {
        $request = new OrderCreateRequest(
            type: "online",
            total_amount: "1000.00",
            transactions: new OrderTransactionRequest(
                payments: [
                    new OrderPaymentRequest(
                        amount: "1000.00",
                        payment_method: new OrderPaymentMethodRequest(
                            id: "master",
                            type: "credit_card",
                            token: "{{card_token}}",
                        ),
                        automatic_payments: new OrderAutomaticPaymentsRequest(
                            payment_profile_id: "profile_1",
                            schedule_date: "2026-08-01T00:00:00.000-03:00",
                            due_date: "2026-08-10T00:00:00.000-03:00",
                            retries: 3,
                        ),
                        stored_credential: new OrderStoredCredentialRequest(
                            payment_initiator: "merchant",
                            reason: "recurring",
                            store_payment_method: true,
                            first_payment: false,
                            prev_transaction_ref: "prev_txn_123",
                        ),
                        subscription_data: new OrderSubscriptionDataRequest(
                            invoice_id: "inv_1",
                            billing_date: "2026-08-01T00:00:00.000-03:00",
                            subscription_sequence: new OrderSubscriptionSequenceRequest(
                                number: 1,
                                total: 12,
                            ),
                            invoice_period: new OrderInvoicePeriodRequest(
                                type: "monthly",
                                period: 1,
                            ),
                        ),
                    ),
                ],
            ),
        );

        $arr = $request->toArray();
        $payment = $arr["transactions"]["payments"][0];

        $ap = $payment["automatic_payments"];
        $this->assertSame("profile_1", $ap["payment_profile_id"]);
        $this->assertSame("2026-08-01T00:00:00.000-03:00", $ap["schedule_date"]);
        $this->assertSame("2026-08-10T00:00:00.000-03:00", $ap["due_date"]);
        $this->assertSame(3, $ap["retries"]);

        $sc = $payment["stored_credential"];
        $this->assertSame("merchant", $sc["payment_initiator"]);
        $this->assertSame("recurring", $sc["reason"]);
        $this->assertTrue($sc["store_payment_method"]);
        $this->assertFalse($sc["first_payment"]);
        $this->assertSame("prev_txn_123", $sc["prev_transaction_ref"]);

        $sd = $payment["subscription_data"];
        $this->assertSame("inv_1", $sd["invoice_id"]);
        $this->assertSame("2026-08-01T00:00:00.000-03:00", $sd["billing_date"]);
        $this->assertSame(1, $sd["subscription_sequence"]["number"]);
        $this->assertSame(12, $sd["subscription_sequence"]["total"]);
        $this->assertSame("monthly", $sd["invoice_period"]["type"]);
        $this->assertSame(1, $sd["invoice_period"]["period"]);

        // Round-trips cleanly through json.
        $json = json_encode($arr);
        $this->assertStringContainsString('"payment_profile_id"', $json);
        $this->assertStringContainsString('"prev_transaction_ref"', $json);
        $this->assertStringContainsString('"subscription_sequence"', $json);
    }

    /** E2E-4: null/unset optional fields are omitted from the serialized array. */
    public function testNullFieldsAreOmitted(): void
    {
        $request = new OrderCreateRequest(
            type: "online",
            total_amount: "1000.00",
        );

        $arr = $request->toArray();

        $this->assertSame(["type" => "online", "total_amount" => "1000.00"], $arr);
        $this->assertArrayNotHasKey("external_reference", $arr);
        $this->assertArrayNotHasKey("currency", $arr);
        $this->assertArrayNotHasKey("payer", $arr);
        $this->assertArrayNotHasKey("transactions", $arr);
        $this->assertArrayNotHasKey("items", $arr);
        $this->assertArrayNotHasKey("config", $arr);
        $this->assertArrayNotHasKey("shipment", $arr);
        $this->assertArrayNotHasKey("integration_data", $arr);

        // Nested omission: a payment method with only an id emits only that key.
        $pm = new OrderPaymentMethodRequest(id: "master");
        $this->assertSame(["id" => "master"], $pm->toArray());
    }

    /** transaction_security is nested under config.online, not at the root. */
    public function testTransactionSecurityNestedUnderConfigOnline(): void
    {
        $request = new OrderCreateRequest(
            type: "online",
            config: new \MercadoPago\Client\Order\Request\OrderConfigRequest(
                notification_url: "https://example.test/webhook",
                transaction_security: new \MercadoPago\Client\Order\Request\OrderTransactionSecurityRequest(
                    validation: "complete",
                    liability_shift: "issuer",
                ),
            ),
        );

        $arr = $request->toArray();

        $this->assertArrayNotHasKey("transaction_security", $arr);
        $this->assertArrayNotHasKey("transaction_security", $arr["config"]);
        $this->assertSame(
            ["validation" => "complete", "liability_shift" => "issuer"],
            $arr["config"]["online"]["transaction_security"]
        );
        $this->assertSame("https://example.test/webhook", $arr["config"]["notification_url"]);
    }

    /** jsonSerialize() returns the same structure as toArray(). */
    public function testJsonSerializeMatchesToArray(): void
    {
        $request = $this->baseTyped();
        $this->assertSame($request->toArray(), $request->jsonSerialize());
        $this->assertSame(json_encode($request->toArray()), json_encode($request));
    }
}
