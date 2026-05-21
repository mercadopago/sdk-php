<?php

namespace MercadoPago\Resources\Point;

/**
 * Point Payment Intent Event resource.
 *
 * Represents a single event entry in the payment intent history for a Point device.
 * Each event records the payment intent ID, its status at that point in time,
 * and when the event occurred.
 */
class Events
{
    /** Payment intent ID. */
    public ?string $payment_intent_id;

    /** Status. */
    public ?string $status;

    /** Created on. */
    public ?string $created_on;
}
