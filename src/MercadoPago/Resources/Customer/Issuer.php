<?php

namespace MercadoPago\Resources\Customer;

/**
 * Represents the financial institution (bank or card network) that issued a payment card.
 *
 * Contains the issuer's MercadoPago identifier and display name. Used as a nested
 * object within {@see \MercadoPago\Resources\CustomerCard} and
 * {@see \MercadoPago\Resources\Customer\CustomerCardListResult}.
 */
class Issuer
{
    /** MercadoPago identifier for this card issuer. */
    public ?int $id;

    /** Display name of the card issuer (e.g., "Banco Nacion", "BBVA"). */
    public ?string $name;
}
