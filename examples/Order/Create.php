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
        "total_amount" => "1000.00",
        "external_reference" => "ext_ref_1234",
        "capture_mode" => "automatic_async",
        "transactions" => [
            "payments" => [
                [
                    "amount" => "1000.00",
                    "payment_method" => [
                        "id" => "master",
                        "type" => "credit_card",
                        "token" => "<CARD_TOKEN>",
                        "installments" => 1,
                        "statement_descriptor" => "Store name",
                    ]
                ]
            ]
        ],
        "processing_mode" => "automatic",
        "description" => "some description",
        "payer" => [
            "email" => "<PAYER_EMAIL>",
            "first_name" => "John",
            "last_name" => "Doe",
            "identification" => [
                "type" => "CPF",
                "number" => "00000000000"
            ],
            "phone" => [
                "area_code" => "55",
                "number" => "99999999999"
            ],
            "address" => [
                "street_name" => "Av. das Nações Unidas",
                "street_number" => "99"
            ]
        ],
        "marketplace" => "NONE",
        "marketplace_fee" => "10.00",
        "items" => [
            [
                "title" => "Some item title",
                "unit_price" => "1000.00",
                "quantity" => 1,
                "description" => "Some item description",
                "category_id" => "category_id",
                "picture_url" => "https://mysite.com/img/item.jpg"
            ]
        ],
        "expiration_time" => "P3D"
    ];

    // Step 5: Create the request options, setting X-Idempotency-Key
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 6: Make the request
    $order = $client->create($request, $request_options);
    echo "Order ID:" . $order->id;

    // Step 7: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
