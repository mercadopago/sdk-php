<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents an individual fee applied to a payment in the MercadoPago API.
 *
 * Payments may have multiple fee entries (e.g. MercadoPago commission, marketplace fee).
 * Nested as an array within the {@see \MercadoPago\Resources\Payment} response.
 */
class FeeDetails
{
    /** Type of fee (e.g. "mercadopago_fee", "coupon_fee", "financing_fee"). */
    public ?string $type;

    /** Party that absorbs the fee cost (e.g. "collector", "payer"). */
    public ?string $fee_payer;

    /** Fee amount in the payment's currency. */
    public ?float $amount;
}
