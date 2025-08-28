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

// Step 3: Initialize the API client
$client = new OrderClient();

try {
    // Step 4: Create the request array
    $request = [
        "type" => "online",
        "processing_mode" => "automatic",
        "total_amount" => "200.00",
        "external_reference" => "ext_ref_1234",
        "payer" => [
            "email" => "<PAYER_EMAIL>"
        ],
        "capture_mode" => "manual",

        "transactions" => [
            "payments" => [
                [
                    "amount" => "200.00",
                    "payment_method" => [
                        "id" => "master",
                        "type" => "credit_card",
                        "token" => "<CARD_TOKEN>",
                        "installments" => 1,
                    ]
                ]
            ]
        ],
    ];

    // Step 5: Create the request options, setting X-Idempotency-Key
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 6: Create the order
    $order = $client->create($request, $request_options);
    echo "\nOrder ID:" . $order->id;
    echo "\nOrder status before capture: " . $order->status;

    $request_options_capture = new RequestOptions();
    $request_options_capture->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 7: Capture the order
    $order = $client->capture($order->id, $request_options_capture);
    echo "\nOrder status after capture: " . $order->status;

    // Step 8: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "\nContent: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
