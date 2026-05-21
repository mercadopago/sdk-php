<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

/**
 * Represents a tax entry applied to a MercadoPago order.
 *
 * Each tax defines its type, amount, and the fiscal condition of the payer
 * that determines tax applicability.
 *
 * @see \MercadoPago\Resources\Order
 */
class Taxes
{
    /** Fiscal condition of the payer that determines tax applicability (e.g., "IVA_responsable_inscripto"). */
    public ?string $payer_condition;

    /** Tax amount or rate applied to the order. */
    public ?string $value;

    /** Tax type identifier (e.g., "IVA", "IGMP"). */
    public ?string $type;
}
