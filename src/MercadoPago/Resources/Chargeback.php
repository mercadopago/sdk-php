<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/**
 * Chargeback resource.
 *
 * Represents a payment dispute initiated by a cardholder through their
 * issuing bank. Chargebacks are created by MercadoPago when a dispute is
 * opened and track the dispute amount, status, and reason.
 *
 * @see \MercadoPago\Client\Chargeback\ChargebackClient
 */
class Chargeback extends MPResource
{
    /** The chargeback ID. */
    public ?string $id;

    /** The ID of the payment that originated the dispute. */
    public ?int $payment_id;

    /** The current status of the chargeback. */
    public ?string $status;

    /** The disputed amount. */
    public ?float $amount;

    /** The ISO 4217 currency code of the disputed amount. */
    public ?string $currency_id;

    /** The reason code provided by the card network. */
    public ?string $reason_id;

    /** The textual description of the dispute reason. */
    public ?string $reason;

    /** The date and time when the chargeback was created. */
    public ?string $date_created;

    /** The date and time of the last modification. */
    public ?string $last_modified;
}
