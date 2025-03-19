<?php

/** API version: 950ae02-4f49-4686-9ad3-7929b21b6495 */

namespace MercadoPago\Resources\Order;

use MercadoPago\Serialization\Mapper;

/** IntegrationData class. */
class IntegrationData
{
    /** Class mapper. */
    use Mapper;

    /** Corporation ID. */
    public ?string $corporation_id;

    /** Application ID. */
    public ?string $application_id;

    /** Integrator ID. */
    public ?string $integrator_id;

    /** Platform ID. */
    public ?string $platform_id;

    /** Sponsor. */
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
