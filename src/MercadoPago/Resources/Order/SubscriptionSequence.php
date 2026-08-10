<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

/**
 * Represents the sequence position of a payment within a subscription plan.
 *
 * Tracks which installment or billing cycle this payment corresponds to
 * out of the total number of planned payments.
 *
 * @see \MercadoPago\Resources\Order\SubscriptionData
 */
class SubscriptionSequence
{
    /** Current payment number in the subscription series (e.g., 3 for the third payment). */
    public ?int $number;

    /** Total number of planned payments in the subscription (null if open-ended). */
    public ?int $total;
}
