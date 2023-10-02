<?php

namespace MercadoPago\Resources\PaymentMethod;

use MercadoPago\Serialization\Mapper;

/** PaymentMethodListResult class. */
class PaymentMethodListResult
{
    /** Class mapper. */
    use Mapper;

    /** Payment method ID. */
    public ?string $id;

    /** Payment method name. */
    public ?string $name;

    /** Payment method payment type ID. */
    public ?string $payment_type_id;

    /** Payment method status. */
    public ?string $status;

    /** Payment method secure thumbnail. */
    public ?string $secure_thumbnail;

    /** Payment method thumbnail. */
    public ?string $thumbnail;

    /** Payment method deferred capture. */
    public ?string $deferred_capture;

    /** Payment method settings. */
    public array|object|null $settings;

    /** Payment method min allowed amount. */
    public ?float $min_allowed_amount;

    /** Payment method max allowed amount. */
    public ?float $max_allowed_amount;

    /** Payment method accreditation time. */
    public ?int $accreditation_time;

    /** Payment method financial institutions. */
    public array|object|null $financial_institutions;

    /** Payment method processing modes. */
    public ?string $processing_modes;

    /** Payment method additional info needed. */
    public $additional_info_needed;

    private $map = [
        "settings" => "MercadoPago\Resources\PaymentMethod\Settings",
        "financial_institutions" => "MercadoPago\Resources\PaymentMethod\FinancialInstitutions",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
