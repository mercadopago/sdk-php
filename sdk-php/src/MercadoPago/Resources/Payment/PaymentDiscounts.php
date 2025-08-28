<?php

namespace MercadoPago\Resources\Payment;

/** PaymentMethod class. */
class PaymentDiscounts
{
    /** Discount type. */
    public ?string $type;

    /** Discount value. */
    public ?float $value;

    /** Discount limit date. */
    public ?string $limit_date;
}
