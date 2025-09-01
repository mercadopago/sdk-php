<?php

namespace Examples\Order\Transaction;

// Step 1: Require the library from your Composer vendor folder
require_once '../../../vendor/autoload.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Client\Order\OrderTransactionClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

// Step 2: Set production or sandbox access token
MercadoPagoConfig::setAccessToken("<ACCESS_TOKEN>");
// Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
// In case you want to test in your local machine first, set runtime enviroment to LOCAL
MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

// Step 3: Initialize the Order client
$order_client = new OrderClient();

// Step 4: Initialize the Order Transaction client
$order_transaction_client = new OrderTransactionClient();

try {
    // Step 5: Create the request to create an Order
    $create_order_request = [
        "type" => "online",
        "processing_mode" => "manual",
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
                        "statement_descriptor" => "Store",
                    ]
                ]
            ]
        ],
        "payer" => [
            "email" => "<PAYER_EMAIL>",
        ]
    ];

    // Step 6: Create the request options, setting X-Idempotency-Key
    $create_order_request_options = new RequestOptions();
    $create_order_request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 7: Create the Order
    $order = $order_client->create($create_order_request, $create_order_request_options);
    echo "===== BEFORE UPDATE =====";
    echo "\nPayment ID: " . $order->transactions->payments[0]->id;
    echo "\nAmount: " . $order->transactions->payments[0]->amount;

    // Step 8: Create the request to update a transaction
    $update_transaction_request = [
        "payment_method" => [
            "installments" => 3,
        ]
    ];

    // Step 9: Create the request options, setting X-Idempotency-Key
    $update_transaction_request_options = new RequestOptions();
    $update_transaction_request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 10: Update the transaction
    sleep(3);
    $transaction = $order_transaction_client->update($order->id, $order->transactions->payments[0]->id, $update_transaction_request, $update_transaction_request_options);

    echo "\n===== AFTER UPDATE =====";
    echo "\nTransaction installments updated: \n";
    print_r($transaction->payment_method);

    // Step 11: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
