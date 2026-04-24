<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

/**
 * Represents stored credential (card-on-file) data for an order payment.
 *
 * Used to indicate whether a payment uses previously stored card credentials
 * and whether the transaction is merchant-initiated or cardholder-initiated,
 * as required by card network regulations.
 *
 * @see \MercadoPago\Resources\Order\Payment
 */
class StoredCredential
{
    /** Who initiated the payment: "cardholder" or "merchant". */
    public ?string $payment_initiator;

    /** Reason for using stored credentials (e.g., "recurring", "installment", "unscheduled"). */
    public ?string $reason;

    /** Whether to store the payment method for future transactions. */
    public ?bool $store_payment_method;

    /** Whether this is the first payment in a series using these credentials. */
    public ?bool $first_payment;
}
