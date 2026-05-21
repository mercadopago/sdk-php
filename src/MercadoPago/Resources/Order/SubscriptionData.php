<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents subscription billing data associated with an order payment.
 *
 * Contains information about the recurring billing cycle, including which
 * invoice in the sequence this payment corresponds to and the billing period.
 *
 * @see \MercadoPago\Resources\Order\Payment
 */
class SubscriptionData
{
    /** Class mapper. */
    use Mapper;

    /** Position of this payment within the subscription series. Maps to {@see SubscriptionSequence}. */
    public array|object|null $subscription_sequence;

    /** Unique identifier of the invoice being paid. */
    public ?string $invoice_id;

    /** Billing period definition for this subscription cycle. Maps to {@see InvoicePeriod}. */
    public array|object|null $invoice_period;

    /** ISO 8601 date when this subscription billing was generated. */
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
