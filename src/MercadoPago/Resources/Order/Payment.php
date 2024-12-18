<?php

/** API version: b950ae02-4f49-4686-9ad3-7929b21b6495 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Payment class. */
class Payment
{
    /** Class mapper. */
    use Mapper;

    /** Payment ID. */
    public ?string $id;

    /** Reference ID. */
    public ?string $reference_id;

    /** Status. */
    public ?string $status;

    /** Status detail. */
    public ?string $status_detail;

    /** Amount. */
    public ?string $amount;

    /** Payment method. */
    public array|object|null $payment_method;

    /** Automatic Payments. */
    public array|object|null $automatic_payments;

    /** Stored Payments */
    public array|object|null $stored_credential;

    /** Subscription Data */
    public array|object|null $subscription_data;

    private $map = [
        "payment_method" => "MercadoPago\Resources\Order\PaymentMethod",
        "automatic_payments" => "MercadoPago\Resources\Order\AutomaticPayments" ,
        "stored_credential" => "MercadoPago\Resources\Order\StoredCredential",
        "subscription_data" => "MercadoPago\Resources\Order\SubscriptionData",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
