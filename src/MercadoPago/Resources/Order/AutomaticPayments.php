<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

/**
 * Represents automatic/recurring payment configuration for an order payment.
 *
 * Used in subscription or recurring billing scenarios where payments
 * are charged automatically on a schedule.
 *
 * @see \MercadoPago\Resources\Order\Payment
 */
class AutomaticPayments
{
    /** Identifier of the stored payment profile used for automatic charges. */
    public ?string $payment_profile_id;

    /** Number of retry attempts allowed if the automatic charge fails. */
    public ?int $retries;

    /** ISO 8601 date when the automatic payment is scheduled to be charged. */
    public ?string $schedule_date;

    /** ISO 8601 date by which the payment must be completed before it is considered overdue. */
    public ?string $due_date;
}
