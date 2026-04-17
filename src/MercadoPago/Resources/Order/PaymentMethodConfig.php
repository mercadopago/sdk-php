<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** PaymentMethodConfig class. */
class PaymentMethodConfig
{
    /** Class mapper. */
    use Mapper;

    /** Not allowed ids. */
    public ?array $not_allowed_ids;

    /** Not allowed types. */
    public ?array $not_allowed_types;

    /** Default ID. */
    public ?string $default_id;

    /** Default type. */
    public ?string $default_type;

    /** Max installments. */
    public ?int $max_installments;

    /** Default installments. */
    public ?int $default_installments;

    /** Min installments. */
    public ?int $min_installments;

    /** Installments cost. */
    public ?string $installments_cost;

    /** Installments configuration. */
    public array|object|null $installments;

    private $map = [
        "installments" => "MercadoPago\Resources\Order\Installments",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
