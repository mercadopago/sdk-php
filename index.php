<?php

require_once __DIR__ . '/vendor/autoload.php';

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

MercadoPagoConfig::setAccessToken("");

$client = new PaymentClient();

$request = array(
    "description" => "Payment for product",
    "payment_method_id" => "pix",
    "transaction_amount" => 100,
    "payer" => array(
        "email" => "test@test.com"
    )
);

try {
    echo "\n------------- CREATE PAYMENT --------------";
    $payment = $client->create($request);
    echo "\nStatus code: " . $payment->getResponse()->getStatusCode();
    echo "\nPayment Id: " . $payment->id;
    echo "\nPayment Method Id: " . $payment->payment_method_id;
    echo "\nPayment Status: " . $payment->status;
    echo "\nPayer email: " . $payment->payer->email;
    echo "\nPayer identification number: " . $payment->payer->identification->number;
    echo "\nPayer identification type: " . $payment->payer->identification->type;
    echo "\nQR code: " . $payment->point_of_interaction->transaction_data->qr_code;

    echo "\n\n------------- GET PAYMENT --------------";
    $get = $client->get($payment->id);
    echo "\nStatus code: " . $get->getResponse()->getStatusCode();
    echo "\nPayment Id: " . $get->id;
    echo "\nPayment Method Id: " . $get->payment_method_id;
    echo "\nPayment Status: " . $get->status;

    echo "\n\n------------- CANCEL PAYMENT --------------";
    $cancel = $client->cancel($payment->id);
    echo "\nStatus code: " . $cancel->getResponse()->getStatusCode();
    echo "\nPayment Id: " . $cancel->id;
    echo "\nPayment Method Id: " . $cancel->payment_method_id;
    echo "\nPayment Status: " . $cancel->status;
} catch (MPApiException $ex) {
    echo "\nStatus code: " . $ex->getStatusCode();
    echo "\nContent: \n";
    var_dump($ex->getApiResponse()->getContent());
} catch (Exception $ex) {
    echo $ex;
}
