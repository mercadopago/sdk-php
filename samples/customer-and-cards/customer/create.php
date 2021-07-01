<?php

    require_once dirname(__FILE__).'/../../index.php';

    $customer = new MercadoPago\Customer();
    $customer->email = "your.payer@email.com";
    $customer->save();

    echo "Customer ID: " . $customer->id;

?>
