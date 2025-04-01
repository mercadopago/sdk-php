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

// Step 3: Initialize the API client for Order and Transaction
$client = new OrderClient();
$client_transactions = new OrderTransactionClient();

try {
    // Step 4: Create the Order
    $request = [
      "type" => "online",
      "processing_mode" => "manual",
      "total_amount" => "200.00",
      "external_reference" => "ext_ref_1234",
      "payer" => [
          "email" => "<PAYER_EMAIL>"
      ],
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
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);
    $order = $client->create($request, $request_options);
    $transaction_id = $order->transactions->payments[0]->id;
    $order_id = $order->id;

    // Step 5: Delete a transaction
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);
    $response = $client_transactions->delete($order_id, $transaction_id, $request_options);
    if ($response->getStatusCode() === 204) {
        echo "Transaction deleted successfully. HTTP Status Code: 204\n";
    } else {
        echo "Transaction deletion failed with status: " . $response->getStatusCode() . "\n";
        echo "Response: " . var_dump($response->getContent()) . "\n";
    }
} catch (MPApiException $e) {
    echo "Error: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
} catch (\Exception $e) {
    echo $e->getMessage();
}
