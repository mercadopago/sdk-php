<?php

namespace MercadoPago\Resources\Payment;

/** FeeDetails class. */
class FeeDetails
{
    /** Fee type. */
    public ?string $type;

    /** Who absorbs the cost. */
    public ?string $fee_payer;

    /** Fee amount. */
    public ?float $amount;
}
