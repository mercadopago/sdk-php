![image](https://github.com/mercadopago/sdk-php/assets/86324641/46001c9c-b28a-44cb-9fc3-211712be5022)

# Mercado Pago SDK for PHP

[![Latest Stable Version](https://poser.pugx.org/mercadopago/dx-php/v/stable)](https://packagist.org/packages/mercadopago/dx-php) [![Total Downloads](https://poser.pugx.org/mercadopago/dx-php/downloads)](https://packagist.org/packages/mercadopago/dx-php) [![License](https://poser.pugx.org/mercadopago/dx-php/license)](https://packagist.org/packages/mercadopago/dx-php)

This library provides developers with a simple set of bindings to help you integrate Mercado Pago API to a website and start receiving payments.

## 💡 Requirements

The SDK Supports PHP version 8.2 or higher.

## 💻 Installation

First time using Mercado Pago? Create your [Mercado Pago account](https://www.mercadopago.com), if you don’t have one already.

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) if not already installed.

2. Install PHP SDK for MercadoPago running in command line:

```
composer require "mercadopago/dx-php:3.0.0
```

3. Copy the access_token in the [credentials](https://www.mercadopago.com/developers/en/docs/your-integrations/credentials) section of the page and replace YOUR_ACCESS_TOKEN with it.

That's it! Mercado Pago SDK has been successfully installed.

## 🌟 Getting Started

Simple usage looks like:

```php
<?php
    // Step 1: Require the library from your Composer vendor folder
    require_once 'vendor/autoload.php';

    use MercadoPago\Client\Payment\PaymentClient;
    use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\MercadoPagoConfig;

    // Step 2: Set production or sandbox access token
    MercadoPagoConfig::setAccessToken("<ACCESS_TOKEN>");

    // Step 3: Initialize the API client
    $client = new PaymentClient();

    try {

        // Step 4: Create the request array
        $request = [
            "transaction_amount" => 100,
            "token" => "YOUR_CARD_TOKEN",
            "description" => "description",
            "installments" => 1,
            "payment_method_id" => "visa",
            "payer" => [
                "email" => "user@test.com",
            ]
        ];

        // Step 5: Make the request
        $payment = $client->create($request);
        echo $payment->id;

    // Step 6: Handle exceptions
    } catch (MPApiException $e) {
        echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
        echo "Content: " . $e->getApiResponse()->getContent() . "\n";
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
```

### Step 1: Require the library from your Composer vendor folder
```php
require_once 'vendor/autoload.php';

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
```

### Step 2: Set production or sandbox access token
```php
MercadoPagoConfig::setAccessToken("<ACCESS_TOKEN>");
```

You can also set another properties as quantity of retries, tracking headers, timeouts and a custom http client.

### Step 3: Initialize the API client
```php
$client = new PaymentClient();
```

### Step 4: Create the request array
```php
$request = [
    "transaction_amount" => 100,
    "token" => "YOUR_CARD_TOKEN",
    "description" => "description",
    "installments" => 1,
    "payment_method_id" => "visa",
    "payer" => [
        "email" => "user@test.com",
    ]
];
```

### Step 5: Make the request
```php
$payment = $client->create($request);
```

### Step 6: Handle exceptions
```php
...
// Handle API exceptions
} catch (MPApiException $e) {
    echo "Status code: " . $e->getApiResponse()->getStatusCode() . "\n";
    echo "Content: " . $e->getApiResponse()->getContent() . "\n";

// Handle all other exceptions
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## 📚 Documentation

See our documentation for more details.

- Mercado Pago reference API. [Portuguese](https://www.mercadopago.com/developers/pt/reference) / [English](https://www.mercadopago.com/developers/en/reference) / [Spanish](https://www.mercadopago.com/developers/es/reference)

## 🤝 Contributing

All contributions are welcome, ranging from people wanting to triage issues, others wanting to write documentation, to people wanting to contribute code.

Please read and follow our [contribution guidelines](CONTRIBUTING.md). Contributions not following these guidelines will
be disregarded. The guidelines are in place to make all of our lives easier and make contribution a consistent process for everyone.

## ❤️ Support

If you require technical support, please contact our support team at our developers site: [English](https://www.mercadopago.com/developers/en/support/center/contact) / [Portuguese](https://www.mercadopago.com/developers/pt/support/center/contact) / [Spanish](https://www.mercadopago.com/developers/es/support/center/contact)

## 🏻 License

```
MIT license. Copyright (c) 2023 - Mercado Pago / Mercado Libre
For more information, see the LICENSE file.
```
