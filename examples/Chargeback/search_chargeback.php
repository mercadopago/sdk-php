<?php

require_once(__DIR__ . '/../../vendor/autoload.php');

use MercadoPago\Client\Chargeback\ChargebackClient;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Net\MPSearchRequest;

MercadoPagoConfig::setAccessToken('<YOUR_ACCESS_TOKEN>');

$client = new ChargebackClient();

// Search chargebacks by payment ID
$search_request = new MPSearchRequest(20, 0, ['payment_id' => '<PAYMENT_ID>']);
$results = $client->search($search_request);
echo 'Total chargebacks: ' . $results->paging->total . PHP_EOL;

// Get a specific chargeback by ID
$chargeback = $client->get('<CHARGEBACK_ID>');
echo 'Chargeback status: ' . $chargeback->status . PHP_EOL;
echo 'Amount: ' . $chargeback->amount . ' ' . $chargeback->currency_id . PHP_EOL;
