<?php

namespace Examples\Chargeback;

// Step 1: Require the Composer library
require_once '../../vendor/autoload.php';

use MercadoPago\Client\Chargeback\ChargebackClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

// Step 2: Set the production or sandbox access token
MercadoPagoConfig::setAccessToken("<YOUR_ACCESS_TOKEN>");

// Step 3: Initialize the API client
$client = new ChargebackClient();

try {
    // Step 4: Get chargeback by ID
    $chargeback_id = "CHARGEBACK_ID";
    $chargeback = $client->get($chargeback_id);

    echo "Chargeback ID: " . $chargeback->id . "\n";
    echo "Payment ID: " . $chargeback->payment_id . "\n";
    echo "Amount: " . $chargeback->amount . "\n";
    echo "Status: " . $chargeback->status . "\n";
    echo "Reason: " . $chargeback->reason . "\n";
    echo "Stage: " . $chargeback->stage . "\n";

    // Step 5: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
} 