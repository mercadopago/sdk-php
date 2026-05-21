<?php

/**
 * Mercado Pago — Create Order with PSE (Pagos Seguros en Línea — Colombia).
 *
 * PSE is Colombia's standard online bank-transfer payment method. The integrator initiates
 * the transaction with payment_method.id = "pse" and type = "bank_transfer", and must
 * specify the buyer's bank via financial_institution.
 *
 * Required PSE-specific fields:
 *   - payment_method.id              = "pse" (fixed)
 *   - payment_method.type            = "bank_transfer" (fixed)
 *   - payment_method.financial_institution = PSE bank code (see table below)
 *   - currency                       = "COP" (Colombia only)
 *   - payer.entity_type              = "individual" or "association"
 *   - payer.identification.type      = "CC", "NIT", etc. (Colombian doc type)
 *   - additional_info["payer.ip_address"] (required by risk engine; uses dot-notation key)
 *   - config.online.callback_url     (URL the bank redirects to after authorization)
 *
 * Most-used PSE bank codes (full catalog via MP API):
 *   Bancolombia ........... 1007
 *   Davivienda ............ 1051
 *   Banco de Bogotá ....... 1001
 *   BBVA Colombia ......... 1013
 *   Banco Popular ......... 1002
 *   Scotiabank Colpatria .. 1019
 *
 * @link https://www.mercadopago.com.co/developers/es/docs Documentación oficial PSE
 */

namespace Examples\Order;

// Step 1: Require the library from your Composer vendor folder
require_once '../../vendor/autoload.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Order\OrderClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

// Step 2: Set production or sandbox access token
MercadoPagoConfig::setAccessToken("<ACCESS_TOKEN>");

// Step 3: Initialize the API client
$client = new OrderClient();

try {
    // Step 4: Build the PSE Order request.
    $request = [
        "type" => "online",
        "processing_mode" => "automatic",
        "total_amount" => "50000.00",
        "currency" => "COP",
        "external_reference" => "ref_pse_12345",
        "transactions" => [
            "payments" => [
                [
                    "amount" => "50000.00",
                    // PSE payment: id="pse", type="bank_transfer", financial_institution = bank code.
                    "payment_method" => [
                        "id" => "pse",
                        "type" => "bank_transfer",
                        "financial_institution" => "1007", // Bancolombia
                    ]
                ]
            ]
        ],
        // Payer: entity_type + Colombian identification (CC/NIT) required for PSE.
        "payer" => [
            "entity_type" => "individual",
            "email" => "<PAYER_EMAIL>",
            "first_name" => "<FIRST_NAME>",
            "last_name" => "<LAST_NAME>",
            "identification" => [
                "type" => "CC",
                "number" => "<PAYER_DOC_NUMBER>"
            ]
        ],
        // additional_info uses dot-notation keys in PHP (per the SDK pattern).
        // payer.ip_address — required by MP's risk engine for PSE.
        "additional_info" => [
            "payer.ip_address" => "<CLIENT_IP>"
        ],
        // callback_url — where the bank redirects the buyer after authorization.
        "config" => [
            "online" => [
                "callback_url" => "<CALLBACK_URL>"
            ]
        ]
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
