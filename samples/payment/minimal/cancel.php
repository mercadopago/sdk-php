<?php
  
  require_once dirname(__FILE__) . '/../../index.php';
  
  $config->set('ACCESS_TOKEN', 'TEST-6295877106812064-042916-6cead5bc1e48af95ea61cc9254595865__LC_LA__-202809963');

  # Create a Payment
  require_once dirname(__FILE__) . '/create.php';

  # Cancel the previous payment, only works from a pending or in_process status
  $payment->status = "canceled";
  $payment->update();
  
  echo $payment->status;
  echo $payment->status_detail;
  
?>