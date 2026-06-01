<?php

require_once(__DIR__ . '/../../vendor/autoload.php');

use MercadoPago\Client\DisbursementRefund\DisbursementRefundClient;
use MercadoPago\MercadoPagoConfig;

MercadoPagoConfig::setAccessToken('<YOUR_ACCESS_TOKEN>');

$client = new DisbursementRefundClient();
$advanced_payment_id = 20458724;

// List all refunds for an advanced payment
$refunds = $client->listAll($advanced_payment_id);
echo 'Refunds: ' . count($refunds->refunds ?? []) . PHP_EOL;

// Refund a specific disbursement by amount
$disbursement_id = 123456;
$refund = $client->create($advanced_payment_id, $disbursement_id, 50.00);
echo 'Refund ID: ' . $refund->id . PHP_EOL;
echo 'Refund status: ' . $refund->status . PHP_EOL;
