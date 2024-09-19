<?php

require 'vendor/autoload.php';

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\MercadoPagoConfig;

MercadoPagoConfig::setAccessToken("TEST-8934915144594052-072012-1f7d378cec605ce3b38da7510838bd3f-692582067");
$client = new PaymentClient();

$request_options = new RequestOptions();
$request = [
    "transaction_amount" => (float) '100',
    "description" => 'teste',
    "payment_method_id" => 'bolbradesco',
    "payer" => [
        "first_name" => "uhsausha",
        "last_name" => "yhduajisf",
        "email" => 'test_user_11264832@testuser.com',
        "identification" => [
            "type" => "CPF",
            "number" => 19119119100
    ],
    "address" => [
        "zip_code" => "83471648",
        "street_name" => "endereco",
        "street_number" => "456",
        "neighborhood" => "bairro",
        "city" => "Floripa",
        "federal_unit" => "SC"
    ]]
];

try {
    $payment = $client->create($request, $request_options);
    var_dump($payment);

} catch (MPApiException $e) {
    var_dump($e);
} catch (\Exception $e) {
    // Handle all other exceptions
    var_dump($e);
}
//     echo "Content: ";
//     var_dump($e->getApiResponse()->getContent());
//     echo "\n";
// } catch (\Exception $e) {
//     // Handle all other exceptions
//     echo $e->getMessage();
// }
