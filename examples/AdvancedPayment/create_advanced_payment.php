<?php

require_once(__DIR__ . '/../../vendor/autoload.php');

use MercadoPago\Client\AdvancedPayment\AdvancedPaymentClient;
use MercadoPago\MercadoPagoConfig;

MercadoPagoConfig::setAccessToken('<YOUR_ACCESS_TOKEN>');

$client = new AdvancedPaymentClient();

$request = [
    'application_id' => '<YOUR_APPLICATION_ID>',
    'payments' => [
        [
            'payment_method_id' => 'master',
            'payment_type_id' => 'credit_card',
            'token' => '<CARD_TOKEN>',
            'transaction_amount' => 100.0,
            'installments' => 1,
            'processing_mode' => 'aggregator',
            'description' => 'Split payment example',
            'external_reference' => 'PAYMENT-REF-001',
        ]
    ],
    'disbursements' => [
        [
            'collector_id' => '<SELLER_ID>',
            'amount' => 80.0,
            'external_reference' => 'SELLER-1-REF',
            'application_fee' => 2.0,
        ]
    ],
    'payer' => [
        'email' => 'buyer@example.com',
        'identification' => ['type' => 'CPF', 'number' => '19119119100'],
    ],
    'external_reference' => 'ADV-REF-001',
    'description' => 'Marketplace split payment',
    'capture' => false,
];

$advanced_payment = $client->create($request);
echo 'Advanced Payment ID: ' . $advanced_payment->id . PHP_EOL;
echo 'Status: ' . $advanced_payment->status . PHP_EOL;

// Capture the payment
$captured = $client->capture($advanced_payment->id);
echo 'Captured status: ' . $captured->status . PHP_EOL;
