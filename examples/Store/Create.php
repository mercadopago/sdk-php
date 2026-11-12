<?php

namespace Examples\Store;

// Step 1: Require the Composer library
require_once '../../vendor/autoload.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Store\StoreClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

// Step 2: Set the production or sandbox access token
MercadoPagoConfig::setAccessToken("<YOUR_ACCESS_TOKEN>");

// Step 3: Initialize the API client
$client = new StoreClient();

try {
    // Step 4: Create the request array
    $request = [
        "name" => "Store name",
        "business_hours" => [
            "monday" => [
                "open" => "08:00",
                "close" => "18:00"
            ],
            "tuesday" => [
                "open" => "08:00",
                "close" => "18:00"
            ]
        ],
        "location" => [
            "address_line" => "Av. das Nações Unidas, 3003",
            "reference" => "Near the corner",
            "city" => "São Paulo",
            "state" => "SP",
            "zip_code" => "04551-000",
            "latitude" => -23.5964,
            "longitude" => -46.6844
        ]
    ];

    // Step 5: Create the request options, setting X-Idempotency-Key.
    // The SDK automatically adds an idempotency key to POST and PUT requests,
    // but you can set your own value here.
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 6: Make the request
    $store = $client->create($request, $request_options);
    echo "Store ID: " . $store->id;

    // Step 7: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
