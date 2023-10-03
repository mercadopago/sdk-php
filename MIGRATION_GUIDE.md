# Migration Guide from MercadoPago PHP SDK v2 to v3

## Introduction
This guide aims to assist developers using the MercadoPago PHP SDK in migrating from version 2 to version 3.

## Motivation
The new version of the MercadoPago PHP SDK was developed based on developer feedback and with the goal of improving the integration experience with the MercadoPago API. Improvements have been made to the code structure, new features have been added, and documentation has been enhanced.

## Major Changes

### SDK Structure
In the new version, the SDK structure has been reorganized to improve code readability and maintenance. Now, files are organized into directories based on their functionality.

Here is the new SDK structure:

```
- src/
    - MercadoPago/
        - Client/
        - Exceptions/
        - Net/
        - Resources/
        - Serialization/
        - ...
- tests/
    - MercadoPago/
        - ...
- ...
```

### Dependency Update
The new version of the MercadoPago PHP SDK requires PHP version 8.2 or higher. Make sure your application meets this requirement before proceeding with the migration.

### Use of Composer
The new version of the MercadoPago PHP SDK uses Composer to manage dependencies. Make sure you have Composer installed in your development environment before proceeding with the migration.

## Step-by-Step Migration

### Step 1: SDK Installation
To install the new version of the MercadoPago PHP SDK, execute the following command in the root directory of your application:

```
composer require "mercadopago/dx-php:3.0.0"
```

### Step 2: Update Imports
In the new SDK version, some namespaces have been updated. Check all the imports in your code and update them according to the new SDK structure.

- **Version 2 example:**
```php
require_once './vendor/autoload.php';

MercadoPago\SDK::setAccessToken("<ACCESS_TOKEN>");

$payment = new MercadoPago\Payment();
```

- **Version 3 example:**
```php
require_once './vendor/autoload.php';

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

MercadoPagoConfig::setAccessToken("<ACCESS_TOKEN>");

$client = new PaymentClient();
```

### Step 3: Update Methods
Some methods have been renamed and/or removed in the new SDK version. Check all the methods used in your code and update them according to the new version.

- **Version 2 example:**
```php
$payment = new MercadoPago\Payment();
$payment->transaction_amount = 100;
$payment->description = "<PRODUCT_DESCRIPTION>";
$payment->payment_method_id = "<PAYMENT_METHOD_ID>";
$payment->payer = array(
    "email" => "<PAYER_EMAIL>",
    "first_name" => "<PAYER_FIRST_NAME>",
    "last_name" => "<PAYER_LAST_NAME>",
    "identification" => array(
        "type" => "<IDENTIFICATION_TYPE>",
        "number" => "<IDENTIFICATION_NUMBER>"
     ),
    "address"=>  array(
        "zip_code" => "<ZIP_CODE>",
        "street_name" => "<STREET_NAME>",
        "street_number" => "<STREET_NUMBER>",
        "neighborhood" => "<NEIGHBORHOOD>",
        "city" => "<CITY>",
        "federal_unit" => "<FEDERAL_UNIT>"
     )
  );

$payment->save();

var_dump($payment);
```

- **Version 3 example:**
```php
$client = new PaymentClient();
$request = array(
    "transaction_amount" => 100,
    "description" => "<PRODUCT_DESCRIPTION>",
    "payment_method_id" => "<PAYMENT_METHOD_ID>",
    "payer" => [
        "email" => "<PAYER_EMAIL>",
        "first_name" => "<PAYER_FIRST_NAME>",
        "last_name" => "<PAYER_LAST_NAME>",
        "identification" => [
            "type" => "<IDENTIFICATION_TYPE>",
            "number" => "<IDENTIFICATION_NUMBER>"
        ],
        "address" =>  [
            "zip_code" => "<ZIP_CODE>",
            "street_name" => "<STREET_NAME>",
            "street_number" => "<STREET_NUMBER>",
            "neighborhood" => "<NEIGHBORHOOD>",
            "city" => "<CITY>",
            "federal_unit" => "<FEDERAL_UNIT>"
        ]
    ]
);

try {
    $payment = $client->create($request);
    echo "Payment ID: $payment->id\n";
    echo "Payment Status: $payment->status\n";
} catch (MPApiException $e) {
    var_dump($e);
} catch (Exception $e) {
    var_dump($e);
}
```

### Step 4: Update exception handling
The way we handle exceptions has changed. Now it's easier to identify if the error is from some API catching the `MPApiException` and accessing it's status code and content.

```php
catch (MPApiException $e) {
    echo $e->getApiResponse()->getStatusCode();
    echo $e->getApiResponse()->getContent();
}
```

And not API errors can be catched by using the standard Exception.

```php
catch (Exception $e) {
    echo $e->getMessage();
}
```

### Step 5: Review the Documentation
The new version of the MercadoPago PHP SDK comes with more comprehensive and up-to-date documentation. We recommend that you review the documentation to understand all the changes and take advantage of the new available features.

- [SDKs documentation](https://www.mercadopago.com/developers/en/docs/sdks-library/server-side).

## Conclusion
This guide has provided the necessary steps to migrate from MercadoPago PHP SDK v2 to the new version. We hope this information is helpful to you and that you make the most of the resources and improvements available in the new version.

If you have any questions or encounter any issues during the migration, we recommend consulting the official MercadoPago PHP SDK documentation or contacting MercadoPago support.
