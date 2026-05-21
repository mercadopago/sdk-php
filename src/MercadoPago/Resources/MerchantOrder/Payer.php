<?php

namespace MercadoPago\Resources\MerchantOrder;

/**
 * Merchant Order Payer (buyer) resource.
 *
 * Represents the buyer who pays for a merchant order.
 * Contains basic identification and contact details of the paying party.
 */
class Payer
{
    /** Payer ID. */
    public ?int $id;

    /** Payer nickname. */
    public ?string $nickname;

    /** Payer email. */
    public ?string $email;
}
