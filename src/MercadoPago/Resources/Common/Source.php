<?php

namespace MercadoPago\Resources\Common;

/**
 * Represents the origin source of an action in the MercadoPago API.
 *
 * Typically used within refund responses to indicate which actor or system
 * initiated the refund (e.g. the collector, the buyer, or MercadoPago itself).
 *
 * @see \MercadoPago\Resources\PaymentRefund
 */
class Source
{
    /** Unique identifier of the source actor. */
    public ?string $id;

    /** Display name of the source actor. */
    public ?string $name;

    /** Type of source (e.g. "collector", "buyer", "admin"). */
    public ?string $type;
}
