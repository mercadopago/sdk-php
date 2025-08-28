<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** Subscription data class. */
class SubscriptionData
{
    /** Class mapper. */
    use Mapper;

    /** Subscription sequence. */
    public array|object|null $subscription_sequence;

    /** Invoice ID. */
    public ?string $invoice_id;

    /** Invoice period. */
    public array|object|null $invoice_period;

    /** Billing date. */
    public ?string $billing_date;

    private $map = [
        "subscription_sequence" => "MercadoPago\Resources\Order\SubscriptionSequence",
        "invoice_period" => "MercadoPago\Resources\Order\InvoicePeriod",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
