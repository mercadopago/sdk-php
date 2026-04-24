<?php

/** API version: 7c223ec9-4635-4eae-8501-604c35ea1b00 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the buyer (payer) associated with a MercadoPago order.
 *
 * Contains the buyer's personal information used for payment processing,
 * fraud prevention, and receipt generation.
 *
 * @see \MercadoPago\Resources\Order
 */
class Payer
{
    /** Class mapper. */
    use Mapper;

    /** MercadoPago customer ID if the payer is a registered customer. */
    public ?string $customer_id;

    /** Legal entity type of the payer (e.g., "individual", "association"). */
    public ?string $entity_type;

    /** Payer's email address used for notifications and receipts. */
    public ?string $email;

    /** Payer's first name. */
    public ?string $first_name;

    /** Payer's last name. */
    public ?string $last_name;

    /** Payer's identification document (type and number). Maps to Identification. */
    public array|object|null $identification;

    /** Payer's phone number details. Maps to Phone. */
    public array|object|null $phone;

    /** Payer's address details. Maps to Address. */
    public array|object|null $address;

    private $map = [
        "identification" => "MercadoPago\Resources\Common\Identification",
        "phone" => "MercadoPago\Resources\Common\Phone",
        "address" => "MercadoPago\Resources\Common\Address",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
