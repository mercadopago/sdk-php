<?php

namespace Examples\Preference;

// Passo 1: Requerir a biblioteca do Composer
require_once '../../vendor/autoload.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

// Passo 2: Definir o token de acesso de produção ou sandbox
MercadoPagoConfig::setAccessToken("<YOUR_ACCESS_TOKEN>");

// Passo 2.1 (opcional): Definir o ambiente de runtime
MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::SERVER);

// Passo 3: Inicializar o cliente da API
$client = new PreferenceClient();

try {
    // Passo 4: Criar o array de requisição
    $request = [
        "back_urls" => [
            "success" => "http://www.mercadopago.cl/success",
            "pending" => "http://www.mercadopago.cl/pending",
            "failure" => "http://www.mercadopago.cl/failure"
        ],
        "payer" => [
            "name" => "Juan",
            "surname" => "Lopez",
            "email" => "juanlopez@email.com"
        ],
        "items" => [
            [
                "title" => "Producto sin descripción", // Título do item
                "unit_price" => 1000,                // Preço unitário
                "quantity" => 1,                     // Quantidade
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

    // Passo 5: Criar as opções de requisição, definindo X-Idempotency-Key
    $request_options = new RequestOptions();
    $request_options->setCustomHeaders(["X-Idempotency-Key: <UNIQUE_KEY>"]);

    // Passo 6: Fazer a requisição
    $preference = $client->create($request, $request_options);
    echo "Preference ID: " . $preference->id;

    // Passo 7: Lidar com exceções
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
}
