<?php

namespace Examples\Order\Create;

// Step 1: Require the library from your Composer vendor folder
require_once '../../../vendor/autoload.php';

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
        "type_config" => [
            "capture_mode" => "automatic",
            "ip_address" => "127.0.0.1",
            "callback_url" => "https://mysite.com/callback"
        ],
        "transactions" => [
            "payments" => [
                [
                    "amount" => "1000.00",
                    "currency" => "BRL",
                    "payment_method" => [
                        "id" => "master",
                        "type" => "credit_card",
                        "token" => "<CARD_TOKEN>",
                        "installments" => 1,
                        "issuer_id" => "master",
                        "statement_descriptor" => "STORE NAME"
                    ]
                ]
            ]
        ],
        "currency" => "BRL",
        "processing_mode" => "automatic",
        "description" => "some description",
        "payer" => [
            "email" => "test_1731350184@testuser.com",
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
                "zip_code" => "9999999",
                "street_name" => "Av. das Nações Unidas",
                "street_number" => "99"
            ],
            "authentication_type" => "gmail",
            "registration_date" => "2024-01-01T00:00:00",
            "last_purchase" => "2024-01-01T00:00:00",
            "is_prime_user" => true,
            "is_first_purchase_online" => true,
            "entity_type" => "individual"
        ],
        "marketplace" => "NONE",
        "marketplace_fee" => "10.00",
        "campaign_id" => "campaign_id",
        "items" => [
            [
                "title" => "Some item title",
                "unit_price" => "1000.00",
                "quantity" => 1,
                "description" => "Some item description",
                "code" => "item_code",
                "type" => "item_type",
                "picture_url" => "https://mysite.com/img/item.jpg",
                "warranty" => true,
                "category_descriptor" => [
                    "event_date" => "2024-01-01T00:00:00",
                    "passenger" => [
                        "first_name" => "John",
                        "last_name" => "Doe",
                        "identification_type" => "CPF",
                        "identification_number" => "00000000000"
                    ],
                    "route" => [
                        "departure" => "São Paulo",
                        "destination" => "Buenos Aires",
                        "departure_date_time" => "2024-01-01T00:00:00",
                        "arrival_date_time" => "2024-01-01T00:00:00",
                        "company" => "Airline company"
                    ]
                ]
            ]
        ],
        "coupon" => [
            "code" => "coupon_code",
            "amount" => "50.00"
        ],
        "splits" => [
            [
                "oauth_token" => "oauth_token",
                "type" => "amount",
                "value" => "10.00"
            ]
        ],
        "shipment" => [
            "receiver_address" => [
                "street_name" => "Av. das Nações Unidas",
                "street_number" => "99",
                "zip_code" => "99999999",
                "city_name" => "São Paulo",
                "state_name" => "SP",
                "floor" => "1",
                "apartment" => "1"
            ],
            "width" => 1,
            "height" => 1,
            "express_shipment" => true,
            "pick_up_on_seller" => false
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
