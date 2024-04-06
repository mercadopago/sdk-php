<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** Invoice class. */
class Invoice extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** The ID of the invoice. */
    public ?int $id;

    /** The type of invoice. */
    public ?string $type;

    /** The date and time when the invoice was created. */
    public ?string $date_created;

    /** The date and time when the invoice was last modified. */
    public ?string $last_modified;

    /** The preapproval ID associated with the invoice. */
    public ?string $preapproval_id;

    /** The reason for the invoice. */
    public ?string $reason;

    /** The external reference for the invoice. */
    public ?string $external_reference;

    /** The currency ID. */
    public ?string $currency_id;

    /** The transaction amount. */
    public ?float $transaction_amount;

    /** The date for the next retry attempt. */
    public ?string $next_retry_date;

    /** The debit date and time for the invoice. */
    public ?string $debit_date;

    /** The payment method ID. */
    public ?string $payment_method_id;

    /** The retry attempt count. */
    public ?int $retry_attempt;

    /** Status of the invoice. */
    public ?string $status;

    /** Summarized. */
    public ?string $summarized;

    /** Payment info. */
    public array|object|null $payment;

    public $map = [
        "payment" => "MercadoPago\Resources\Invoice\Payment",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
