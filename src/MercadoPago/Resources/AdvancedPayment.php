<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * Advanced Payment resource.
 *
 * Represents a marketplace split payment, where a single collection is
 * distributed among multiple sellers (disbursements). Supports two-step
 * flows (authorise → capture) and individual disbursement release-date control.
 *
 * @property array|object|null $disbursements Disbursement list, mapped to {@see \MercadoPago\Resources\AdvancedPayment\Disbursement}.
 *
 * @see \MercadoPago\Client\AdvancedPayment\AdvancedPaymentClient
 */
class AdvancedPayment extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** The advanced payment ID. */
    public ?int $id;

    /** The application ID. */
    public ?string $application_id;

    /** The external reference. */
    public ?string $external_reference;

    /** The description. */
    public ?string $description;

    /** The overall status of the advanced payment. */
    public ?string $status;

    /** Indicates whether the payment was captured. */
    public ?bool $capture;

    /** The binary mode flag. */
    public ?bool $binary_mode;

    /** The date the advanced payment was created. */
    public ?string $date_created;

    /** The date the advanced payment was last updated. */
    public ?string $date_last_updated;

    /** The disbursements associated with this advanced payment. */
    public array|object|null $disbursements;

    private $map = [
        "disbursements" => "MercadoPago\Resources\AdvancedPayment\Disbursement",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
