<?php
  
  require_once dirname(__FILE__).'/../index.php';
  
  $config->set('ACCESS_TOKEN', 'ACCESS_TOKEN');
  
  
  $payment = new MercadoPago\Payment();
  
  $payment->transaction_amount = 100;
  $payment->token = "34322a2f43ba6858d2697c999523a0d8";
  $payment->description = "Title of what you are paying for";
  $payment->installments = 1;
  $payment->payment_method_id = "visa";
  
  $payer = new MercadoPago\Payer();
  $payer->email = "mail@joelibaceta.com";
  
  $payment->payer = $payer;
  
  $payment->save(); 
  
  echo $payment->status;
  echo $payment->status_detail;
  
    
  
?>