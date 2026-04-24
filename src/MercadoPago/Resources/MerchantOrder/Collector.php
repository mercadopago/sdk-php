<?php

namespace MercadoPago\Resources\MerchantOrder;

/**
 * Merchant Order Collector (seller) resource.
 *
 * Represents the seller who receives the payment for a merchant order.
 * Contains basic identification and contact details of the collecting party.
 */
class Collector
{
    /** Collector ID. */
    public ?int $id;

    /** Collector nickname. */
    public ?string $nickname;

    /** Email. */
    public ?string $email;
}
