<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents the order associated with a payment in the MercadoPago API.
 *
 * Links a payment to an order entity, which can represent a MercadoPago
 * marketplace order or a merchant order.
 * Nested within {@see \MercadoPago\Resources\Payment}.
 */
class Order
{
    /** Unique identifier of the associated order. */
    public ?int $id;

    /** Order type (e.g. "mercadolibre", "mercadopago"). */
    public ?string $type;

}
