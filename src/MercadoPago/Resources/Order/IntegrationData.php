<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/**
 * Represents integration metadata for a MercadoPago order.
 *
 * Contains identifiers that link the order to a specific platform, integrator,
 * application, or corporation within the MercadoPago partner ecosystem.
 *
 * @see \MercadoPago\Resources\Order
 */
class IntegrationData
{
    /** Class mapper. */
    use Mapper;

    /** Identifier of the corporation that owns the integration. */
    public ?string $corporation_id;

    /** MercadoPago application ID used to create the order. */
    public ?string $application_id;

    /** Certified integrator identifier assigned by MercadoPago. */
    public ?string $integrator_id;

    /** E-commerce platform identifier (e.g., for WooCommerce, Magento, etc.). */
    public ?string $platform_id;

    /** Sponsor details when the order is created on behalf of another account. Maps to {@see Sponsor}. */
    public array|object|null $sponsor;

    private $map = [
        "sponsor" => "MercadoPago\Resources\Order\Sponsor",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
