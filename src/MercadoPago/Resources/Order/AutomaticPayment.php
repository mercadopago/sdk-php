<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

/** Automatic Payment Class */
class AutomaticPayment
{
    /** Payment profile id */
    public ?string $payment_profile_id;

    /** Retries */
    public ?int  $retries;

    /** Schedule Date */
    public ?string $schedule_date;

    /** Due Date */
    public ?string $due_date;
}
