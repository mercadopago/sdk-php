# Mercado Pago SDK for PHP

[![Latest Stable Version](https://poser.pugx.org/mercadopago/dx-php/v/stable)](https://packagist.org/packages/mercadopago/dx-php)
[![Total Downloads](https://poser.pugx.org/mercadopago/dx-php/downloads)](https://packagist.org/packages/mercadopago/dx-php)
[![License](https://poser.pugx.org/mercadopago/dx-php/license)](https://packagist.org/packages/mercadopago/dx-php)

This library provides developers with a simple set of bindings to the Mercado Pago API.

## Requirements

PHP 5.6, 7.1 or major

## Installation 

### Using Composer

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) if not already installed

2. On your project directory run on the command line
`composer require "mercadopago/dx-php:2.0.0"` for PHP7 or `composer require "mercadopago/dx-php:1.8.1"` for PHP5.6.

Thats all, you have Mercado Pago SDK installed.

This how your directory structure would look like:

![installation-demo](img/ezgif-2-f98e8701825e.gif)

## Getting Started
  
  Simple usage looks like:
  
```php
  <?php
  
    require __DIR__  . '/vendor/autoload.php'; // You have to require the library from your Composer vendor folder

    MercadoPago\SDK::setAccessToken("YOUR_ACCESS_TOKEN"); // You can inform your Production or SandBox AccessToken

    $payment = new MercadoPago\Payment();

    $payment->transaction_amount = 141;
    $payment->token = "YOUR_CARD_TOKEN";
    $payment->description = "Ergonomic Silk Shirt";
    $payment->installments = 1;
    $payment->payment_method_id = "visa";
    $payment->payer = array(
      "email" => "larue.nienow@hotmail.com"
    );
 
    echo $payment->status;
    
  ?>
```

## Documentation 

See our Documentation with all APIs you can integrate and how do that [Spanish](https://www.mercadopago.com.ar/developers/es/guides/payments/api/introduction/) / [Portuguese](https://www.mercadopago.com.br/developers/pt/guides/payments/api/introduction/)

## Support 

Write us at [developers.mercadopago.com](https://developers.mercadopago.com)

## License 

MIT license. For more information, see the LICENSE file.
