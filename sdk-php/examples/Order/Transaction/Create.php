<?php

namespace Examples\Order\Transaction;

// Step 1: Require the library from your Composer vendor folder
require_once '../../../vendor/autoload.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderTransactionClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

// Step 2: Set production or sandbox access token
MercadoPagoConfig::setAccessToken("<ACCESS_TOKEN>");
// Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
// In case you want to test in your local machine first, set runtime enviroment to LOCAL
MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

// Step 3: Initialize the API client
$client = new OrderTransactionClient();

try {
    // Step 4: Create the request
    $request = [
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
        ],
    ];

    // Step 5: Create the request options, setting X-Idempotency-Key
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 6: Make the request
    $transaction = $client->create("<ORDER_ID>", $request, $request_options);
    echo "Payment ID: " . $transaction->payments[0]->id;
    echo "\nPayment method ID: " . $transaction->payments[0]->payment_method->id;
    echo "\nPayment method type: " . $transaction->payments[0]->payment_method->type;

    // Step 7: Handle exceptions
} catch (MPApiException $e) {
    echo "\nStatus code: " . $e->getApiResponse()->getStatusCode();
    echo "\nContent: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
