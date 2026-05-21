<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents custom metadata associated with a payment in the MercadoPago API.
 *
 * Allows integrators to attach key-value data to payments for internal tracking
 * and reconciliation purposes. Nested within {@see \MercadoPago\Resources\Payment}.
 */
class Metadata
{
    /** Integrator-defined order number for mapping payments to internal orders. */
    public ?string $order_number;
}
