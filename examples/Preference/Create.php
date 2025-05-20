<?php

namespace Examples\Preference;

// Step 1: Require the Composer library
require_once '../../vendor/autoload.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

// Step 2: Set the production or sandbox access token
MercadoPagoConfig::setAccessToken("<YOUR_ACCESS_TOKEN>");

// Step 2.1 (optional): Define the runtime environment
MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::SERVER);

// Step 3: Initialize the API client
$client = new PreferenceClient();

try {
    // Step 4: Create the request array
    $request = [
        "back_urls" => [
            "success" => "http://www.mercadopago.com/success",
            "pending" => "http://www.mercadopago.com/pending",
            "failure" => "http://www.mercadopago.com/failure"
        ],
        "notification_url" => "https://webhook.site/your-dummy-url",
        "payer" => [
            "name" => "Juan",
            "surname" => "Lopez",
            "email" => "<PAYER_EMAIL>"
        ],
        "items" => [
            [
                "title" => "Product without description",
                "unit_price" => 1000,
                "quantity" => 1,
                "category_descriptor" => [
                    "event_date" => "2022-03-12T12:58:41.425-04:00"
                ]
            ]
        ],
        "payment_methods" => [
            "excluded_payment_methods" => [
                ["id" => ""]
            ],
            "excluded_payment_types" => [
                ["id" => ""]
            ]
        ]
    ];

    // Step 5: Create the request options, setting X-Idempotency-Key
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <UNIQUE_KEY>"]);

    // Step 6: Make the request
    $preference = $client->create($request, $request_options);
    echo "Preference ID: " . $preference->id;

    // Step 7: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
