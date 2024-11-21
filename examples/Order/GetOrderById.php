<?php

namespace Exemples\Order;

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
    $order_id = "<ORDER_ID>";
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    $order = $client->get($order_id, $request_options);

    echo "Order ID: " . $order->id . "\n";
    echo "Total Amount: " . $order->total_amount . "\n";
    echo "Status: " . $order->status . "\n";

    if (isset($order->transactions) && isset($order->transactions->payments) && is_array($order->transactions->payments) && count($order->transactions->payments) > 0) {
        $payment = $order->transactions->payments[0];

        echo "Payments Id: " . $payment->id . "\n";
        echo "Payment Amount: " . $payment->amount . "\n";

        if (isset($payment->payment_method)) {
            echo "Payment Method ID: " . $payment->payment_method->id . "\n";
        }
    } else {
        echo "No payments found for this order.\n";
    }

} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
