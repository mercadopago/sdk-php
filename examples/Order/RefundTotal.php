<?php

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

// Step 3: Initialize the Order client
$order_client = new OrderClient();

try {
    // Step 4: Create the request to create an Order
    $create_order_request = [
        "type" => "online",
        "processing_mode" => "automatic",
        "total_amount" => "100.00",
        "external_reference" => "ext_ref_1234",
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
                ],
            ]
        ],
        "payer" => [
            "email" => "<PAYER_EMAIL>",
        ]
    ];

    // Step 5: Create the request options, setting X-Idempotency-Key
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 6: Create the Order
    $order = $order_client->create($create_order_request, $request_options);

    // Step 7: Set a new X-Idempotency-Key
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 8: Refund the Order
    sleep(3);
    $refunded_order = $order_client->refund($order->id, null, $request_options);

    echo "Order ID: " . $refunded_order->id;
    echo "\nStatus: " . $refunded_order->status;
    echo "\nStatus detail: " . $refunded_order->status_detail;

    // Step 9: Handle exceptions
}catch (MPApiException $e) {
    echo "\nStatus code: " . $e->getApiResponse()->getStatusCode();
    echo "\nContent: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}