<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents a single payment attempt within an order payment.
 *
 * When a payment is retried (e.g., after a decline), each try is recorded
 * as an Attempt with its own status and payment method details.
 *
 * @see \MercadoPago\Resources\Order\Payment
 */
class Attempt
{
    /** Class mapper. */
    use Mapper;

    /** Unique identifier of this payment attempt. */
    public ?string $id;

    /** Outcome status of the attempt (e.g., "approved", "rejected"). */
    public ?string $status;

    /** Granular reason for the attempt status (e.g., "cc_rejected_insufficient_amount"). */
    public ?string $status_detail;

    /** Payment method details used in this attempt. Maps to {@see PaymentMethod}. */
    public array|object|null $payment_method;

    private $map = [
        "payment_method" => "MercadoPago\Resources\Order\PaymentMethod",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
