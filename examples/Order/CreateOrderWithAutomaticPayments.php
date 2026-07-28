<?php

/** API version: acd67b14-97c4-4a4a-840d-0a018c09654f */

namespace Examples\Order;

// Step 1: Require the library from your Composer vendor folder
require_once '../../vendor/autoload.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

/**
 * Mercado Pago Create Order — Automatic Payments (recurring charges).
 *
 * Demonstrates the two-step Automatic Payments flow:
 *   1. First payment  — CVV-validated charge that registers the card credential.
 *   2. Recurring charge — subsequent MIT charge without CVV, referencing step 1.
 *
 * Prerequisites:
 *   - A customer created via POST /v1/customers             → CUSTOMER_ID
 *   - A payment profile created via POST /v1/customers/{id}/payment-profiles → PAYMENT_PROFILE_ID
 *
 * @see https://www.mercadopago.com/developers/en/docs/automatic-payments-orders/overview
 */

// Step 2: Set production or sandbox access token
MercadoPagoConfig::setAccessToken("<ACCESS_TOKEN>");
// Step 2.1 (optional - default is SERVER): Set your runtime environment
// In case you want to test in your local machine first, set runtime environment to LOCAL
MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

// Step 3: Initialize the API client
$client = new OrderClient();

// ── Step 4: First payment ─────────────────────────────────────────────────────
// Registers the card credential with first_payment: true.
// No previous_transaction_reference is needed on the first charge.
try {
    $firstPaymentRequest = [
        "type" => "online",
        "processing_mode" => "automatic",
        "total_amount" => "100.00",
        "external_reference" => "subscription-001-payment-1",
        "payer" => [
            "email" => "<PAYER_EMAIL>",
            "customer_id" => "<CUSTOMER_ID>",
        ],
        "transactions" => [
            "payments" => [
                [
                    "amount" => "100.00",
                    "payment_method" => [
                        "id" => "master",
                        "type" => "credit_card",
                        "token" => "<CARD_TOKEN>",
                        "installments" => 1,
                    ],
                    "automatic_payments" => [
                        "payment_profile_id" => "<PAYMENT_PROFILE_ID>",
                    ],
                    "stored_credential" => [
                        "payment_initiator" => "customer",
                        "reason" => "recurring",
                        "first_payment" => true,
                    ],
                ],
            ],
        ],
    ];

    // Step 5: Set X-Idempotency-Key to avoid duplicate charges
    $firstPaymentOptions = new RequestOptions();
    $firstPaymentOptions->setCustomHeaders(["X-Idempotency-Key: <IDEMPOTENCY_KEY_FIRST>"]);

    // Step 6: Create the first payment order
    $firstOrder = $client->create($firstPaymentRequest, $firstPaymentOptions);

    echo "First payment order ID: " . $firstOrder->id . "\n";
    echo "Status: " . $firstOrder->status . "\n";

    // Save the payment ID for the next recurring charge
    $firstPaymentId = $firstOrder->transactions->payments[0]->id ?? null;
    if (!$firstPaymentId) {
        echo "Could not retrieve first payment ID.\n";
        exit(1);
    }
    echo "First payment ID (save for next charge): " . $firstPaymentId . "\n\n";

    // ── Step 7: Recurring charge ──────────────────────────────────────────────
    // Subsequent MIT charge — no card token needed, uses the payment profile.
    // prev_transaction_ref links this charge to the original authorization.
    $recurringRequest = [
        "type" => "online",
        "processing_mode" => "automatic_async",
        "total_amount" => "100.00",
        "external_reference" => "subscription-001-payment-2",
        "payer" => [
            "email" => "<PAYER_EMAIL>",
            "customer_id" => "<CUSTOMER_ID>",
        ],
        "transactions" => [
            "payments" => [
                [
                    "amount" => "100.00",
                    "automatic_payments" => [
                        "payment_profile_id" => "<PAYMENT_PROFILE_ID>",
                        "retries" => 3,
                        "schedule_date" => "2026-09-01T00:00:00.000-04:00",
                        "due_date" => "2026-09-05T00:00:00.000-04:00",
                    ],
                    "stored_credential" => [
                        "payment_initiator" => "merchant",
                        "reason" => "recurring",
                        "first_payment" => false,
                        "prev_transaction_ref" => $firstPaymentId,
                    ],
                    "subscription_data" => [
                        "invoice_id" => "INV-002",
                        "billing_date" => "2026-08-01",
                        "subscription_sequence" => [
                            "number" => 2,
                            "total" => 12,
                        ],
                        "invoice_period" => [
                            "type" => "monthly",
                            "period" => 1,
                        ],
                    ],
                ],
            ],
        ],
    ];

    // Step 8: Set a new unique X-Idempotency-Key for the recurring charge
    $recurringOptions = new RequestOptions();
    $recurringOptions->setCustomHeaders(["X-Idempotency-Key: <IDEMPOTENCY_KEY_RECURRING>"]);

    // Step 9: Create the recurring charge order
    $recurringOrder = $client->create($recurringRequest, $recurringOptions);

    echo "Recurring charge order ID: " . $recurringOrder->id . "\n";
    echo "Status: " . $recurringOrder->status . "\n";
    echo "Status detail: " . $recurringOrder->status_detail . "\n";

} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
}
