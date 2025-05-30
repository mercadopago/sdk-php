<?php

namespace Examples\Chargeback;

// Step 1: Require the Composer library
require_once '../../vendor/autoload.php';

use MercadoPago\Client\Chargeback\ChargebackClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;

// Step 2: Set the production or sandbox access token
MercadoPagoConfig::setAccessToken("<YOUR_ACCESS_TOKEN>");

// Step 3: Initialize the API client
$client = new ChargebackClient();

try {
    // Step 4: Create search filters
    $search_filters = array(
        "payment_id" => "PAYMENT_ID", // Optional: filter by payment ID
        "status" => "open", // Optional: filter by status (open, closed, etc.)
        "stage" => "chargeback", // Optional: filter by stage
        "offset" => 0,
        "limit" => 50
    );

    $search_request = new MPSearchRequest($search_filters);

    // Step 5: Perform the search
    $search_result = $client->search($search_request);

    echo "Total results: " . $search_result->paging->total . "\n";
    echo "Results found: " . count($search_result->results) . "\n\n";

    // Step 6: Display results
    foreach ($search_result->results as $chargeback) {
        echo "Chargeback ID: " . $chargeback->id . "\n";
        echo "Payment ID: " . $chargeback->payment_id . "\n";
        echo "Amount: " . $chargeback->amount . " " . $chargeback->currency . "\n";
        echo "Status: " . $chargeback->status . "\n";
        echo "Reason: " . $chargeback->reason . "\n";
        echo "Date Created: " . $chargeback->date_created . "\n";
        echo "---\n";
    }

    // Step 7: Handle exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: ";
    var_dump($e->getApiResponse()->getContent());
    echo "\n";
} catch (\Exception $e) {
    echo $e->getMessage();
} 