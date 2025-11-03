<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace Examples\Order;

// Step 1: Require the library from your Composer vendor folder
require_once '../../vendor/autoload.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

// Step 2: Set production or sandbox access token
MercadoPagoConfig::setAccessToken("<ACCESS_TOKEN>");
// Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
// In case you want to test in your local machine first, set runtime enviroment to LOCAL
MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

// Step 3: Initialize the API client
$client = new OrderClient();

try {
    // Step 4: Create the request array with 3DS configuration
    $request = [
        "type" => "online",
        "external_reference" => "3ds_test",
        "processing_mode" => "automatic",
        "total_amount" => "150.00",
        "config" => [
            "online" => [
                "transaction_security" => [
                    "validation" => "on_fraud_risk",
                    "liability_shift" => "required"
                ]
            ]
        ],
        "payer" => [
            "email" => "<PAYER_EMAIL>",
            "identification" => [
                "type" => "<IDENTIFICATION_TYPE>",
                "number" => "<IDENTIFICATION_NUMBER>"
            ]
        ],
        "transactions" => [
            "payments" => [
                [
                    "amount" => "150.00",
                    "payment_method" => [
                        "id" => "master",
                        "type" => "credit_card",
                        "token" => "<CARD_TOKEN>",
                        "installments" => 1
                    ]
                ]
            ]
        ]
    ];

    // Step 5: Create the request options, setting X-Idempotency-Key
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <IDEMPOTENCY_KEY>"]);

    // Step 6: Make the request
    $order = $client->create($request, $request_options);
    
    // Step 7: Check if 3DS Challenge is required
    $payments = $order->transactions->payments;
    if (!empty($payments)) {
        $payment = $payments[0];
        
        if ($payment->status === "action_required" && $payment->status_detail === "pending_challenge") {
            // Challenge is required - get the URL from payment_method.transaction_security.url
            $challengeUrl = $payment->payment_method->transaction_security->url;
            
            echo "Order ID: " . $order->id . "\n";
            echo "Payment requires 3DS Challenge\n";
            echo "Challenge URL: " . $challengeUrl . "\n";
            echo "\n";
            echo "To complete the payment, you need to:\n";
            echo "1. Display the Challenge URL in an iframe\n";
            echo "2. Listen for the 'message' event with status 'COMPLETE'\n";
            echo "3. Query the Order status to confirm payment approval\n";
        } elseif ($payment->status === "processed") {
            // Payment approved without Challenge
            echo "Order ID: " . $order->id . "\n";
            echo "Payment approved without 3DS Challenge\n";
            echo "Status: " . $payment->status . "\n";
        } else {
            // Payment failed
            echo "Order ID: " . $order->id . "\n";
            echo "Payment status: " . $payment->status . "\n";
            echo "Status detail: " . $payment->status_detail . "\n";
        }
    }

    // Step 8: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}

