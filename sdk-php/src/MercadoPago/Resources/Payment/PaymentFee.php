<?php

namespace MercadoPago\Resources\Payment;

/** PaymentMethod class. */
class PaymentFee
{
    /** Discount type. */
    public ?string $type;

    /** Discount value. */
    public ?float $value;
}
