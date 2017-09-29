<?php
  
  require_once dirname(__FILE__) . '/../../index.php';

  $config->set('ACCESS_TOKEN', 'TEST-6295877106812064-042916-6cead5bc1e48af95ea61cc9254595865__LC_LA__-202809963');
  
  $plan = new MercadoPago\Plan();

  $plan->description = "Monthly premium package";
  $plan->auto_recurring = array(
    "frequency" => 1,
    "frequency_type" => "months",
    "transaction_amount" => 200
  );

  $plan->save();

  echo var_dump ($plan);
  
?>