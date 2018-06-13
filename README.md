# Mercado Pago SDK for PHP

[![Build Status](https://travis-ci.org/imasson/px-php.png)](https://travis-ci.org/imasson/px-php)
[![Coverage Status](https://coveralls.io/repos/github/imasson/px-php/badge.svg?branch=feature-ci-configuration-restclient)](https://coveralls.io/github/imasson/px-php?branch=feature-ci-configuration-restclient)

This library provides developers with a simple set of bindings to the Mercado Pago API.

### PHP Versions Supported:

The SDK supports PHP 5 or major

### Installation 

#### Using Composer

1. Download [Composer](https://getcomposer.org/download/) if not already installed
2. Go to your project directory and run `composer require "mercadopago/dx-php:dev-master"` on the command line.
3. This how your directory structure would look like.

![screen shot 2017-12-27 at 7 07 47 pm](https://user-images.githubusercontent.com/864790/34394635-44f7745a-eb39-11e7-981d-77cf759cf05f.png)

4. Thats all, you have Mercado Pago SDK installed.

### Quick Start 

1. You have to require the library from your Composer vendor folder.

  ```php
  require __DIR__  . '/vendor/autoload.php';
  ```

2. Setup your credentials

  You have two types of credentials:

  * **For API or custom checkout:**
    ```php
    MercadoPago\SDK::setAccessToken("YOUR_ACCESS_TOKEN");      // On Production
    MercadoPago\SDK::setAccessToken("YOUR_TEST_ACCESS_TOKEN"); // On Sandbox
    ```
  * **For Web-checkout:**
    ```php
    MercadoPago\SDK::setClientId("YOUR_CLIENT_ID");
    MercadoPago\SDK::setClientSecret("YOUR_CLIENT_SECRET");
    ```

3. Using resource objects.

  You can interact with all the resources available in the public API, to this each resource is represented by classes according to the following diagram:
  
  ![sdk resource structure](https://user-images.githubusercontent.com/864790/34393059-9acad058-eb2e-11e7-9987-494eaf19d109.png)
  
  **Sample**
  
```php
  <?php
  
    require_once 'vendor/autoload.php';

    MercadoPago\SDK::setAccessToken("YOUR_ACCESS_TOKEN");

    $payment = new MercadoPago\Payment();

    $payment->transaction_amount = 141;
    $payment->token = "YOUR_CARD_TOKEN";
    $payment->description = "Ergonomic Silk Shirt";
    $payment->installments = 1;
    $payment->payment_method_id = "visa";
    $payment->payer = array(
      "email" => "larue.nienow@hotmail.com"
    );

    $payment->save();

    echo $payment->status;

  ?>
```
  
### Support 

Write us at [developers.mercadopago.com](https://developers.mercadopago.com)
