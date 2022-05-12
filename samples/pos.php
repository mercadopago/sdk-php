<?php
 require_once 'vendor/autoload.php';

 MercadoPago\SDK::setAccessToken("TEST-4031330423711666-081715-153845d7ae897f18b750f9c06a8de15a-186120548");

 $pos = new MercadoPago\POS();

 $filters = [
     "external_store_id" => "999999999999"
 ];

$pos->search($filters);

var_dump($pos);

?>