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
    // Step 4: Build the Checkout PRO request
    // processing_mode "manual" triggers the Checkout PRO flow and returns a checkout_url
    $request = [
        "type" => "online",
        "processing_mode" => "manual",
        "total_amount" => "500.00",
        "external_reference" => "ext_ref_checkout_pro_001",
        "capture_mode" => "automatic",
        "marketplace_fee" => "5.00",
        "description" => "Travel package SAO-RIO with insurance",
        "expiration_time" => "P1D",
        "payer" => [
            "email" => "buyer@testuser.com",
            "first_name" => "John",
            "last_name" => "Smith",
            "phone" => [
                "area_code" => "11",
                "number" => "999998888"
            ],
            "identification" => [
                "type" => "CPF",
                "number" => "12345678909"
            ],
            "address" => [
                "zip_code" => "01310-100",
                "street_name" => "Av. Paulista",
                "street_number" => "1000",
                "neighborhood" => "Bela Vista",
                "city" => "São Paulo"
            ]
        ],
        "shipment" => [
            "mode" => "custom",
            "local_pickup" => false,
            "cost" => "15.00",
            "free_shipping" => false,
            "free_methods" => [
                ["id" => 73328]
            ],
            "address" => [
                "zip_code" => "01310-100",
                "street_name" => "Av. Paulista",
                "street_number" => "1000",
                "floor" => "3",
                "apartment" => "B",
                "neighborhood" => "Bela Vista",
                "city" => "São Paulo"
            ]
        ],
        "config" => [
            "statement_descriptor" => "MYSTORE",
            "default_payment_due_date" => "P1D",
            "online" => [
                "available_from" => "2026-01-01T00:00:00Z",
                "allowed_user_type" => "account_only",
                "success_url" => "https://example.com/success",
                "failure_url" => "https://example.com/failure",
                "pending_url" => "https://example.com/pending",
                "auto_return" => "approved",
                "tracks" => [
                    [
                        "type" => "google_ad",
                        "values" => [
                            "conversion_id" => "21312312312123",
                            "conversion_label" => "TEST"
                        ]
                    ],
                    [
                        "type" => "facebook_ad",
                        "values" => [
                            "pixel_id" => "21312312312123"
                        ]
                    ]
                ]
            ],
            "payment_method" => [
                "max_installments" => 12,
                "not_allowed_ids" => ["amex"],
                "not_allowed_types" => ["ticket"],
                "installments" => [
                    "interest_free" => [
                        "type" => "range",
                        "values" => [2, 6]
                    ]
                ]
            ]
        ],
        "items" => [
            [
                "external_code" => "ITEM-001",
                "title" => "Flight SAO-RIO",
                "description" => "Round trip, economy class",
                "category_id" => "travels",
                "picture_url" => "https://example.com/img.jpg",
                "quantity" => 1,
                "unit_price" => "450.00",
                "type" => "travel",
                "event_date" => "2027-01-15T00:00:00.000-03:00"
            ],
            [
                "external_code" => "ITEM-002",
                "title" => "Travel insurance",
                "description" => "Basic coverage during trip",
                "category_id" => "travels",
                "picture_url" => "https://example.com/insurance.jpg",
                "quantity" => 1,
                "unit_price" => "50.00",
                "type" => "travel",
                "event_date" => "2027-01-15T00:00:00.000-03:00"
            ]
        ]
    ];

    // Step 5: Create the request options, setting X-Idempotency-Key
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 6: Make the request
    $order = $client->create($request, $request_options);

    // Step 7: Redirect the buyer to the Checkout PRO flow
    echo "Order ID: " . $order->id . "\n";
    echo "Order status: " . $order->status . "\n";
    echo "Checkout URL: " . $order->checkout_url . "\n";
    // Redirect your buyer to $order->checkout_url to complete the payment

    // Step 8: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
