<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** Chargeback class. */
class Chargeback extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Chargeback ID. */
    public ?string $id;

    /** Payment ID associated with the chargeback. */
    public ?int $payment_id;

    /** Chargeback amount. */
    public ?float $amount;

    /** Currency of the chargeback. */
    public ?string $currency;

    /** Chargeback reason. */
    public ?string $reason;

    /** Stage of the chargeback. */
    public ?string $stage;

    /** Status of the chargeback. */
    public ?string $status;

    /** Date when the chargeback was created. */
    public ?string $date_created;

    /** Date when the chargeback was last updated. */
    public ?string $date_last_updated;

    /** Documentation deadline for the chargeback. */
    public ?string $documentation_deadline;

    /** Coverage applied to the chargeback. */
    public ?bool $coverage_applied;

    /** Coverage eligible for the chargeback. */
    public ?bool $coverage_eligible;

    /** External reference of the chargeback. */
    public ?string $external_reference;

    /** Metadata associated with the chargeback. */
    public array|object|null $metadata;

    /** Documentation status. */
    public ?string $documentation_status;

    /** Chargeback sequence number. */
    public ?int $chargeback_sequence_number;

    /** Source information. */
    public array|object|null $source;

    /** Case information. */
    public array|object|null $case;

    /** Risk score. */
    public ?float $risk_score;

    /** Payment method information. */
    public array|object|null $payment_method;

    /** Transaction details. */
    public array|object|null $transaction_details;

    private $map = [
        "source" => "MercadoPago\Resources\Common\Source",
        "payment_method" => "MercadoPago\Resources\Payment\PaymentMethod",
        "transaction_details" => "MercadoPago\Resources\Payment\TransactionDetails",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
} 