<?php
  
  require_once dirname(__FILE__) . '/../../index.php';

  $config->set('ACCESS_TOKEN', 'TEST-6295877106812064-042916-6cead5bc1e48af95ea61cc9254595865__LC_LA__-202809963');


  # Create a Plan
  require_once dirname(__FILE__) . '/plan-create.php';
  
  $subscription = new MercadoPago\Subscription();
  
  $subscription->plan_id = $plan->id;
  
  $subscription->payer = array("id": "customer_id");
  
  $subscription->save();
  
  
?>