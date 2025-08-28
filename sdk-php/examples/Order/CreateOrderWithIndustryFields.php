<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

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
        "external_reference" => "ext_ref_1234",
        "processing_mode" => "automatic",
        "marketplace" => "NONE",
        "total_amount" => "1000.00",
        "transactions" => [
            "payments" => [
                [
                    "amount" => "1000.00",
                    "payment_method" => [
                        "id" => "pix",
                        "type" => "bank_transfer",
                    ]
                ]
            ]
        ],
        "processing_mode" => "automatic",
        "currency" => "BRL",
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
                "street_number" => "99",
                "zip_code" => "04578-000",
                "neighborhood" => "Itaim Bibi",
                "city" => "São Paulo",
                "state" => "SP",
                "complement" => "Apto 123"
            ]
        ],
        "marketplace" => "NONE",
        "marketplace_fee" => "10.00",
        "items" => [
            [
                "title" => "Some item title",
                "external_code" => "item_id",
                "unit_price" => "1000.00",
                "quantity" => 1,
                "description" => "Some item description",
                "category_id" => "category_id",
                "picture_url" => "https://mysite.com/img/item.jpg",
                "type" => "product",
                "warranty" => true,
                "event_date" => "2023-10-01T00:00:00Z"
            ]
        ],
        "shipment" => [
            "address" => [
                "street_name" => "Avenida das Nações Unidas",
                "street_number" => "3003",
                "zip_code" => "06233903",
                "neighborhood" => "Bonfim",
                "city" => "Osasco",
                "state" => "SP",
                "complement" => "2"
            ]
        ],
        "additional_info" => [
            "payer.authentication_type" => "MOBILE",
            "payer.registration_date" => "2024-01-01T00:00:00",
            "payer.is_prime_user" => true,
            "payer.is_first_purchase_online" => true,
            "payer.last_purchase" => "2024-01-01T00:00:00",
            "shipment.express" => true,
            "shipment.local_pickup" => true,
            "platform.shipment.delivery_promise" => "2024-12-31T23:59:59Z",
            "platform.shipment.drop_shipping" => "string",
            "platform.shipment.safety" => "string",
            "platform.shipment.tracking.code" => "1233",
            "platform.shipment.tracking.status" => "em rota",
            "platform.shipment.withdrawn" => true,
            "platform.seller.id" => "123456",
            "platform.seller.name" => "Example Seller",
            "platform.seller.email" => "seller@example.com",
            "platform.seller.status" => "Active",
            "platform.seller.referral_url" => "https://example.com",
            "platform.seller.registration_date" => "2020-01-01T00:00:00.000-03:00",
            "platform.seller.hired_plan" => "Premium",
            "platform.seller.business_type" => "E-commerce",
            "platform.seller.address.zip_code" => "01310-000",
            "platform.seller.address.street_name" => "Av. Paulista",
            "platform.seller.address.street_number" => "100",
            "platform.seller.address.city" => "São Paulo",
            "platform.seller.address.state" => "SP",
            "platform.seller.address.complement" => "101",
            "platform.seller.address.country" => "Brasil",
            "platform.seller.identification.type" => "CNPJ",
            "platform.seller.identification.number" => "12.345.678/0001-99",
            "platform.seller.phone.number" => "987654321",
            "platform.seller.phone.area_code" => "11",
            "platform.authentication" => "string",
            "travel.passengers" => [
                [
                    "first_name" => "<FIRST_NAME>",
                    "last_name" => "<LAST_NAME>",
                    "identification" => [
                        "type" => "CPF",
                        "number" => "11111111111"
                    ]
                ]
            ],
            "travel.routes" => [
                [
                    "departure" => "GRU",
                    "destination" => "CWB",
                    "departure_date_time" => "2020-01-01T00:00:00.000-03:00",
                    "arrival_date_time" => "2020-01-01T00:00:00.000-03:00",
                    "company" => "gol"
                ],
                [
                    "departure" => "GRU",
                    "destination" => "CWB",
                    "departure_date_time" => "2020-01-01T00:00:00.000-03:00",
                    "arrival_date_time" => "2020-01-01T00:00:00.000-03:00",
                    "company" => "azul"
                ]
            ]
        ],
        "expiration_time" => "P3D"
    ];

    // Step 5: Create the request options, setting X-Idempotency-Key
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <IDEMPOTENCY_KEY>"]);

    // Step 6: Make the request
    $order = $client->create($request, $request_options);
    print_r($order);

    // Step 7: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
