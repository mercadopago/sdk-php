<?php

namespace Examples\Payment;

// Step 1: Require the Composer library
require_once '../../vendor/autoload.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

// Step 2: Set the production or sandbox access token
MercadoPagoConfig::setAccessToken('<ACCESS_TOKEN>');
// Step 2.1 (optional - default is SERVER): Set your runtime enviroment from MercadoPagoConfig::RUNTIME_ENVIROMENTS
// In case you want to test in your local machine first, set runtime enviroment to LOCAL
MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

// Step 3: Initialize the API client
$client = new PaymentClient();

try {
    // Step 4: Create the request array
    $request = [
        "transaction_amount" => 1000,
        "description"        => "Product title",
        "payment_method_id"  => "master",
        "token"              => "{{CARD_TOKEN}}",
        "installments"       => 1,
        "application_fee"    => null,
        "binary_mode"        => true,
        "capture"            => true,
        "external_reference" => "Pedido01",
        "metadata"           => new \stdClass(),
        "notification_url"   => "https://www.mercadopago.com",
        "sponsor_id"         => null,
        "statement_descriptor" => "LOJA 123",
        "payer" => [
            "first_name" => "Name",
            "last_name"  => "Surname",
            "email"      => "{{EMAIL}}",
            "identification" => [
                "number" => "{{DOCUMENT_NUMBER}}",
                "type"   => "CPF"
            ],
            "phone" => [
                "area_code" => "11",
                "number"    => "{{PHONE_NUMBER}}"
            ],
            "address" => [
                "street_name"    => "Av. das Nações Unidas",
                "street_number"  => "3003",
                "zip_code"       => "206233-2002"
            ]
        ],
        "forward_data" => [
            "sub_merchant" => [
                "sub_merchant_id"    => "1234183712",
                "mcc"                => "5462",
                "country"            => "BRA",
                "address_door_number"=> 123,
                "zip"                => "2222222",
                "document_number"    => "222222222222222",
                "city"               => "SÃO PAULO",
                "address_street"     => "RUA A",
                "legal_name"         => "LOJINHA DO ZÉ",
                "region_code_iso"    => "BR-MG",
                "region_code"        => "BR",
                "document_type"      => "CNPJ",
                "phone"              => "{{PHONE}}",
                "url"                => "www.mercadopago.com"
            ]
        ],
        "additional_info" => [
            "items" => [
                [
                    "id"          => "1941",
                    "title"       => "25/08/2022 | Pista Inteira5 lote - GREEN VALLEY GRAMADO 2022",
                    "description" => "25/08/2022 | Pista Inteira5 lote - GREEN VALLEY GRAMADO 2022",
                    "category_id"  => "Tickets",
                    "quantity"     => 1,
                    "unit_price"   => 1000.00,
                    "event_date"   => "2019-12-25T19:30:00.000-03:00",
                    "picture_url"  => "{{IMAGE_URL}}",
                    "type"         => "my_items_type",
                    "warranty"     => true,
                    "category_descriptor" => [
                        "passenger" => [
                            "first_name"    => "Guest name",
                            "last_name"     => "Guest surname",
                            "identification"=> [
                                "type"      => "DNI",
                                "number"    => "{{DOCUMENT}}"
                            ]
                        ],
                        "route" => [
                            "arrival_date_time"   => "2022-03-14T12:58:41.425-04:00",
                            "company"             => "Companhia",
                            "departure"           => "Osasco",
                            "departure_date_time" => "2022-03-12T12:58:41.425-04:00",
                            "destination"         => "Sao Paulo"
                        ]
                    ]
                ]
            ],
            "payer" => [
                "first_name" => "Name",
                "last_name"  => "Surname",
                "is_prime_user" => true,
                "is_first_purchase_online" => true,
                "last_purchase" => "2019-10-25T19:30:00.000-03:00",
                "phone" => [
                    "area_code" => "11",
                    "number"    => "{{PHONE_NUMBER}}"
                ],
                "address" => [
                    "street_name"    => "Av. das Nações Unidas",
                    "street_number"  => "3003",
                    "zip_code"       => "206233-2002"
                ],
                "registration_date"    => "2020-08-06T09:25:04.000-03:00",
                "authentication_type"  => "Gmail"
            ],
            "shipments" => [
                "local_pickup" => "1",
                "express_shipment" => true,
                "receiver_address" => [
                    "zip_code"     => "306233-2003",
                    "street_name"  => "Av. das Nações Unidas",
                    "street_number"=> "3003",
                    "floor"        => "5",
                    "apartment"    => "502",
                    "state_name"   => "DF",
                    "city_name"    => "Bogota"
                ]
            ]
        ],
    ];

   // Step 5: Create the request options, setting X-Idempotency-Key
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);

    // Step 6: Make the request
    $payment = $client->create($request, $request_options);
    echo "Payment ID: " . $payment->id . "\n";
    echo "Status: " . $payment->status . "\n";

 // Step 7: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
