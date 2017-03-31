<?php
  
  require_once dirname(__FILE__).'/../index.php';
  
  # Create a Payment
  require_once dirname(__FILE__).'/create.php';
  
  # Refunding
  $payment->refund();
  
  echo $payment->status;
  echo $payment->status_detail;
  
?>