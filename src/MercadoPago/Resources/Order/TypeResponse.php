<?php

namespace MercadoPago\Resources\Order;

/**
 * Represents type-specific response data returned for a MercadoPago order.
 *
 * Contains additional output fields that depend on the order type,
 * such as QR code data for QR-based payment orders.
 *
 * @see \MercadoPago\Resources\Order
 */
class TypeResponse
{
    /** QR code payload string for QR-based orders (e.g., for in-store payments). */
    public ?string $qr_data = null;
}
