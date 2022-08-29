<?php

    require_once dirname(__FILE__) . '/../../index.php';

    $preapproval_data = new MercadoPago\Preapproval();

    $preapproval_data->payer_email = "your.payer@email.com";
    $preapproval_data->back_url = "http://www.my-site.com";
    $preapproval_data->reason = "Monthly subscription to premium package";
    $preapproval_data->external_reference = "OP-1234";
    $preapproval_data->auto_recurring = array( 
        "frequency" => 1,
        "frequency_type" => "months",
        "transaction_amount" => 10,
        "currency_id" => "XXX", // your currency
        "start_date" => date(DATE_ISO8601),
        "end_date" => date(DATE_ISO8601, strtotime('+5 years'))
    );

    $preapproval_data->save();

    var_dump($preapproval_data);

?>
