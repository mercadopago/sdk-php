<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

/** AutomaticPayments class. */
class AutomaticPayments
{
    /** Payment profile ID. */
    public ?string $payment_profile_id;

    /** Retries. */
    public ?int $retries;

    /** Schedule date. */
    public ?string $schedule_date;

    /** Due date. */
    public ?string $due_date;
}
