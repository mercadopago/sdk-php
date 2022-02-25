<?php

    require_once dirname(__FILE__) . '/../../index.php';

    $payment = new MercadoPago\Entities\Shared\Payment();

    $payment->transaction_amount = 100;
    $payment->token = "CARD_TOKEN";
    $payment->description = "Title of what you are paying for";
    $payment->installments = 1;

    $payer = new MercadoPago\Entities\Shared\Payer();
    $payer->email = "your.payer@email.com";

    $payment->payer = $payer;
    $payment->save(); 

    echo "Payment ID: " . $payment->id . "\n";
    echo "Payment Status: " . $payment->status . "\n";

?>
